<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';

const page = usePage();

interface Medico { id: number; nome: string; }
interface Especialidade { id: number; nome: string; }
interface Consulta { id: number; data: string; hora: string; }

const medicos = ref<Medico[]>([]);
const especialidades = ref<Especialidade[]>([]);
const consultas = ref<Consulta[]>([]);
const data = ref('');
const hora = ref('');
const observacao = ref('');
const medicoSelecionado = ref<number | string>('');
const especialidadeSelecionada = ref<number | string>('');
const showModal = ref(false);
const agendamentoResumo = ref({
  medico: '',
  especialidade: '',
  data: '',
  hora: '',
  observacao: ''
});
const medicosDisponiveis = ref<Medico[]>([]);
const alerta = ref<{ msg: string; tipo: 'success' | 'error' } | null>(null);

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

watch([especialidadeSelecionada, data, hora], async ([esp, d, h]) => {
  if (esp && d && h) {
    const resp = await fetch('/medicos/disponiveis', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ especialidade_id: esp, data: d, hora: h })
    });
    if (resp.ok) {
      medicosDisponiveis.value = await resp.json();
    } else {
      medicosDisponiveis.value = [];
    }
  } else {
    medicosDisponiveis.value = [];
  }
});

function logout() {
  router.post('/logout', {}, {
    onFinish: () => {
      router.visit('/');
    }
  });
}

function abrirModalConfirmacao() {
  agendamentoResumo.value = {
    medico: medicos.value.find(m => m.id == Number(medicoSelecionado.value))?.nome || '',
    especialidade: especialidades.value.find(e => e.id == Number(especialidadeSelecionada.value))?.nome || '',
    data: data.value,
    hora: hora.value,
    observacao: observacao.value
  };
  showModal.value = true;
}

function fecharModal() {
  showModal.value = false;
}

async function confirmarAgendamento() {
  try {
    const resp = await fetch('/agendamentos', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        medico_id: medicoSelecionado.value,
        especialidade_id: especialidadeSelecionada.value,
        data: data.value,
        hora: hora.value,
        observacao: observacao.value
      })
    });
    if (resp.ok) {
      alerta.value = { msg: 'Agendamento realizado com sucesso!', tipo: 'success' };
      setTimeout(() => { alerta.value = null; }, 4000);
      showModal.value = false;
      // Limpa campos e atualiza médicos disponíveis
      medicoSelecionado.value = '';
      observacao.value = '';
      // Atualiza médicos disponíveis
      const medResp = await fetch('/medicos/disponiveis', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ especialidade_id: especialidadeSelecionada.value, data: data.value, hora: hora.value })
      });
      if (medResp.ok) medicosDisponiveis.value = await medResp.json();
    } else {
      const erro = await resp.json();
      alerta.value = { msg: erro.error || 'Erro ao agendar.', tipo: 'error' };
      setTimeout(() => { alerta.value = null; }, 4000);
    }
  } catch (e) {
    alerta.value = { msg: 'Erro ao agendar.', tipo: 'error' };
    setTimeout(() => { alerta.value = null; }, 4000);
  }
}

</script>

<template>

  <Head title="Atendimento" />
  <div
    class="h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-200 via-white to-blue-400 dark:from-gray-900 dark:via-gray-700 dark:to-blue-900 relative transition-colors py-8 px-2 sm:px-6 lg:px-8">
    <div class="w-full max-w-md z-10">
      <form method="POST" action="/logout" class="absolute top-8 right-8 z-20" @submit.prevent="logout">
        <button type="submit"
          class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold px-6 py-2 rounded-full shadow transition-all tracking-wide">
          Desconectar
        </button>
      </form>
      <div
        class="w-full bg-white/95 dark:bg-gray-900/95 rounded-2xl shadow-2xl p-6 sm:p-8 border-2 border-blue-500 dark:border-blue-700 transition-colors">
        <div class="flex flex-col items-center mb-6">
          <img src="/copio.png" alt="Logo ClinicSys" class="w-14 h-14 sm:w-24 sm:h-24 mb-2 drop-shadow" />
          <h2 class="text-3xl font-extrabold text-blue-500 dark:text-blue-400 text-center mb-1 tracking-tight">Faça seu
            Agendamento</h2>
        </div>
        <!-- Menu suspenso Especialidade -->
        <div class="mb-4 w-full">
          <label class="block text-black dark:text-white">Especialidade</label>
          <select class="w-full p-2 border rounded dark:bg-gray-800 text-black dark:text-white"
            v-model="especialidadeSelecionada">
            <option disabled value="">Selecione uma especialidade</option>
            <option v-for="e in especialidades" :key="e.id" :value="e.id">{{ e.nome }}</option>
          </select>
        </div>
        <!-- Campo Data e Hora juntos -->
        <div class="mb-4 w-full flex gap-2">
          <div class="flex-1">
            <label class="block text-black dark:text-white">Data</label>
            <input type="date" class="w-full p-2 border rounded dark:bg-gray-800 text-black dark:text-white"
              v-model="data" />
          </div>
          <div class="flex-1">
            <label class="block text-black dark:text-white">Hora</label>
            <select class="w-full p-2 border rounded dark:bg-gray-800 text-black dark:text-white" v-model="hora">
              <option disabled value="">Selecione um horário</option>
              <option v-for="h in ['08:00', '10:00', '10:30', '11:00', '13:00', '14:00', '15:00', '16:00']" :key="h"
                :value="h">{{ h }}</option>
            </select>
          </div>
        </div>
        <!-- Menu suspenso Médico (aparece só se especialidade, data e hora estiverem preenchidos) -->
        <div class="mb-4 w-full" v-if="especialidadeSelecionada && data && hora">
          <label class="block text-black dark:text-white">Médico</label>
          <select class="w-full p-2 border rounded dark:bg-gray-800 text-black dark:text-white"
            v-model="medicoSelecionado">
            <option disabled value="">Selecione um médico</option>
            <option v-for="m in medicosDisponiveis" :key="m.id" :value="m.id">{{ m.nome }}</option>
          </select>
        </div>
        <!-- Botão para abrir modal de confirmação -->
        <div class="mb-4 w-full">
          <button @click="abrirModalConfirmacao"
            class="w-full p-2 bg-blue-500 text-white rounded-xl font-bold shadow hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 transition-all">
            Confirmar Agendamento
          </button>
        </div>
        <!-- Modal de confirmação -->
        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-black/20">
          <div
            class="text-justify bg-white dark:bg-gray-900 p-4 rounded-xl shadow-2xl border-2 border-blue-500 dark:border-blue-700 w-full max-w-xl">
            <h2 class="text-base font-semibold mb-3 text-blue-500 dark:text-blue-400">Deseja confirmar o agendamento?
            </h2>
            <div class="text-gray-700 dark:text-gray-300 mb-2 text-sm">
              Atenção: Ao finalizar o agendamento, você estará reservando o horário de um profissional especializado. Cancele apenas se for realmente necessário.
            </div>
            <div class="flex justify-end gap-2 mt-3">
              <button @click="fecharModal"
          class="px-3 py-1.5 bg-gray-300 dark:bg-gray-700 text-black dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-600 text-sm">Cancelar</button>
              <button @click="confirmarAgendamento"
          class="px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Agendar</button>
            </div>
          </div>
        </div>
        <div v-if="alerta"
          :class="['fixed top-6 right-6 z-50 px-4 py-2 rounded shadow-lg', alerta.tipo === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white']">
          {{ alerta.msg }}
        </div>
      </div>
    </div>
  </div>
</template>
