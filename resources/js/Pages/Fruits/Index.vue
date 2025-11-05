<template>
    <div class="min-h-screen bg-gradient-to-b from-white to-green-50">
        <!-- Header -->
        <header class="bg-white shadow-md sticky top-0 z-50">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-20 py-4">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <Link href="/" class="text-3xl font-bold text-green-700 hover:text-green-800 transition">
                        Fruity
                    </Link>

                    <!-- Search Bar -->
                    <div class="flex-1 max-w-2xl mx-8">
                        <div class="relative">
                            <input
                                v-model="searchQuery"
                                type="text"
                                placeholder="Buscar frutas..."
                                class="w-full px-6 py-3 pl-12 border-2 border-green-200 rounded-full focus:border-green-500 focus:ring-green-500 transition"
                            />
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Cart & User -->
                    <div class="flex items-center gap-4">
                        <Link :href="route('cart.index')" class="relative">
                            <div class="p-3 bg-green-100 rounded-full hover:bg-green-200 transition">
                                <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </Link>
                        
                        <div class="text-right">
                            <p class="text-sm text-green-700 font-semibold">{{ $page.props.auth.user.name }}</p>
                            <Link :href="route('logout')" method="post" as="button" class="text-xs text-green-600 hover:text-green-800">
                                Sair
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-full mx-auto px-4 sm:px-6 lg:px-20 py-8">
            <!-- Title & Filters -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-green-700 mb-6">Nosso Catálogo</h1>
                
                <!-- Category Filters -->
                <div class="flex flex-wrap gap-3 mb-6">
                    <button
                        @click="selectedCategory = 'Todas'"
                        :class="selectedCategory === 'Todas' ? 'bg-green-600 text-white' : 'bg-white text-green-700 hover:bg-green-50'"
                        class="px-6 py-2 rounded-full font-semibold transition shadow-md"
                    >
                        Todas
                    </button>
                    <button
                        v-for="category in categories"
                        :key="category"
                        @click="selectedCategory = category"
                        :class="selectedCategory === category ? 'bg-green-600 text-white' : 'bg-white text-green-700 hover:bg-green-50'"
                        class="px-6 py-2 rounded-full font-semibold transition shadow-md"
                    >
                        {{ category }}
                    </button>
                </div>

                <!-- Results Count -->
                <p class="text-green-600 text-lg">
                    Mostrando <span class="font-bold">{{ filteredFruits.length }}</span> frutas
                </p>
            </div>

            <!-- Fruits Grid -->
            <div v-if="filteredFruits.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <div
                    v-for="fruit in filteredFruits"
                    :key="fruit.id"
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2 border-2 border-green-100 group"
                >
                    <!-- Image -->
                    <div class="relative h-64 overflow-hidden bg-gray-100">
                        <img
                            :src="fruit.image"
                            :alt="fruit.name"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                        />
                        <div class="absolute top-3 right-3">
                            <span class="bg-green-600 text-white px-4 py-2 rounded-full font-bold text-lg shadow-lg">
                                {{ fruit.price.toFixed(2) }} MT
                            </span>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="bg-white/90 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ fruit.category }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <h3 class="text-2xl font-bold text-green-700 mb-2">{{ fruit.name }}</h3>
                        <p class="text-gray-600 mb-4 text-sm">{{ fruit.description }}</p>
                        
                        <button
                            @click="addToCart(fruit)"
                            class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition shadow-md hover:shadow-lg flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-green-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-green-700 mb-2">Nenhuma fruta encontrada</h3>
                <p class="text-green-600">Tente buscar por outro nome ou categoria</p>
            </div>
        </main>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { Search } from 'lucide-vue-next';

const props = defineProps({
    fruits: Array
});

const searchQuery = ref('');
const selectedCategory = ref('Todas');

// Get unique categories
const categories = computed(() => {
    const cats = [...new Set(props.fruits.map(f => f.category))];
    return cats.sort();
});

// Filter fruits
const filteredFruits = computed(() => {
    let filtered = props.fruits;

    // Filter by category
    if (selectedCategory.value !== 'Todas') {
        filtered = filtered.filter(f => f.category === selectedCategory.value);
    }

    // Filter by search query
    if (searchQuery.value.trim()) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(f => 
            f.name.toLowerCase().includes(query) ||
            f.description.toLowerCase().includes(query) ||
            f.category.toLowerCase().includes(query)
        );
    }

    return filtered;
});

function addToCart(fruit) {
    router.post('/cart/add', {
        id: fruit.id,
        name: fruit.name,
        price: fruit.price
    }, {
        preserveScroll: true,
        onSuccess: () => {
            // Optional: Show toast notification
            alert(`${fruit.name} adicionado ao carrinho!`);
        }
    });
}
</script>