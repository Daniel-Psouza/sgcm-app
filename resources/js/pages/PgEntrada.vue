<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Play, Calendar, Users, Shield } from 'lucide-vue-next';
</script>

<template>

  <Head title="SGCM - Sistema de Gestao de Consultas Medicas" />
  <div class="min-h-screen netflix-bg">
    <!-- Header -->
    <header class="netflix-header flex items-center justify-between">
      <div class="netflix-logo text-3xl">SGCM</div>
      <Link :href="route('login')" class="netflix-btn px-6 py-2 rounded text-sm font-semibold">
        Entrar
      </Link>
    </header>

    <!-- Hero Section -->
    <section class="pt-32 pb-16 px-8">
      <div class="max-w-6xl mx-auto">
        <div class="flex flex-col lg:flex-row items-center gap-12">
          <div class="flex-1 text-center lg:text-left">
            <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
              Agende suas consultas medicas com facilidade
            </h1>
            <p class="text-xl text-[#B3B3B3] mb-8">
              Sistema completo para gerenciamento de consultas. Agende, acompanhe e gerencie suas consultas
              de forma simples e rapida.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
              <Link :href="route('register')"
                class="netflix-btn px-8 py-4 rounded text-lg font-bold flex items-center justify-center gap-2">
                <Play class="w-6 h-6" />
                Comecar Agora
              </Link>
              <Link :href="route('login')"
                class="px-8 py-4 bg-[#333]/80 text-white rounded text-lg font-semibold hover:bg-[#333] transition-all duration-300">
                Ja tenho conta
              </Link>
            </div>
          </div>
          <div class="flex-1">
            <div class="relative">
              <div class="absolute inset-0 bg-gradient-to-r from-[#E50914]/20 to-transparent rounded-lg"></div>
              <div class="bg-[#181818] p-8 rounded-lg border border-[#333]">
                <div class="space-y-4">
                  <div class="h-4 bg-[#333] rounded w-3/4"></div>
                  <div class="h-4 bg-[#333] rounded w-1/2"></div>
                  <div class="h-12 bg-[#E50914]/20 rounded mt-6"></div>
                  <div class="h-12 bg-[#333] rounded"></div>
                  <div class="h-12 bg-[#333] rounded"></div>
                  <div class="h-12 bg-[#E50914] rounded mt-6"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 px-8 bg-black/50">
      <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-white text-center mb-12">Por que escolher o SGCM?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div
            class="bg-gradient-to-b from-[#181818] to-[#141414] p-8 rounded-lg border border-[#333] hover:border-[#E50914] transition-all duration-300 group">
            <div class="p-4 bg-[#E50914]/20 rounded-full w-fit mb-6 group-hover:bg-[#E50914]/30 transition-all">
              <Calendar class="w-8 h-8 text-[#E50914]" />
            </div>
            <h3 class="text-xl font-bold text-white mb-3">Agendamento Facil</h3>
            <p class="text-[#B3B3B3]">Agende suas consultas em poucos cliques, escolhendo data, horario e especialidade
              de forma pratica.</p>
          </div>
          <div
            class="bg-gradient-to-b from-[#181818] to-[#141414] p-8 rounded-lg border border-[#333] hover:border-[#E50914] transition-all duration-300 group">
            <div class="p-4 bg-[#E50914]/20 rounded-full w-fit mb-6 group-hover:bg-[#E50914]/30 transition-all">
              <Users class="w-8 h-8 text-[#E50914]" />
            </div>
            <h3 class="text-xl font-bold text-white mb-3">Profissionais Qualificados</h3>
            <p class="text-[#B3B3B3]">Acesso a uma rede de medicos especialistas prontos para atender voce com
              qualidade.</p>
          </div>
          <div
            class="bg-gradient-to-b from-[#181818] to-[#141414] p-8 rounded-lg border border-[#333] hover:border-[#E50914] transition-all duration-300 group">
            <div class="p-4 bg-[#E50914]/20 rounded-full w-fit mb-6 group-hover:bg-[#E50914]/30 transition-all">
              <Shield class="w-8 h-8 text-[#E50914]" />
            </div>
            <h3 class="text-xl font-bold text-white mb-3">Seguro e Confiavel</h3>
            <p class="text-[#B3B3B3]">Seus dados estao protegidos com as melhores praticas de seguranca do mercado.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-8">
      <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-4xl font-bold text-white mb-6">Pronto para comecar?</h2>
        <p class="text-xl text-[#B3B3B3] mb-8">
          Crie sua conta gratuitamente e comece a agendar suas consultas hoje mesmo.
        </p>
        <Link :href="route('register')" class="netflix-btn px-12 py-4 rounded text-lg font-bold inline-block">
          Criar Conta Gratis
        </Link>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 px-8 border-t border-[#333]">
      <div class="max-w-6xl mx-auto text-center">
        <div class="netflix-logo text-2xl mb-4">SGCM</div>
        <p class="text-[#737373] text-sm">
          &copy; 2026 Sistema de Gestao de Consultas Medicas. Todos os direitos reservados.
        </p>
      </div>
    </footer>
  </div>
</template>
