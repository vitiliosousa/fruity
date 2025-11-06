<template>
  <div class="min-h-screen bg-gradient-to-b from-green-50 to-white flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">
      <!-- Card de Sucesso -->
      <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 text-center border-4 border-green-500">

        <!-- Ícone de Sucesso -->
        <div class="mb-6">
          <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto animate-bounce">
            <CheckCircle class="w-16 h-16 text-white" />
          </div>
        </div>

        <!-- Título -->
        <h1 class="text-4xl md:text-5xl font-bold text-green-700 mb-4">
          Compra Realizada com Sucesso!
        </h1>

        <!-- Mensagem -->
        <p class="text-lg text-gray-600 mb-8">
          Obrigado por sua compra! Seu pedido foi processado com sucesso.
        </p>

        <!-- Informações do Pedido -->
        <div class="bg-green-50 rounded-2xl p-6 mb-8 border-2 border-green-200">
          <div class="space-y-3">
            <div class="flex justify-between items-center">
              <span class="text-gray-600 font-semibold">Número do Pedido:</span>
              <span class="text-green-700 font-bold text-lg">{{ order.order_number }}</span>
            </div>

            <div class="flex justify-between items-center">
              <span class="text-gray-600 font-semibold">Data:</span>
              <span class="text-gray-700">{{ order.date }}</span>
            </div>

            <div class="border-t-2 border-green-200 pt-3 mt-3">
              <div class="flex justify-between items-center">
                <span class="text-gray-600 font-semibold text-xl">Total:</span>
                <span class="text-green-700 font-bold text-2xl">{{ formatPrice(order.total) }} MT</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Mensagem de Email -->
        <div class="flex items-center justify-center gap-2 text-gray-600 mb-8">
          <Mail class="w-5 h-5 text-green-600" />
          <p class="text-sm">
            Um email de confirmação foi enviado para você com todos os detalhes do pedido.
          </p>
        </div>

        <!-- Botões de Ação -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <Link :href="route('fruits.index')"
            class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg transition transform hover:scale-105">
            <ShoppingCart class="w-6 h-6" />
            Continuar Comprando
          </Link>

        </div>
      </div>

      <!-- Mensagem Extra -->
      <div class="mt-8 text-center text-gray-500 text-sm">
        <p>Dúvidas sobre seu pedido? Entre em contato conosco!</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { CheckCircle, ShoppingCart, Mail, Home } from 'lucide-vue-next';

const props = defineProps({
  order: {
    type: Object,
    required: true,
  },
});

function formatPrice(price) {
  return parseFloat(price).toFixed(2).replace('.', ',');
}
</script>
