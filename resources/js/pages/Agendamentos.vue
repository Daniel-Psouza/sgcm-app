<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { LogOut, ArrowLeft, Phone, Mail, Calendar, Clock, User, Stethoscope } from 'lucide-vue-next';

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
  <Head title="Consultas Agendadas" />
  <div class="min-h-screen netflix-bg">
    <!-- Header Netflix Style -->
    <header class="netflix-header flex items-center justify-between">
      <div class="flex items-center gap-8">
        <div class="netflix-logo text-3xl">SGCM</div>
        <button @click="router.get('/dashboard')"
          class="flex items-center gap-2 text-[#B3B3B3] hover:text-white transition-colors">
          <ArrowLeft class="w-5 h-5" />
          Voltar ao Agendamento
        </button>
      </div>
      <button @click="logout"
        class="flex items-center gap-2 px-6 py-2 bg-[#E50914] text-white rounded hover:bg-[#F40612] transition-all duration-300">
        <LogOut class="w-4 h-4" />
        Sair
      </button>
    </header>

    <!-- Main Content -->
    <main class="pt-32 px-8 pb-16">
      <div class="max-w-6xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12">
          <h1 class="text-5xl font-bold text-white mb-4">Minhas Consultas</h1>
          <p class="text-[#B3B3B3] text-xl">Acompanhe seus agendamentos</p>
        </div>

        <!-- Table Section -->
        <div class="netflix-modal-content rounded-lg overflow-hidden">
          <div v-if="!agendamentos || agendamentos.length === 0" class="p-16 text-center">
            <Calendar class="w-16 h-16 text-[#E50914] mx-auto mb-4" />
            <p class="text-[#B3B3B3] text-xl">Nenhuma consulta agendada encontrada.</p>
            <button @click="router.get('/dashboard')" class="netflix-btn mt-6 px-8 py-3">
              Agendar Consulta
            </button>
          </div>
          
          <table v-else class="netflix-table">
            <thead>
              <tr>
                <th class="flex items-center gap-2">
                  <Calendar class="w-4 h-4 text-[#E50914]" />
                  Data
                </th>
                <th>
                  <div class="flex items-center gap-2">
                    <Clock class="w-4 h-4 text-[#E50914]" />
                    Hora
                  </div>
                </th>
                <th>
                  <div class="flex items-center gap-2">
                    <Stethoscope class="w-4 h-4 text-[#E50914]" />
                    Especialidade
                  </div>
                </th>
                <th>
                  <div class="flex items-center gap-2">
                    <User class="w-4 h-4 text-[#E50914]" />
                    Medico
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="ag in agendamentos" :key="ag.id" class="hover:bg-[#E50914]/10 transition-colors">
                <td>{{ formatarData(ag.data) }}</td>
                <td>{{ ag.hora }}</td>
                <td>{{ ag.especialidade_nome }}</td>
                <td>{{ ag.medico_nome }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Contact Info -->
        <div class="mt-12 netflix-modal-content p-8 rounded-lg">
          <h2 class="text-xl font-bold text-white mb-4">Precisa de Ajuda?</h2>
          <p class="text-[#B3B3B3] mb-6">
            Caso precise cancelar uma consulta ou tenha alguma duvida, entre em contato conosco:
          </p>
          <div class="flex flex-wrap gap-8">
            <div class="flex items-center gap-3">
              <div class="p-3 bg-[#E50914]/20 rounded-full">
                <Phone class="w-5 h-5 text-[#E50914]" />
              </div>
              <div>
                <p class="text-[#B3B3B3] text-sm">Telefone</p>
                <p class="text-white font-semibold">(11) 99999-9999</p>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <div class="p-3 bg-[#E50914]/20 rounded-full">
                <Mail class="w-5 h-5 text-[#E50914]" />
              </div>
              <div>
                <p class="text-[#B3B3B3] text-sm">E-mail</p>
                <p class="text-white font-semibold">contato@sgcm.com.br</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
