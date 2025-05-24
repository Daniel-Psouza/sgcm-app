<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
const props = defineProps<{ especialidades: any[] }>();
</script>

<template>
  <Head title="Especialidades" />
  <div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Especialidades</h1>
    <form class="mb-6 flex gap-2" @submit.prevent="$inertia.post(route('especialidades.store'), { nome: nome })">
      <input v-model="nome" type="text" placeholder="Nova especialidade" class="border px-2 py-1 rounded" required />
      <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Cadastrar</button>
    </form>
    <table class="min-w-full bg-white border">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b">ID</th>
          <th class="py-2 px-4 border-b">Nome</th>
          <th class="py-2 px-4 border-b">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="esp in props.especialidades" :key="esp.id">
          <td class="py-2 px-4 border-b">{{ esp.id }}</td>
          <td class="py-2 px-4 border-b">{{ esp.nome }}</td>
          <td class="py-2 px-4 border-b">
            <button @click="$inertia.delete(route('especialidades.destroy', esp.id))" class="text-red-600">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
