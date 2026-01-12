<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { Calendar, Clock, User, Stethoscope, LogOut, List } from 'lucide-vue-next';

const especialidade = ref('');
const data = ref('');
const hora = ref('');
const medico = ref('');

const especialidades = ref<any[]>([]);
const medicos = ref<any[]>([]);
const showModal = ref(false);

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
    alert('Erro ao buscar medicos disponiveis');
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

function tentarAgendar() {
  if (especialidade.value && data.value && hora.value && medico.value) {
    showModal.value = true;
  } else {
    alert('Preencha todos os campos para agendar!');
  }
}

function confirmarAgendamento() {
  router.post('/agendamentos', {
    especialidade_id: especialidade.value,
    medico_id: medico.value,
    data: data.value,
    hora: hora.value,
    observacao: '',
  }, {
    onSuccess() {
      showModal.value = false;
      especialidade.value = '';
      data.value = '';
      hora.value = '';
      medico.value = '';
      alert('Agendamento realizado com sucesso!');
      router.get('/agendamentos/lista');
    },
    onError(errors) {
      if (errors && errors.error) {
        alert(errors.error);
      } else {
        alert('Erro ao agendar. Tente novamente.');
      }
    }
  });
}

function cancelarAgendamento() {
  showModal.value = false;
}
</script>

<template>

  <Head title="Agendamento" />
  <div class="min-h-screen netflix-bg">
    <!-- Header Netflix Style -->
    <header class="netflix-header flex items-center justify-between">
      <div class="netflix-logo text-3xl">SGCM</div>
      <div class="flex gap-4">
        <button @click="router.get('/agendamentos/lista')"
          class="flex items-center gap-2 px-6 py-2 bg-transparent border border-[#E50914] text-white rounded hover:bg-[#E50914] transition-all duration-300">
          <List class="w-4 h-4" />
          Minhas Consultas
        </button>
        <button @click="logout"
          class="flex items-center gap-2 px-6 py-2 bg-[#E50914] text-white rounded hover:bg-[#F40612] transition-all duration-300">
          <LogOut class="w-4 h-4" />
          Sair
        </button>
      </div>
    </header>

    <!-- Main Content -->
    <main class="pt-32 px-8 pb-16">
      <div class="max-w-4xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12">
          <h1 class="text-5xl font-bold text-white mb-4">Agende sua Consulta</h1>
          <p class="text-[#B3B3B3] text-xl">Selecione a especialidade, data e horario desejados</p>
        </div>

        <!-- Booking Card -->
        <div class="netflix-modal-content p-8 rounded-lg">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Especialidade -->
            <div class="flex flex-col gap-2">
              <label class="text-[#E50914] font-semibold flex items-center gap-2">
                <Stethoscope class="w-5 h-5" />
                Especialidade
              </label>
              <select v-model="especialidade" class="netflix-select">
                <option value="" disabled>Selecione a especialidade</option>
                <option v-for="esp in especialidades" :key="esp.id" :value="esp.id">
                  {{ esp.nome }}
                </option>
              </select>
            </div>

            <!-- Data -->
            <div class="flex flex-col gap-2">
              <label class="text-[#E50914] font-semibold flex items-center gap-2">
                <Calendar class="w-5 h-5" />
                Data
              </label>
              <input type="date" v-model="data" class="netflix-select" />
            </div>

            <!-- Hora -->
            <div class="flex flex-col gap-2">
              <label class="text-[#E50914] font-semibold flex items-center gap-2">
                <Clock class="w-5 h-5" />
                Horario
              </label>
              <select v-model="hora" class="netflix-select">
                <option value="" disabled>Selecione o horario</option>
                <option value="08:00">08:00</option>
                <option value="10:00">10:00</option>
                <option value="12:00">12:00</option>
                <option value="14:00">14:00</option>
                <option value="16:00">16:00</option>
              </select>
            </div>

            <!-- Medico -->
            <div v-if="especialidade && data && hora" class="flex flex-col gap-2">
              <label class="text-[#E50914] font-semibold flex items-center gap-2">
                <User class="w-5 h-5" />
                Medico
              </label>
              <select v-model="medico" class="netflix-select">
                <option value="" disabled>Selecione um Medico</option>
                <option v-for="med in medicos" :key="med.id" :value="med.id">
                  {{ med.nome }}
                </option>
              </select>
            </div>
          </div>

          <!-- Submit Button -->
          <button @click="tentarAgendar" class="netflix-btn w-full mt-8 py-4 text-lg">
            Agendar Consulta
          </button>
        </div>

        <!-- Features Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
          <div
            class="bg-[#181818] p-6 rounded-lg border border-[#333] hover:border-[#E50914] transition-all duration-300">
            <Calendar class="w-10 h-10 text-[#E50914] mb-4" />
            <h3 class="text-white font-bold text-lg mb-2">Agendamento Facil</h3>
            <p class="text-[#B3B3B3]">Agende sua consulta em poucos cliques</p>
          </div>
          <div
            class="bg-[#181818] p-6 rounded-lg border border-[#333] hover:border-[#E50914] transition-all duration-300">
            <User class="w-10 h-10 text-[#E50914] mb-4" />
            <h3 class="text-white font-bold text-lg mb-2">Profissionais Qualificados</h3>
            <p class="text-[#B3B3B3]">Equipe medica de alta qualidade</p>
          </div>
          <div
            class="bg-[#181818] p-6 rounded-lg border border-[#333] hover:border-[#E50914] transition-all duration-300">
            <Clock class="w-10 h-10 text-[#E50914] mb-4" />
            <h3 class="text-white font-bold text-lg mb-2">Horarios Flexiveis</h3>
            <p class="text-[#B3B3B3]">Diversos horarios disponiveis para voce</p>
          </div>
        </div>
      </div>
    </main>

    <!-- Modal de Confirmacao -->
    <div v-if="showModal" class="fixed inset-0 netflix-modal flex items-center justify-center z-50">
      <div class="netflix-modal-content p-8 w-full max-w-md animate-fadeIn">
        <h2 class="text-2xl font-bold text-white mb-4">Confirmar Agendamento</h2>
        <p class="text-[#B3B3B3] mb-6">
          <strong class="text-[#E50914]">Atencao:</strong> Ao agendar uma consulta, voce estara reservando
          o horario de um profissional. Caso nao possa comparecer, lembre-se de cancelar com antecedencia.
        </p>
        <div class="flex gap-4">
          <button @click="cancelarAgendamento"
            class="flex-1 py-3 bg-[#333] text-white rounded hover:bg-[#454545] transition-all duration-300">
            Cancelar
          </button>
          <button @click="confirmarAgendamento" class="flex-1 py-3 netflix-btn">
            Confirmar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
