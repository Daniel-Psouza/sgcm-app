<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
const props = defineProps<{ pacientes: any[] }>();
</script>

<template>
  <Head title="Pacientes" />
  <div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Pacientes</h1>
    <form class="mb-6 flex gap-2" @submit.prevent="$inertia.post(route('pacientes.store'), paciente)">
      <input v-model="paciente.nome" type="text" placeholder="Nome" class="border px-2 py-1 rounded" required />
      <input v-model="paciente.data_nascimento" type="date" placeholder="Nascimento" class="border px-2 py-1 rounded" required />
      <input v-model="paciente.cpf" type="text" placeholder="CPF" class="border px-2 py-1 rounded" required />
      <input v-model="paciente.telefone" type="text" placeholder="Telefone" class="border px-2 py-1 rounded" />
      <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Cadastrar</button>
    </form>
    <table class="min-w-full bg-white border">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b">ID</th>
          <th class="py-2 px-4 border-b">Nome</th>
          <th class="py-2 px-4 border-b">Data de Nascimento</th>
          <th class="py-2 px-4 border-b">CPF</th>
          <th class="py-2 px-4 border-b">Telefone</th>
          <th class="py-2 px-4 border-b">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="pac in props.pacientes" :key="pac.id">
          <td class="py-2 px-4 border-b">{{ pac.id }}</td>
          <td class="py-2 px-4 border-b">{{ pac.nome }}</td>
          <td class="py-2 px-4 border-b">{{ pac.data_nascimento }}</td>
          <td class="py-2 px-4 border-b">{{ pac.cpf }}</td>
          <td class="py-2 px-4 border-b">{{ pac.telefone }}</td>
          <td class="py-2 px-4 border-b">
            <button @click="$inertia.delete(route('pacientes.destroy', pac.id))" class="text-red-600">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
