<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle, Mail } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};
</script>

<template>

    <Head title="Verificar E-mail" />
    <div class="min-h-screen netflix-bg flex flex-col items-center justify-center px-4">
        <!-- Netflix Logo -->
        <div class="netflix-logo text-4xl mb-8">SGCM</div>

        <!-- Verify Email Card -->
        <div class="netflix-card w-full max-w-md text-center">
            <div class="p-4 bg-[#E50914]/20 rounded-full w-fit mx-auto mb-6">
                <Mail class="w-12 h-12 text-[#E50914]" />
            </div>

            <h1 class="text-3xl font-bold text-white mb-4">Verifique seu E-mail</h1>
            <p class="text-[#B3B3B3] mb-8">
                Obrigado por se cadastrar! Antes de comecar, voce precisa verificar seu e-mail
                clicando no link que acabamos de enviar.
            </p>

            <div v-if="status === 'verification-link-sent'"
                class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded text-green-400 text-sm">
                Um novo link de verificacao foi enviado para o seu e-mail.
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <Button type="submit" class="netflix-btn w-full h-14 text-base font-bold" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-5 w-5 animate-spin mr-2" />
                    Reenviar E-mail de Verificacao
                </Button>
            </form>

            <div class="mt-8 pt-6 border-t border-[#333]">
                <TextLink :href="route('logout')" method="post" as="button" class="text-[#B3B3B3] hover:text-white">
                    Sair da conta
                </TextLink>
            </div>
        </div>
    </div>
</template>
