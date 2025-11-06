<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const showingNavigationDropdown = ref(false);
const user = usePage().props.auth.user;
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="border-b border-gray-100 bg-white shadow-sm">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between items-center">
          
          <!-- Logo e Voltar ao Catálogo -->
          <div class="flex items-center gap-4">
            <h2 class="font-bold text-2xl text-green-600">Fruity</h2>
          </div>

          <!-- Dropdown Perfil/Logout -->
          <div class="hidden gap-2 sm:flex sm:items-center">
            <Link
              :href="route('fruits.index')"
              class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm  hover:bg-green-200 transition hidden sm:flex"
            >
             Comprar Frutas
            </Link>
            <Dropdown align="right" width="48">
              <template #trigger>
                <button
                  class="flex items-center justify-center w-10 h-10 rounded-full bg-green-100 text-green-700 hover:bg-green-200 transition"
                  type="button"
                >
                  {{ user.name.charAt(0) }}
                </button>
              </template>

              <template #content>
                <DropdownLink :href="route('profile.edit')">
                  Perfil
                </DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button">
                  Sair
                </DropdownLink>
              </template>
            </Dropdown>
          </div>

          <!-- Hamburger Mobile -->
          <div class="sm:hidden flex items-center">
            <button
              @click="showingNavigationDropdown = !showingNavigationDropdown"
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none"
            >
              <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                  :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                  :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Mobile Dropdown -->
      <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
        <div class="space-y-1 px-4 py-2 border-t border-gray-200">
          <Link :href="route('fruits.index')" class="block px-3 py-2 rounded-md text-green-700 hover:bg-green-100 transition">
            Voltar ao Catálogo
          </Link>
          <Link :href="route('profile.edit')" class="block px-3 py-2 rounded-md text-green-700 hover:bg-green-100 transition">
            Perfil
          </Link>
          <Link :href="route('logout')" method="post" as="button" class="block px-3 py-2 rounded-md text-red-600 hover:bg-red-100 transition">
            Sair
          </Link>
        </div>
      </div>
    </nav>

    <header v-if="$slots.header" class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <slot name="header" />
      </div>
    </header>

    <main>
      <slot />
    </main>
  </div>
</template>
