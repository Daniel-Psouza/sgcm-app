<script setup lang="ts">
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';

// Campos do formulário
const especialidade = ref('');
const data = ref('');
const hora = ref('');

// Modal
const showModal = ref(false);
const agendamento = ref({
  medico: '',
  especialidade: '',
  data: '',
  hora: '',
});

function logout() {
  router.post('/logout', {}, {
    onFinish: () => {
      router.visit('/');
    }
  });
}

function abrirModal() {

}

function fecharModal() {
  showModal.value = false;
}
</script>

<template>
  <div
    class="h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-200 via-white to-blue-400 dark:from-gray-900 dark:via-gray-700 dark:to-blue-900 relative transition-colors py-8 px-2 sm:px-6 lg:px-8">
    <div class="absolute top-4 right-4">
      <button @click="logout"
        class="bg-blue-400 hover:bg-blue-500 text-white font-semibold rounded-full shadow px-6 py-2 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900">Sair</button>
    </div>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg w-full max-w-md">
      <div class="flex flex-col items-center mb-6">
        <img src="/copio.png" alt="Logo ClinicSys" class="w-14 h-14 sm:w-24 sm:h-24 mb-2 drop-shadow" />
        <h2 class="text-3xl font-extrabold text-blue-500 text-center mb-1 tracking-tight">
          Faça seu Agendamento
        </h2>
      </div>
      <div class="mb-4">
        <label class="text-blue-500">Especialidade</label>
        <input type="text"
          class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
          v-model="especialidade" placeholder="Digite a especialidade" />
      </div>
      <div class="mb-4 flex gap-4">
        <div class="flex-1">
          <label class="text-blue-500">Data</label>
          <input type="date"
        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
        v-model="data" />
        </div>
        <div class="flex-1">
          <label class="text-blue-500">Hora</label>
          <input type="time"
        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
        v-model="hora" />
        </div>
      </div>
    </div>
  </div>
</template>
