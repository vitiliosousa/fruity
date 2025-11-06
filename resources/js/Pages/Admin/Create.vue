<template>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
        <!-- Header -->
        <header class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-green-700">Cadastrar Nova Fruta</h1>
                    <p class="text-gray-600">Preencha os campos abaixo para adicionar uma nova fruta</p>
                </div>
                <button @click="goBack" class="text-green-600 hover:text-green-700 font-semibold">
                    ← Voltar
                </button>
            </div>
        </header>

        <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Validation Errors -->
            <div v-if="errors && Object.keys(errors).length" class="mb-6 p-4 bg-red-100 border-l-4 border-red-600 text-red-700 rounded-lg">
                <ul>
                    <li v-for="(message, field) in errors" :key="field">{{ message }}</li>
                </ul>
            </div>

            <form @submit.prevent="submitForm" class="space-y-6 bg-white p-6 rounded-2xl shadow-lg">
                <div>
                    <label for="name" class="block font-semibold text-gray-700">Nome</label>
                    <input v-model="form.name" id="name" type="text" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                </div>

                <div>
                    <label for="description" class="block font-semibold text-gray-700">Descrição</label>
                    <textarea v-model="form.description" id="description" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required></textarea>
                </div>

                <div>
                    <label for="price" class="block font-semibold text-gray-700">Preço (MT)</label>
                    <input v-model.number="form.price" id="price" type="number" min="0" step="0.01" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                </div>

                <!-- Select Categoria -->
                <div>
                    <label for="category" class="block font-semibold text-gray-700">Categoria</label>
                    <select v-model="form.category" id="category" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                        <option value="" disabled>Selecione a categoria</option>
                        <option value="Fruta Cítrica">Fruta Cítrica</option>
                        <option value="Fruta Tropical">Fruta Tropical</option>
                        <option value="Fruta Vermelha">Fruta Vermelha</option>
                        <option value="Fruta Exótica">Fruta Exótica</option>
                    </select>
                </div>

                <!-- Custom Image Input -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Imagem</label>
                    <div
                        @click="triggerFileInput"
                        class="cursor-pointer w-full h-32 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 transition relative"
                    >
                        <span v-if="!previewImage" class="text-gray-400">Clique ou arraste a imagem aqui</span>
                        <img v-if="previewImage" :src="previewImage" class="w-48 h-48 object-cover rounded-lg">
                        <input ref="fileInput" type="file" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" @change="handleImageUpload">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" :disabled="processing" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-lg transition">
                        Salvar
                    </button>
                </div>
            </form>
        </main>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

function goBack() {
    router.visit(route('admin.index'));
}

const form = ref({
    name: '',
    description: '',
    price: null,
    category: '',
    image: null,
});

const previewImage = ref(null);
const processing = ref(false);
const errors = ref({});

const fileInput = ref(null);

function triggerFileInput() {
    fileInput.value?.click();
}

function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        form.value.image = file;
        previewImage.value = URL.createObjectURL(file);
    } else {
        form.value.image = null;
        previewImage.value = null;
    }
}

function submitForm() {
    processing.value = true;
    errors.value = {};

    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('description', form.value.description);
    formData.append('price', form.value.price);
    formData.append('category', form.value.category);
    if (form.value.image) {
        formData.append('image', form.value.image);
    }

    router.post(route('admin.store'), formData, {
        preserveScroll: true,
        onSuccess: () => {
            processing.value = false;
        },
        onError: (err) => {
            processing.value = false;
            errors.value = err;
        }
    });
}
</script>
