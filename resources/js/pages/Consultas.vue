<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

const props = defineProps<{ consultas: any[] }>();

const consulta = reactive({
  paciente_id: '',
  medico_id: '',
  data_hora: '',
  observacoes: ''
});
</script>

<template>
  <Head title="Consultas" />
  <div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Consultas</h1>
    <form class="mb-6 flex gap-2" @submit.prevent="$inertia.post(route('consultas.store'), consulta)">
      <input v-model="consulta.paciente_id" type="number" placeholder="ID Paciente" class="border px-2 py-1 rounded" required />
      <input v-model="consulta.medico_id" type="number" placeholder="ID Médico" class="border px-2 py-1 rounded" required />
      <input v-model="consulta.data_hora" type="datetime-local" placeholder="Data/Hora" class="border px-2 py-1 rounded" required />
      <input v-model="consulta.observacoes" type="text" placeholder="Observações" class="border px-2 py-1 rounded" />
      <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Cadastrar</button>
    </form>
    <table class="min-w-full bg-white border">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b">ID</th>
          <th class="py-2 px-4 border-b">Paciente</th>
          <th class="py-2 px-4 border-b">Médico</th>
          <th class="py-2 px-4 border-b">Data/Hora</th>
          <th class="py-2 px-4 border-b">Observações</th>
          <th class="py-2 px-4 border-b">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="con in props.consultas" :key="con.id">
          <td class="py-2 px-4 border-b">{{ con.id }}</td>
          <td class="py-2 px-4 border-b">{{ con.paciente_nome }}</td>
          <td class="py-2 px-4 border-b">{{ con.medico_nome }}</td>
          <td class="py-2 px-4 border-b">{{ con.data_hora }}</td>
          <td class="py-2 px-4 border-b">{{ con.observacoes }}</td>
          <td class="py-2 px-4 border-b">
            <button @click="$inertia.delete(route('consultas.destroy', con.id))" class="text-red-600">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
