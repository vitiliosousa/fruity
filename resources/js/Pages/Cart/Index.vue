<template>
  <div class="min-h-screen bg-gradient-to-b from-white to-green-50">
    
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
      <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-20 py-4">
        <div class="flex items-center justify-between">
          <h1 class="text-3xl font-bold text-green-700">Fruity</h1>

          <Link href="/fruits" class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 transition shadow-md">
            <ShoppingCart class="w-5 h-5 text-white" />
            Catálogo
          </Link>
        </div>
      </div>
    </header>

    <!-- Main -->
    <main class="max-w-full mx-auto px-4 sm:px-6 lg:px-20 py-10">

      <h2 class="text-4xl font-bold text-green-700 mb-6">Seu Carrinho</h2>

      <!-- Carrinho vazio -->
      <div v-if="!cart || cart.length === 0" class="text-center py-20">
        <Frown class="w-20 h-20 mx-auto text-green-300 mb-4"/>
        <h3 class="text-2xl font-bold text-green-700 mb-2">Seu carrinho está vazio</h3>

        <Link href="/fruits"
          class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full font-semibold shadow-md transition"
        >
          <ShoppingCart class="w-5 h-5 text-white"/>
          Ir para o Catálogo
        </Link>
      </div>

      <!-- Lista do carrinho -->
      <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Items -->
        <ul class="space-y-6">
          <li v-for="(item, index) in cart" :key="index"
              class="flex items-center gap-4 bg-white rounded-2xl shadow-lg p-5 border-2 border-green-100 hover:shadow-2xl transition">

            <!-- Imagem -->
            <div class="w-24 h-24 rounded-xl overflow-hidden">
              <img :src="item.image" :alt="item.name" class="w-full h-full object-cover">
            </div>

            <!-- Info -->
            <div class="flex-1">
              <h4 class="text-xl font-bold text-green-700">{{ item.name }}</h4>
              <p class="text-gray-600">
                {{ parseFloat(item.price).toFixed(2) }} MT cada
              </p>

              <!-- Controles de quantidade -->
              <div class="flex items-center gap-3 mt-2">
                <button
                  @click="updateQuantity(index, item.quantity - 1)"
                  class="w-8 h-8 flex items-center justify-center bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
                >−</button>

                <span class="text-lg font-semibold">{{ item.quantity }}</span>

                <button
                  @click="updateQuantity(index, item.quantity + 1)"
                  class="w-8 h-8 flex items-center justify-center bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                >+</button>
              </div>
            </div>

            <!-- Total e remover -->
            <div class="text-right">
              <p class="text-xl font-bold text-green-600 mb-2">
                {{ (parseFloat(item.price) * item.quantity).toFixed(2) }} MT
              </p>
              <button
                @click="removeFromCart(index)"
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg shadow transition"
              >
                Remover
              </button>
            </div>

          </li>
        </ul>

        <!-- Resumo -->
        <div class="bg-white p-8 rounded-2xl shadow-xl border-2 border-green-100 h-fit">
          <h3 class="text-2xl font-bold text-green-700 mb-4 text-center">Resumo da Compra</h3>

          <div class="flex justify-between items-center mb-5">
            <span class="text-xl font-semibold text-gray-700">Total:</span>
            <span class="text-3xl font-extrabold text-green-600">{{ totalCart.toFixed(2) }} MT</span>
          </div>

          <button
            @click="processCheckout"
            :disabled="processing"
            class="w-full py-4 bg-green-600 hover:bg-green-700 disabled:bg-gray-400 text-white font-bold rounded-xl transition shadow-md text-lg"
          >
            {{ processing ? 'Processando...' : 'Finalizar Compra' }}
          </button>
        </div>

      </div>
    </main>
  </div>
</template>

<script setup>
import { router, Link, usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { ShoppingCart, Frown } from 'lucide-vue-next'

const props = defineProps({
  cart: Array,
  user: Object
})

const page = usePage()
const processing = ref(false)

const totalCart = computed(() => {
  if (!props.cart || props.cart.length === 0) return 0;
  return props.cart.reduce((t, i) => t + (parseFloat(i.price) * i.quantity), 0)
})

// Aumentar/diminuir quantidade
function updateQuantity(index, newQty) {
  if (newQty <= 0) return removeFromCart(index)

  router.post('/cart/update', {
    index,
    quantity: newQty
  }, { preserveScroll: true })
}

// Remover produto
function removeFromCart(index) {
  router.delete(`/cart/${index}`)
}

// Finalizar compra
function processCheckout() {
  processing.value = true
  router.post('/cart/checkout', {}, {
    onFinish: () => processing.value = false
  })
}
</script>
