<template>
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section
            class="relative h-screen bg-cover bg-center"
            style="
                background-image: url('https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=1920');
            "
        >
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>

            <!-- Content -->
            <div class="relative z-10 p-10">
                <!-- Header/Navbar -->
                <header class="flex items-center justify-between px-8 py-6">
                    <h1 class="text-5xl font-bold text-white">Fruity</h1>

                    <nav class="flex gap-4">
                        <template v-if="isLoggedIn">
                            <Link
                                :href="route('fruits.index')"
                                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition"
                            >
                                Ver Catálogo
                            </Link>
                        </template>
                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="px-10 py-4 bg-white hover:bg-gray-100 rounded-full font-semibold transition"
                            >
                                Login
                            </Link>
                            <Link
                                :href="route('register')"
                                class="px-10 py-4 bg-green-600 hover:bg-green-700 text-white rounded-full font-semibold transition"
                            >
                                Registrar
                            </Link>
                        </template>
                    </nav>
                </header>

                <!-- Hero Content -->
                <div class="flex items-center h-[calc(100vh-100px)] px-8">
                    <div class="max-w-2xl">
                        <h2 class="text-6xl font-bold text-white mb-6">
                            Frutas Frescas Direto da Natureza
                        </h2>
                        <p class="text-2xl text-white mb-8 opacity-90">
                            Descubra o sabor autêntico das melhores frutas
                            tropicais de Moçambique
                        </p>
                        <button
                            @click="scrollToProducts"
                            class="px-10 py-4 bg-white text-lg rounded-full font-semibold transition transform hover:scale-105"
                        >
                            Ver Produtos
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Produtos em Destaque -->
        <section id="products" class="py-20 bg-white">
            <div class="max-w-full mx-auto px-20">
                <h2 class="text-5xl font-bold text-green-700 text-center mb-4">
                    Produtos em Destaque
                </h2>
                <p class="text-green-600 text-center mb-12 text-xl">
                    Seleção especial das nossas frutas mais populares
                </p>

                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12"
                >
                    <div
                        v-for="product in featuredProducts"
                        :key="product.id"
                        class="bg-white rounded-xl shadow-lg overflow-hidden transition"
                    >
                        <div
                            class="h-96 bg-cover bg-center"
                            :style="`background-image: url('${product.image}')`"
                        ></div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-green-700 mb-2">
                                {{ product.name }}
                            </h3>
                            <p class="text-green-600 text-xl font-bold mb-4">
                                {{ product.price }} MT
                            </p>
                            <p class="text-gray-600 text-lg">
                                {{ product.description }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <Link
                        v-if="isLoggedIn"
                        :href="route('fruits.index')"
                        class="inline-block px-10 py-4 bg-green-600 hover:bg-green-700 text-white rounded-full font-semibold transition"
                    >
                        Ver Mais Produtos
                    </Link>
                    <Link
                        v-else
                        :href="route('login')"
                        class="inline-block px-10 py-4 bg-green-600 hover:bg-green-700 text-white rounded-full font-semibold transition"
                    >
                        Login para Ver Mais
                    </Link>
                </div>
            </div>
        </section>

        <!-- Section 3: Valores -->
        <section
            class="relative py-32 bg-cover bg-center"
            style="
                background-image: url('https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=1920');
            "
        >
            <div class="absolute inset-0 bg-green-900 bg-opacity-70"></div>

            <div class="relative z-10 max-w-6xl mx-auto px-8">
                <div class="bg-white rounded-2xl p-12 shadow-2xl">
                    <h2
                        class="text-4xl font-bold text-green-700 text-center mb-8"
                    >
                        Por Que Escolher a Fruity?
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4"
                            >
                                <Check
                                    class="w-8 h-8 text-green-600"
                                />
                            </div>
                            <h3 class="text-xl font-bold text-green-700 mb-2">
                                100% Naturais
                            </h3>
                            <p class="text-green-600 text-lg">
                                Sem conservantes ou químicos artificiais
                            </p>
                        </div>

                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4"
                            >
                                <Apple
                                    class="w-8 h-8 text-green-600"
                                />
                            </div>
                            <h3 class="text-xl font-bold text-green-700 mb-2">
                                Sustentáveis
                            </h3>
                            <p class="text-green-600 text-lg">
                                Cultivadas com respeito ao meio ambiente
                            </p>
                        </div>

                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4"
                            >
                                <Clock
                                    class="w-8 h-8 text-green-600"
                                />
                            </div>
                            <h3 class="text-xl font-bold text-green-700 mb-2">
                                Sempre Frescas
                            </h3>
                            <p class="text-green-600 text-lg">
                                Colhidas e entregues no mesmo dia
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4: Categorias -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-8">
                <h2 class="text-5xl font-bold text-green-700 text-center mb-4">
                    Explore Nossas Categorias
                </h2>
                <p class="text-green-600 text-center mb-12 text-xl">
                    Encontre exatamente o que você procura
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div
                        v-for="category in categories"
                        :key="category.id"
                        class="relative rounded-xl overflow-hidden shadow-lg group cursor-pointer h-96"
                    >
                        <div
                            class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
                            :style="`background-image: url('${category.image}')`"
                        ></div>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"
                        ></div>
                        <div
                            class="absolute bottom-0 left-0 right-0 p-6 text-white"
                        >
                            <h3 class="text-2xl font-bold mb-2">
                                {{ category.name }}
                            </h3>
                            <p class="text-sm opacity-90">
                                {{ category.count }} produtos disponíveis
                            </p>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <Link
                        v-if="isLoggedIn"
                        :href="route('fruits.index')"
                        class="inline-block px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition text-lg"
                    >
                        Comprar Agora
                    </Link>
                    <Link
                        v-else
                        :href="route('register')"
                        class="inline-block px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition text-lg"
                    >
                        Criar Conta e Comprar
                    </Link>
                </div>
            </div>
        </section>

        <!-- Section 5: Depoimentos -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-8">
                <h2 class="text-5xl font-bold text-green-700 text-center mb-4">
                    O Que Nossos Clientes Dizem
                </h2>
                <p class="text-green-600 text-center mb-12 text-xl">
                    Experiências reais de quem já comprou conosco
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        v-for="testimonial in testimonials"
                        :key="testimonial.id"
                        class="bg-green-50 rounded-xl p-8 shadow-lg"
                    >
                        <div class="flex items-center mb-4">
                            <div
                                class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl"
                            >
                                {{ testimonial.initials }}
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-green-700">
                                    {{ testimonial.name }}
                                </h4>
                                <div class="flex text-yellow-400">
                                    <span v-for="n in 5" :key="n">★</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-green-600 italic">
                            "{{ testimonial.text }}"
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 6: Footer -->
        <footer class="bg-green-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Fruity</h3>
                        <p class="text-green-200">
                            Frutas frescas e naturais direto para sua casa
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold mb-4">Links Rápidos</h4>
                        <ul class="space-y-2 text-green-200">
                            <li>
                                <a href="#" class="hover:text-white transition"
                                    >Sobre Nós</a
                                >
                            </li>
                            <li>
                                <a href="#" class="hover:text-white transition"
                                    >Produtos</a
                                >
                            </li>
                            <li>
                                <a href="#" class="hover:text-white transition"
                                    >Contato</a
                                >
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold mb-4">Suporte</h4>
                        <ul class="space-y-2 text-green-200">
                            <li>
                                <a href="#" class="hover:text-white transition"
                                    >FAQ</a
                                >
                            </li>
                            <li>
                                <a href="#" class="hover:text-white transition"
                                    >Entregas</a
                                >
                            </li>
                            <li>
                                <a href="#" class="hover:text-white transition"
                                    >Devoluções</a
                                >
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold mb-4">Contato</h4>
                        <ul class="space-y-2 text-green-200">
                            <li>Email: contato@fruity.co.mz</li>
                            <li>Tel: +258 84 123 4567</li>
                            <li>Maputo, Moçambique</li>
                        </ul>
                    </div>
                </div>

                <div
                    class="border-t border-green-700 pt-8 text-center text-green-200"
                >
                    <p>&copy; 2024 Fruity. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import { Check, Apple, Clock } from 'lucide-vue-next';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    auth: Object,
});

const isLoggedIn = computed(() => props.auth?.user != null);

const featuredProducts = [
    {
        id: 1,
        name: "Maçã Vermelha",
        price: "75.00",
        description: "Maçãs frescas e crocantes",
        image: "https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?w=400",
    },
    {
        id: 2,
        name: "Banana Premium",
        price: "40.00",
        description: "Bananas maduras e doces",
        image: "https://images.unsplash.com/photo-1603833665858-e61d17a86224?w=400",
    },
    {
        id: 3,
        name: "Laranja Suculenta",
        price: "60.00",
        description: "Laranjas frescas para sucos",
        image: "https://images.unsplash.com/photo-1580052614034-c55d20bfee3b?w=400",
    },
    {
        id: 4,
        name: "Manga Tropical",
        price: "85.00",
        description: "Mangas doces e aromáticas",
        image: "https://images.unsplash.com/photo-1553279768-865429fa0078?w=400",
    },
];

const categories = [
    {
        id: 1,
        name: "Frutas Tropicais",
        count: 12,
        image: "https://images.unsplash.com/photo-1559181567-c3190ca9959b?w=600",
    },
    {
        id: 2,
        name: "Frutas Cítricas",
        count: 8,
        image: "https://images.unsplash.com/photo-1582979512210-99b6a53386f9?w=600",
    },
    {
        id: 3,
        name: "Frutas da Estação",
        count: 15,
        image: "https://images.unsplash.com/photo-1619566636858-adf3ef46400b?w=600",
    },
];

const testimonials = [
    {
        id: 1,
        name: "Ana Silva",
        initials: "AS",
        text: "As frutas são sempre frescas e de ótima qualidade. Recomendo!",
    },
    {
        id: 2,
        name: "João Costa",
        initials: "JC",
        text: "Entrega rápida e frutas deliciosas. Virei cliente fiel!",
    },
    {
        id: 3,
        name: "Maria Santos",
        initials: "MS",
        text: "Melhor loja de frutas online de Maputo. Preços justos e qualidade excelente!",
    },
];

function scrollToProducts() {
    document.getElementById("products")?.scrollIntoView({ behavior: "smooth" });
}

// Helper function to check if route exists
function route(name) {
    // This is a placeholder - Inertia will handle the actual routing
    const routes = {
        login: "/login",
        register: "/register",
        "fruits.index": "/fruits",
    };
    return routes[name] || "/";
}
</script>
