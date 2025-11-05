<template>
  <div class="min-h-screen bg-gray-100">
    <div class="p-6 max-w-4xl mx-auto">
      <h1 class="text-3xl font-bold mb-6">Seu Carrinho</h1>
      
      <!-- Mensagens de sucesso/erro -->
      <div v-if="flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ flash.success }}
      </div>
      
      <div v-if="flash.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ flash.error }}
      </div>
      
      <div v-if="!cart || cart.length === 0" class="text-gray-500 text-center py-12">
        <p class="text-xl mb-4">Seu carrinho está vazio.</p>
        <a href="/fruits" class="text-green-600 hover:text-green-700 underline">
          Ir para o catálogo de frutas
        </a>
      </div>
      
      <div v-else>
        <ul class="space-y-3 mb-6">
          <li v-for="(item, index) in cart" :key="index" 
              class="flex items-center justify-between bg-white p-4 rounded-lg shadow">
            <div>
              <span class="font-semibold text-lg">{{ item.name }}</span>
              <span class="text-gray-600"> - {{ parseFloat(item.price).toFixed(2) }} MT x {{ item.quantity }}</span>
            </div>
            
            <div class="flex items-center gap-4">
              <span class="font-bold text-green-600">
                {{ (parseFloat(item.price) * item.quantity).toFixed(2) }} MT
              </span>
              <button 
                @click="removeFromCart(index)" 
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition"
              >
                Remover
              </button>
            </div>
          </li>
        </ul>
        
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <div class="flex justify-between items-center mb-4">
            <span class="text-2xl font-bold">Total:</span>
            <span class="text-3xl font-bold text-green-600">{{ totalCart.toFixed(2) }} MT</span>
          </div>
          
          <button 
            @click="processCheckout" 
            :disabled="processing"
            class="w-full bg-green-500 hover:bg-green-600 disabled:bg-gray-400 text-white font-bold py-3 px-6 rounded-lg transition text-lg"
          >
            {{ processing ? 'Processando...' : 'Finalizar Compra' }}
          </button>
          
          <p v-if="user" class="text-sm text-gray-500 mt-3 text-center">
            Você receberá um email de confirmação em: <strong>{{ user.email }}</strong>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

const props = defineProps({
  cart: {
    type: Array,
    default: () => []
  },
  user: {
    type: Object,
    default: null
  }
})

const page = usePage()
const flash = computed(() => page.props.flash || {})
const processing = ref(false)

const totalCart = computed(() => {
  if (!props.cart || props.cart.length === 0) return 0;
  
  return props.cart.reduce((total, item) => {
    return total + (parseFloat(item.price) * item.quantity)
  }, 0)
})

function removeFromCart(index) {
  if (confirm('Tem certeza que deseja remover este item?')) {
    router.delete(`/cart/${index}`)
  }
}

function processCheckout() {
  if (confirm(`Confirmar compra no valor de ${totalCart.value.toFixed(2)} MT?`)) {
    processing.value = true
    router.post('/cart/checkout', {}, {
      onFinish: () => {
        processing.value = false
      }
    })
  }
}
</script>