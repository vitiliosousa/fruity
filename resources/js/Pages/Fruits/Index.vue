<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Catálogo de Frutas</h1>
    <ul>
      <li v-for="fruit in fruits" :key="fruit.id">
        {{ fruit.name }} - ${{ fruit.price.toFixed(2) }}
      </li>
    </ul>
  </div>
</template>

<script setup>
defineProps({
  fruits: Array
})
</script>
