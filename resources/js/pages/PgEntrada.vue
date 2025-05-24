```vue
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
const imgSrc = ref('/ClincSys.png');
</script>

<template>
  <Head title="ClincSys" />
  <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-200 via-white to-blue-400 relative">
    <!-- Botão de login -->
    <div class="absolute top-6 right-8">
      <Link :href="route('login')">
        <button class="bg-blue-700 text-white px-6 py-2 rounded-full shadow hover:bg-blue-800 transition-all font-semibold tracking-wide">
          ENTRAR
        </button>
      </Link>
    </div>
    <!-- Nome do projeto e imagem -->
    <div class="flex flex-col items-center justify-center mt-0 absolute top-16 left-1/2 -translate-x-1/2">
      <img
        :src="imgSrc"
        @mouseenter="imgSrc = '/doutorzinho.png'"
        @mouseleave="imgSrc = '/ClincSys.png'"
        alt="Clínica Médica"
        class="w-36 h-36 mb-2 drop-shadow-xl rounded-full border-4 border-blue-300 bg-white transition-all duration-300 hover:scale-105 hover:shadow-2xl cursor-pointer"
      />
      <h1 class="text-5xl font-extrabold text-blue-900 mb-1 text-center drop-shadow">Bem-vindo ao ClincSys</h1>
    </div>
    <!-- Janela de texto institucional -->
    <div class="fixed bottom-12 left-8 bg-white/80 backdrop-blur-md rounded-r-lg shadow-2xl p-6 max-w-sm border-l-6 border-blue-400 flex items-center gap-4 ">
      <p class="leading-relaxed text-base text-blue-900 text-justify font-medium">
        O ClinSys é um sistema completo para gestão de clínicas médicas, unindo organização, praticidade e segurança, além de gerenciar agendas e informações com eficiência.
      </p>
    </div>
  </div>
</template>
```