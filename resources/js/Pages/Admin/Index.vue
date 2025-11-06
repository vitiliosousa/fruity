<template>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
        <!-- Header -->
        <header class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-green-700">Painel Admin</h1>
                        <p class="text-gray-600">Gerenciar Frutas</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <Link :href="route('fruits.index')" class="text-green-600 hover:text-green-700 font-semibold">
                        Ver Loja
                        </Link>
                        <Link :href="route('logout')" method="post" as="button"
                            class="text-gray-600 hover:text-gray-700">
                        Sair
                        </Link>
                    </div>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Success Message -->
            <div v-if="$page.props.flash?.success"
                class="mb-6 p-4 bg-green-100 border-l-4 border-green-600 text-green-700 rounded-lg">
                {{ $page.props.flash.success }}
            </div>

            <!-- Actions -->
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Produtos Cadastrados ({{ fruits.length }})</h2>
                <Link :href="route('admin.create')"
                    class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-lg transition">
                + Nova Fruta
                </Link>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Imagem</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase">Nome</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Categoria</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Preço</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="fruit in fruits" :key="fruit.id" class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img v-if="fruit.image" :src="fruit.image" :alt="fruit.name"
                                    class="w-16 h-16 object-cover rounded-lg">
                                <div v-else class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">Sem imagem</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="font-semibold text-gray-900">{{ fruit.name }}</div>
                                <div class="text-sm text-gray-500">{{ truncate(fruit.description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                    {{ fruit.category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-green-600 text-center">
                                {{ fruit.price }} MT
                            </td>
                            <td class="px-6 py-4 gap-4 flex items-center justify-center">
                                <!-- Botão Editar -->
                                <Link :href="route('admin.edit', fruit.id)"
                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition text-sm font-semibold">
                                Editar
                                </Link>

                                <!-- Botão Deletar -->
                                <button @click="deleteFruit(fruit)"
                                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition text-sm font-semibold">
                                    Deletar
                                </button>
                            </td>

                        </tr>
                    </tbody>
                </table>

                <div v-if="fruits.length === 0" class="text-center py-12 text-gray-500">
                    <p class="text-lg mb-4">Nenhuma fruta cadastrada ainda</p>
                    <Link :href="route('admin.create')" class="text-green-600 hover:text-green-700 font-semibold">
                    Cadastrar primeira fruta
                    </Link>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';

defineProps({
    fruits: Array
});

function truncate(text, length) {
    if (!text) return '';
    return text.length > length ? text.substring(0, length) + '...' : text;
}

// Substitui o confirm() por uma exclusão direta
function deleteFruit(fruit) {
    // Opcional: você pode adicionar uma lógica de modal customizado aqui
    router.delete(route('admin.destroy', fruit.id), {
        preserveScroll: true, // mantém a posição da página
        onSuccess: () => {
            console.log(`${fruit.name} deletada com sucesso`);
        },
        onError: (errors) => {
            console.error(errors);
        }
    });
}

function editFruit(id) {
    router.visit(route('admin.edit', id));
}

</script>
