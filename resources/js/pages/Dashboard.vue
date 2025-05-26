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
const medicoSelecionado = ref<number|string>('');
const especialidadeSelecionada = ref<number|string>('');
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
  <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-300 via-white to-blue-400 relative">
    <div class="p-8 bg-white rounded-lg shadow-lg dark:text-black"> 
      <form method="POST" action="/logout" class="absolute top-8 right-8 z-20" @submit.prevent="logout">
        <button type="submit" class="btn-principal bg-blue-400 text-black px-6 py-3 rounded-xl shadow hover:bg-blue-800 hover:text-white font-semibold text-lg transition-all">
          Desconectar
        </button>
      </form>
      <header class="text-center font-bold text-xl">Faça seu Agendamento</header>
      <!-- Menu suspenso Especialidade -->
      <div class="mb-4 w-full">
        <label class="block text-gray-700">Especialidade</label>
        <select class="w-full p-2 border rounded" v-model="especialidadeSelecionada">
          <option disabled value="">Selecione uma especialidade</option>
          <option v-for="e in especialidades" :key="e.id" :value="e.id">{{ e.nome }}</option>
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
            <option v-for="h in ['08:00', '10:00', '10:30', '11:00', '13:00', '14:00', '15:00', '16:00']" :key="h" :value="h">{{ h }}</option>
          </select>
        </div>
      </div>
      <!-- Menu suspenso Médico (aparece só se especialidade, data e hora estiverem preenchidos) -->
      <div class="mb-4 w-full" v-if="especialidadeSelecionada && data && hora">
        <label class="block text-gray-700">Médico</label>
        <select class="w-full p-2 border rounded" v-model="medicoSelecionado">
          <option disabled value="">Selecione um médico</option>
          <option v-for="m in medicosDisponiveis" :key="m.id" :value="m.id">{{ m.nome }}</option>
        </select>
      </div>
      <!-- Campo Observação -->
      <div class="mb-4 w-full">
        <label class="block text-gray-700">Observação</label>
        <textarea class="w-full p-2 border rounded" rows="3" placeholder="Digite uma observação..." v-model="observacao"></textarea>
      </div>
      <!-- Botão para abrir modal de confirmação -->
      <div class="mb-4 w-full">
        <button @click="abrirModalConfirmacao" class="w-full p-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-all">
          Confirmar Agendamento
        </button>
      </div>
      <!-- Modal de confirmação -->
      <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-5 rounded shadow-md w-11/12 max-w-md">
          <h3 class="text-lg font-semibold mb-4">Deseja confirmar o agendamento?</h3>
          <p><strong>Médico:</strong> {{ agendamentoResumo.medico }}</p>
          <p><strong>Especialidade:</strong> {{ agendamentoResumo.especialidade }}</p>
          <p><strong>Data:</strong> {{ agendamentoResumo.data }}</p>
          <p><strong>Hora:</strong> {{ agendamentoResumo.hora }}</p>
          <p><strong>Observação:</strong> {{ agendamentoResumo.observacao }}</p>
          <div class="flex justify-end gap-2 mt-4">
            <button @click="fecharModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
            <button @click="confirmarAgendamento" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Agendar</button>
          </div>
        </div>
      </div>
      <!-- Alerta de sucesso/erro -->
      <div v-if="alerta" :class="['fixed top-6 right-6 z-50 px-4 py-2 rounded shadow-lg', alerta.tipo === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white']">
        {{ alerta.msg }}
      </div>
    </div>
  </div>
</template>
