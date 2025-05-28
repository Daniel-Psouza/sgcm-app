<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import { router } from '@inertiajs/vue3';

// Campos do formulário
const especialidade = ref('');
const data = ref('');
const hora = ref('');
const medico = ref('');

// Especialidades
const especialidades = ref<any[]>([]);

// Médicos
const medicos = ref<any[]>([]);

watch(especialidade, async (novoId) => {
  medicos.value = [];
  medico.value = '';
  if (!novoId) return;
  try {
    const response = await fetch(`/medicos/por-especialidade/${novoId}`);
    if (response.ok) {
      medicos.value = await response.json();
    }
  } catch (e) {
    alert('Erro ao buscar médicos da especialidade');
  }
});

watch([especialidade, data, hora], async ([novoId, novaData, novaHora]) => {
  medicos.value = [];
  medico.value = '';
  if (!novoId || !novaData || !novaHora) return;
  try {
    const params = new URLSearchParams({
      especialidade_id: novoId,
      data: novaData,
      hora: novaHora
    });
    const response = await fetch(`/medicos/disponiveis?${params.toString()}`);
    if (response.ok) {
      medicos.value = await response.json();
    }
  } catch (e) {
    alert('Erro ao buscar médicos disponíveis');
  }
});

onMounted(async () => {
  try {
    const responseEsp = await fetch('/especialidades');
    if (responseEsp.ok) {
      especialidades.value = await responseEsp.json();
    }
  } catch (e) {
    alert('Erro ao buscar especialidades');
  }
});

function logout() {
  router.post('/logout', {}, {
    onFinish() {
      router.visit('/');
    }
  });
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
        <select
          class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
          v-model="especialidade">
          <option value="" disabled>Selecione a especialidade</option>
          <option v-for="esp in especialidades" :key="esp.id" :value="esp.id">
            {{ esp.nome }}
          </option>
        </select>
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
          <select
            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
            v-model="hora">
            <option value="" disabled>Selecione o horário</option>
            <option value="08:00">08:00</option>
            <option value="10:00">10:00</option>
            <option value="12:00">12:00</option>
            <option value="14:00">14:00</option>
            <option value="16:00">16:00</option>
          </select>
        </div>
      </div>
      <div v-if="especialidade && data && hora"> 
        <label class="text-blue-500">Medicos</label>
        <select class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" v-model="medico">
          <option value="" disabled>Selecione um Médico</option>
            <option v-for="med in medicos" :key="med.id" :value="med.id">
              {{ med.nome }}
            </option>
        </select>
      </div>
    </div>
  </div>
</template>
