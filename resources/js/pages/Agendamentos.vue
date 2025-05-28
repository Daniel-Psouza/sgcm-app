<script setup lang="ts">
import { ref, onMounted } from 'vue';

const agendamentos = ref<any[]>([]);

onMounted(async () => {
  try {
    const response = await fetch('/agendamentos');
    if (response.ok) {
      agendamentos.value = await response.json();
    }
  } catch (e) {
    alert('Erro ao buscar agendamentos');
  }
});
</script>

<template>
  <div class="p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-blue-600 mb-4">Agendamentos</h1>
    <table class="w-full border rounded shadow bg-white dark:bg-gray-800">
      <thead>
        <tr class="bg-blue-100 dark:bg-blue-900">
          <th class="p-2">Paciente</th>
          <th class="p-2">Médico</th>
          <th class="p-2">Especialidade</th>
          <th class="p-2">Data</th>
          <th class="p-2">Hora</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="ag in agendamentos" :key="ag.id" class="border-t">
          <td class="p-2">{{ ag.paciente_nome ?? '-' }}</td>
          <td class="p-2">{{ ag.medico_nome ?? '-' }}</td>
          <td class="p-2">{{ ag.especialidade_nome ?? '-' }}</td>
          <td class="p-2">{{ ag.data ?? '-' }}</td>
          <td class="p-2">{{ ag.hora ?? '-' }}</td>
        </tr>
        <tr v-if="!agendamentos.length">
          <td colspan="5" class="text-center p-4 text-gray-400">Nenhum agendamento encontrado.</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
