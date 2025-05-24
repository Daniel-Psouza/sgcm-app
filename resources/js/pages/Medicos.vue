<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
const props = defineProps<{ medicos: any[] }>();
</script>

<template>
  <Head title="Médicos" />
  <div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Médicos</h1>
    <form class="mb-6 flex gap-2" @submit.prevent="$inertia.post(route('medicos.store'), medico)">
      <input v-model="medico.nome" type="text" placeholder="Nome" class="border px-2 py-1 rounded" required />
      <input v-model="medico.crm" type="text" placeholder="CRM" class="border px-2 py-1 rounded" required />
      <input v-model="medico.especialidade_id" type="number" placeholder="ID Especialidade" class="border px-2 py-1 rounded" required />
      <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Cadastrar</button>
    </form>
    <table class="min-w-full bg-white border">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b">ID</th>
          <th class="py-2 px-4 border-b">Nome</th>
          <th class="py-2 px-4 border-b">CRM</th>
          <th class="py-2 px-4 border-b">Especialidade</th>
          <th class="py-2 px-4 border-b">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="med in props.medicos" :key="med.id">
          <td class="py-2 px-4 border-b">{{ med.id }}</td>
          <td class="py-2 px-4 border-b">{{ med.nome }}</td>
          <td class="py-2 px-4 border-b">{{ med.crm }}</td>
          <td class="py-2 px-4 border-b">{{ med.especialidade_nome }}</td>
          <td class="py-2 px-4 border-b">
            <button @click="$inertia.delete(route('medicos.destroy', med.id))" class="text-red-600">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
