<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
const page = usePage();
const csrfToken = page.props.value?.csrf_token || document.querySelector('meta[name=csrf-token]')?.getAttribute('content');

function logout() {
    router.post('/logout', {}, {
        onFinish: () => {
            router.visit('/');
        }
    });
}


</script>

<template>
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-300 via-white to-blue-400 relative">
        <div class="flex flex-col items-center justify-center w-full max-w-lg z-10"
            style="margin-top: 80px; margin-bottom: 40px;">
        <form method="POST" action="/logout" class="absolute top-8 right-8 z-20" @submit.prevent="logout">
            <input type="hidden" name="_token" :value="csrfToken" />
            <button type="submit"
                class="btn-principal bg-blue-400 text-black px-6 py-3 rounded-xl shadow hover:bg-blue-800 hover:text-white font-semibold text-lg transition-all">
                Desconectar
            </button>
        </form>
            <Head title="Atendimento" />
            <div
                class="flex flex-col items-center justify-center min-h-[60vh] gap-8 p-8 bg-white/90 rounded-2xl shadow-2xl border border-blue-200">
                <h1 class="text-3xl font-extrabold text-black mb-6 text-center drop-shadow">
                    Sistema de Gerenciamento de Clínicas Médicas
                </h1>
                <nav class="flex flex-col sm:flex-row flex-wrap justify-center items-center gap-6 w-full">
                    <a href="/pacientes"
                        class="btn-principal bg-blue-400 text-black px-6 py-3 rounded-xl shadow hover:bg-blue-800 font-semibold text-lg transition-all">
                        Pacientes
                    </a>
                    <a href="/medicos"
                        class="btn-principal bg-blue-400 text-black px-6 py-3 rounded-xl shadow hover:bg-blue-800 font-semibold text-lg transition-all">
                        Médicos
                    </a>
                    <a href="/especialidades"
                        class="btn-principal bg-blue-400 text-black px-6 py-3 rounded-xl shadow hover:bg-blue-800 font-semibold text-lg transition-all">
                        Especialidades
                    </a>
                    <a href="/consultas"
                        class="btn-principal bg-blue-400 text-black px-6 py-3 rounded-xl shadow hover:bg-blue-800 font-semibold text-lg transition-all">
                        Consultas
                    </a>
                </nav>
            </div>
        </div>
    </div>
</template>
