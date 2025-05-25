<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const page = usePage();

interface Medico { id: number; nome: string; }
interface Especialidade { id: number; nome: string; }
interface Consulta { id: number; data: string; hora: string; }

const medicos = ref<Medico[]>([]);
const especialidades = ref<Especialidade[]>([]);
const consultas = ref<Consulta[]>([]);
const data = ref('');
const hora = ref('');

onMounted(async () => {
  // Buscar médicos
  const medicosResp = await fetch('/medicos');
  if (medicosResp.ok) medicos.value = await medicosResp.json();
  // Buscar especialidades
  const especialidadesResp = await fetch('/especialidades');
  if (especialidadesResp.ok) especialidades.value = await especialidadesResp.json();
  // Buscar consultas
  const consultasResp = await fetch('/consultas');
  if (consultasResp.ok) consultas.value = await consultasResp.json();
});

function logout() {
    router.post('/logout', {}, {
        onFinish: () => {
            router.visit('/');
        }
    });
}


</script>

<template>
  <Head title="Atendimento" />
  <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-300 via-white to-blue-400 relative">
    <div class="p-8 bg-white">
        <form method="POST" action="/logout" class="absolute top-8 right-8 z-20" @submit.prevent="logout">
          <button type="submit" class="btn-principal bg-blue-400 text-black px-6 py-3 rounded-xl shadow hover:bg-blue-800 hover:text-white font-semibold text-lg transition-all">
            Desconectar
          </button>
        </form>
        <header class="text-center font-bold text-xl">Faça seu Agendamento</header>
        <!-- Menu suspenso Médico -->
        <div class="mb-4 w-full">
          <label class="block text-gray-700">Médico</label>
          <select class="w-full p-2 border rounded">
            <option disabled selected>Selecione um médico</option>
            <option v-for="m in medicos" :key="m.id" :value="m.id">{{ m.nome }}</option>
          </select>
        </div>
        <!-- Menu suspenso Especialidade -->
        <div class="mb-4 w-full">
          <label class="block text-gray-700">Especialidade</label>
          <select class="w-full p-2 border rounded">
            <option disabled selected>Selecione uma especialidade</option>
            <option v-for="e in especialidades" :key="e.id" :value="e.id">{{ e.nome }}</option>
          </select>
        </div>
        <!-- Menu suspenso Consulta -->
        <div class="mb-4 w-full">
          <label class="block text-gray-700">Consulta</label>
          <select class="w-full p-2 border rounded">
            <option disabled selected>Selecione uma consulta</option>
            <option v-for="c in consultas" :key="c.id" :value="c.id">Consulta #{{ c.id }} - {{ c.data }} {{ c.hora }}</option>
          </select>
        </div>
        <!-- Campo Data e Hora juntos -->
        <div class="mb-4 w-full flex gap-2">
          <div class="flex-1">
            <label class="block text-gray-700">Data</label>
            <input type="date" class="w-full p-2 border rounded" v-model="data" />
          </div>
          <div class="flex-1">
            <label class="block text-gray-700">Hora</label>
            <select class="w-full p-2 border rounded" v-model="hora">
              <option disabled value="">Selecione um horário</option>
              <option v-for="h in ['08:00', '10:00', '10:30', '11:00', '13:00']" :key="h" :value="h">{{ h }}</option>
            </select>
          </div>
        </div>
      </div>
  </div>
</template>
