<template>
    <div class="min-h-screen bg-gradient-to-b from-white to-green-50">

        <!-- ✅ Toast Notification -->
        <Transition name="toast">
            <div v-if="showToast"
                class="fixed top-20 right-4 z-50 bg-white rounded-2xl shadow-2xl p-4 flex items-center gap-3 border-l-4 border-green-500 animate-slide-in">
                <div class="bg-green-100 p-2 rounded-full">
                    <Check class="w-5 h-5 text-green-600" />
                </div>
                <div>
                    <p class="font-bold text-green-700">Adicionado ao carrinho!</p>
                    <p class="text-sm text-gray-600">{{ lastAddedItem }}</p>
                </div>
            </div>
        </Transition>

        <!-- ✅ Header -->
        <header class="bg-white shadow-md sticky top-0 z-40">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-20 py-4">
                <div class="flex items-center justify-between">

                    <Link href="/" class="text-3xl font-bold text-green-700 hover:text-green-800 transition"> Fruity </Link>

                    <!-- ✅ Search -->
                    <div class="flex-1 max-w-2xl mx-8">
                        <div class="relative">
                            <input v-model="searchQuery" type="text" placeholder="Buscar frutas..."
                                class="w-full px-6 py-3 pl-12 border-2 border-green-200 rounded-full focus:border-green-500 focus:ring-green-500 transition" />
                            <Search class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-green-600" />
                        </div>
                    </div>

                    <!-- ✅ Cart + User -->
                    <div class="flex items-center gap-6">
                        <Link :href="route('profile.edit')" class="relative group">
                            <div
                                class="p-3 bg-green-100 rounded-full hover:bg-green-200 transition-all group-hover:scale-110">
                                <User class="h-6 w-6 text-green-700" />
                            </div>
                        </Link>
                        <Link :href="route('cart.index')" class="relative group">
                            <div
                                class="p-3 bg-green-100 rounded-full hover:bg-green-200 transition-all group-hover:scale-110">
                                <ShoppingCart class="h-6 w-6 text-green-700" />
                            </div>
                            <!-- ✅ Badge com contagem -->
                            <Transition name="bounce">
                                <span v-if="cartItemCount > 0" :key="cartItemCount"
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center shadow-lg">
                                    {{ cartItemCount }}
                                </span>
                            </Transition>
                        </Link>
                        
                        <div class="text-right">
                            <p class="text-sm text-green-700 font-semibold">{{ $page.props.auth.user.name }}</p>
                            <Link :href="route('logout')" method="post" as="button"
                                class="text-xs text-red-600 hover:text-red-800 flex items-center gap-1 transition">
                                <LogOut class="h-3 w-3" /> Sair
                            </Link>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ✅ Conteúdo -->
        <main class="max-w-full mx-auto px-4 sm:px-6 lg:px-20 py-8">

            <div class="mb-8">
                <h1 class="text-4xl font-bold text-green-700 mb-6">Nosso Catálogo</h1>

                <!-- ✅ Filtro por categoria -->
                <div class="flex flex-wrap gap-3 mb-6">
                    <button v-for="cat in ['Todas', ...categories]" :key="cat" @click="selectedCategory = cat"
                        :class="selectedCategory === cat ? 'bg-green-600 text-white' : 'bg-white text-green-700 hover:bg-green-50'"
                        class="px-6 py-2 rounded-full font-semibold transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                        {{ cat }}
                    </button>
                </div>

                <p class="text-green-600 text-lg">
                    Mostrando <span class="font-bold">{{ filteredFruits.length }}</span> frutas
                </p>
            </div>

            <!-- ✅ Grid com Skeleton -->
            <div v-if="isPageLoading" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <FruitSkeleton v-for="n in 12" :key="n" />
            </div>

            <!-- ✅ Grid Normal -->
            <div v-else-if="filteredFruits.length > 0"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                <div v-for="fruit in filteredFruits" :key="fruit.id"
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2 border-2 border-green-100 group">

                    <div class="relative h-64 overflow-hidden bg-gray-100">
                        <img :src="fruit.image" :alt="fruit.name"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />

                        <div class="absolute top-3 right-3">
                            <span class="bg-green-600 text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                {{ fruit.price.toFixed(2) }} MT
                            </span>
                        </div>

                        <div class="absolute top-3 left-3">
                            <span class="bg-white/90 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ fruit.category }}
                            </span>
                        </div>
                    </div>

                    <div class="p-5">
                        <h3 class="text-2xl font-bold text-green-700 mb-2">{{ fruit.name }}</h3>
                        <p class="text-gray-600 mb-4 text-sm">{{ fruit.description }}</p>

                        <button @click="addToCart(fruit)" :disabled="loading[fruit.id]"
                            class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition shadow-md hover:shadow-lg flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">

                            <Loader2 v-if="loading[fruit.id]" class="w-5 h-5 animate-spin" />
                            <ShoppingCart v-else class="w-5 h-5" />

                            {{ loading[fruit.id] ? 'Adicionando...' : 'Adicionar ao Carrinho' }}
                        </button>
                    </div>

                </div>
            </div>

            <div v-else class="text-center py-20">
                <Frown class="w-20 h-20 mx-auto text-green-300 mb-4" />
                <h3 class="text-2xl font-bold text-green-700 mb-2">Nenhuma fruta encontrada</h3>
                <p class="text-green-600">Tente buscar por outro nome ou categoria</p>
            </div>

            <!-- ✅ Paginação -->
            <div v-if="fruits.links && fruits.links.length > 3 && !isPageLoading"
                class="mt-12 flex items-center justify-center gap-2">

                <!-- Botão Anterior -->
                <button @click="goToPage(fruits.prev_page_url)" :disabled="!fruits.prev_page_url"
                    class="px-4 py-2 bg-white border-2 border-green-600 text-green-600 rounded-lg font-semibold hover:bg-green-50 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center gap-2">
                    <ChevronLeft class="w-5 h-5" />
                    Anterior
                </button>

                <!-- Números de Página -->
                <div class="flex gap-2">
                    <button v-for="(link, index) in fruits.links.slice(1, -1)" :key="index"
                        @click="goToPage(link.url)" :disabled="link.active"
                        :class="link.active ? 'bg-green-600 text-white' : 'bg-white text-green-600 hover:bg-green-50'"
                        class="px-4 py-2 border-2 border-green-600 rounded-lg font-semibold transition disabled:cursor-default">
                        {{ link.label }}
                    </button>
                </div>

                <!-- Botão Próximo -->
                <button @click="goToPage(fruits.next_page_url)" :disabled="!fruits.next_page_url"
                    class="px-4 py-2 bg-white border-2 border-green-600 text-green-600 rounded-lg font-semibold hover:bg-green-50 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center gap-2">
                    Próximo
                    <ChevronRight class="w-5 h-5" />
                </button>
            </div>

        </main>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { Search, ShoppingCart, Frown, LogOut, Check, Loader2, User, ChevronLeft, ChevronRight } from 'lucide-vue-next';
import FruitSkeleton from '@/Components/FruitSkeleton.vue';

const props = defineProps({ fruits: Object });

const searchQuery = ref('');
const selectedCategory = ref('Todas');

// ✅ Estados
const loading = ref({});
const showToast = ref(false);
const lastAddedItem = ref('');
const cartItemCount = ref(0);
const isPageLoading = ref(false);

// ✅ Categorias únicas
const categories = computed(() => {
    return [...new Set(props.fruits.data.map(f => f.category))].sort();
});

// ✅ Filtragem
const filteredFruits = computed(() => {
    let results = props.fruits.data;

    if (selectedCategory.value !== 'Todas') {
        results = results.filter(f => f.category === selectedCategory.value);
    }

    if (searchQuery.value.trim()) {
        const q = searchQuery.value.toLowerCase();
        results = results.filter(f =>
            f.name.toLowerCase().includes(q) ||
            f.description.toLowerCase().includes(q) ||
            f.category.toLowerCase().includes(q)
        );
    }

    return results;
});

// ✅ Adicionar ao carrinho
function addToCart(fruit) {
    loading.value[fruit.id] = true;

    router.post('/cart/add', {
        id: fruit.id,
        image: fruit.image,
        name: fruit.name,
        price: fruit.price
    }, {
        preserveScroll: true,
        onSuccess: () => {
            loading.value[fruit.id] = false;

            // ✅ Atualiza contador
            cartItemCount.value++;

            // ✅ Toast
            lastAddedItem.value = fruit.name;
            showToast.value = true;

            // Fechar Toast após 2.5s
            setTimeout(() => showToast.value = false, 2500);
        },
        onError: () => {
            loading.value[fruit.id] = false;
        }
    });
}

// ✅ Navegação de página
function goToPage(url) {
    if (!url) return;

    isPageLoading.value = true;

    router.visit(url, {
        preserveScroll: true,
        preserveState: true,
        onFinish: () => {
            isPageLoading.value = false;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
}
</script>

<style scoped>
.toast-enter-active,
.toast-leave-active {
    transition: all 0.3s ease;
}

.toast-enter-from {
    transform: translateX(100%);
    opacity: 0;
}

.toast-leave-to {
    transform: translateX(100%);
    opacity: 0;
}

.bounce-enter-active {
    animation: bounce-in 0.5s;
}

@keyframes bounce-in {
    0% { transform: scale(0); }
    50% { transform: scale(1.3); }
    100% { transform: scale(1); }
}

.animate-slide-in {
    animation: slide-in 0.3s ease-out;
}

@keyframes slide-in {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
</style>
