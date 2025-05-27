```vue
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
</script>

<template>
  <Head title="ClinicSys" />
  <div
    class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-200 via-white to-blue-400 dark:from-gray-900 dark:via-gray-700 dark:to-blue-900 relative transition-colors py-8 px-2 sm:px-6 lg:px-8">
    <!-- Botão de login -->
    <div class="absolute top-6 right-8 z-10">
      <Link :href="route('login')">
        <button
          class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold px-6 py-2 rounded-full shadow transition-all tracking-wide">
          ENTRAR
        </button>
      </Link>
    </div>
    <!-- Nome do projeto e imagem -->
    <div class="flex flex-col items-center justify-center mt-0 absolute top-16 left-1/2 -translate-x-1/2 w-full max-w-md z-10">
      <div
        class="bg-[url('../med.png')] hover:bg-[url('../doutor.png')] bg-center bg-cover bg-white
        dark:bg-blue-100 hover:rotate-y-360 transform-3d w-50 h-50 transition-transform duration-500 rounded-full shadow-lg mb-4 hover:shadow-2xl hover:cursor-pointer border-2 border-blue-500 dark:border-blue-700">
      </div>
      <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-900 dark:text-blue-100 text-center mb-1 tracking-tight drop-shadow">
        Bem-vindo ao ClinicSys
      </h1>
    </div>
    <!-- Janela de texto institucional -->
    <div
      class="fixed bottom-12 left-8 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md rounded-r-2xl shadow-2xl p-6 max-w-sm border-l-4 border-blue-400 dark:border-blue-700 flex items-center gap-4 z-20 transition-colors"
    >
      <p class="leading-relaxed text-base text-blue-900 dark:text-blue-100 text-justify font-medium">
        O ClinicSys é um sistema completo para gestão de clínicas médicas, unindo organização, praticidade e segurança, além de gerenciar agendas e informações com eficiência.
      </p>
    </div>
  </div>
</template>
```