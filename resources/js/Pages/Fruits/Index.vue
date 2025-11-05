<template>
  <div class="min-h-screen bg-gray-100">
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Catálogo de Frutas</h1>
      
      <div v-if="!fruits || fruits.length === 0">
        Nenhuma fruta encontrada
      </div>
      
      <ul v-else>
        <li v-for="fruit in fruits" :key="fruit.id" class="flex items-center justify-between mb-2 bg-white p-4 rounded shadow">
          <span>{{ fruit.name }} - {{ formatPrice(fruit.price) }} MT</span>
          <button 
            @click="addToCart(fruit)" 
            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
          >
            Adicionar
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
  fruits: {
    type: Array,
    default: () => []
  }
})

function formatPrice(price) {
  return parseFloat(price).toFixed(2)
}

function addToCart(fruit) {
  router.post('/cart/add', {
    id: fruit.id,
    name: fruit.name,
    price: fruit.price
  })
}
</script>