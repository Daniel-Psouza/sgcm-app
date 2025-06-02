<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const agendamentos = (usePage().props.agendamentos as Array<any>) ?? [];

function formatarData(data: string) {
  if (!data) return '';
  const partes = data.split('-');
  if (partes.length !== 3) return data;
  const [ano, mes, dia] = partes;
  return `${dia}/${mes}/${ano}`;
}

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
    <div class="absolute top-4 left-4">
      <button @click="router.get('/dashboard')"
        class="bg-blue-400 hover:bg-blue-500 text-white font-semibold rounded-full shadow px-6 py-2 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900">
        Voltar
      </button>
    </div>
    <div class="absolute top-4 right-4">
      <button @click="logout"
        class="bg-blue-400 hover:bg-blue-500 text-white font-semibold rounded-full shadow px-6 py-2 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900">Sair</button>
    </div>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg w-full max-w-2xl mt-16">
      <h2 class="text-3xl font-extrabold text-blue-500 text-center mb-6 tracking-tight">
        Consultas Agendadas
      </h2>
      <div v-if="!agendamentos || agendamentos.length === 0" class="text-center text-blue-700 dark:text-blue-200 py-4">
        Nenhuma consulta agendada encontrada.
      </div>
      <div v-else>
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-blue-100 dark:bg-blue-900">
              <th class="p-2 border-b border-blue-200 dark:border-blue-700">Data</th>
              <th class="p-2 border-b border-blue-200 dark:border-blue-700">Hora</th>
              <th class="p-2 border-b border-blue-200 dark:border-blue-700">Especialidade</th>
              <th class="p-2 border-b border-blue-200 dark:border-blue-700">Médico</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="ag in agendamentos" :key="ag.id"
              class="hover:bg-blue-50 dark:hover:bg-blue-800 transition-colors">
              <td class="p-2 border-b border-blue-100 dark:border-blue-700">{{ formatarData(ag.data) }}</td>
              <td class="p-2 border-b border-blue-100 dark:border-blue-700">{{ ag.hora }}</td>
              <td class="p-2 border-b border-blue-100 dark:border-blue-700">{{ ag.especialidade_nome }}</td>
              <td class="p-2 border-b border-blue-100 dark:border-blue-700">{{ ag.medico_nome }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
