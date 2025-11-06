<template>
  <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        <div>
          <h1 class="text-3xl font-bold text-green-700">Editar Fruta</h1>
          <p class="text-gray-600">Atualize os dados da fruta</p>
        </div>
        <Link :href="route('admin.index')" class="text-green-600 hover:text-green-700 font-semibold">
          Voltar
        </Link>
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
        <!-- Nome -->
        <div>
          <label for="name" class="block font-semibold text-gray-700">Nome</label>
          <input v-model="form.name" id="name" type="text"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"
            required>
        </div>

        <!-- Descrição -->
        <div>
          <label for="description" class="block font-semibold text-gray-700">Descrição</label>
          <textarea v-model="form.description" id="description" rows="4"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"
            required></textarea>
        </div>

        <!-- Preço -->
        <div>
          <label for="price" class="block font-semibold text-gray-700">Preço (MT)</label>
          <input v-model.number="form.price" id="price" type="number" min="0" step="0.01"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"
            required>
        </div>

        <!-- Categoria -->
        <div>
          <label for="category" class="block font-semibold text-gray-700">Categoria</label>
          <select v-model="form.category" id="category"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            <option value="">Selecione uma categoria</option>
            <option value="Cítrica">Cítrica</option>
            <option value="Fruta Vermelha">Fruta Vermelha</option>
            <option value="Tropical">Tropical</option>
            <option value="Exótica">Exótica</option>
          </select>
        </div>

        <!-- Imagem -->
        <div>
          <label for="image" class="block font-semibold text-gray-700">Imagem</label>
          <input @change="handleImageUpload" id="image" type="file" accept="image/*"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">

          <div class="mt-2 flex items-center gap-4">
            <div v-if="previewImage">
              <img :src="previewImage" class="w-32 h-32 object-cover rounded-lg">
            </div>
            <div v-else-if="form.originalImage">
              <img :src="form.originalImage" class="w-32 h-32 object-cover rounded-lg opacity-70">
            </div>
            <div v-else
              class="w-32 h-32 bg-gray-200 flex items-center justify-center rounded-lg text-gray-400 text-sm">
              Sem imagem
            </div>
          </div>
        </div>

        <div class="flex justify-end">
          <button type="submit" :disabled="processing"
            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-lg transition">
            Salvar Alterações
          </button>
        </div>
      </form>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';

// Props corretas
const props = defineProps({
  fruit: Object
});

const form = ref({
  name: props.fruit.name,
  description: props.fruit.description,
  price: props.fruit.price,
  category: props.fruit.category,
  image: null,
  originalImage: props.fruit.image || null,
});

const previewImage = ref(null);
const processing = ref(false);
const errors = ref({});

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
  formData.append('name', form.value.name ?? '');
  formData.append('description', form.value.description ?? '');
  formData.append('price', form.value.price != null ? form.value.price : '');
  formData.append('category', form.value.category ?? '');
  
  if (form.value.image) {
    formData.append('image', form.value.image);
  }

  router.put(route('admin.update', props.fruit.id), formData, {
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
