<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle, ArrowLeft } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Recuperar Senha" />
    <div class="min-h-screen netflix-bg flex flex-col items-center justify-center px-4">
        <!-- Netflix Logo -->
        <div class="netflix-logo text-4xl mb-8">SGCM</div>
        
        <!-- Forgot Password Card -->
        <div class="netflix-card w-full max-w-md">
            <h1 class="text-3xl font-bold text-white mb-4">Esqueceu a senha?</h1>
            <p class="text-[#B3B3B3] mb-8">
                Digite seu e-mail e enviaremos um link para redefinir sua senha.
            </p>

            <div v-if="status" class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded text-green-400 text-sm">
                {{ status }}
            </div>
            
            <form @submit.prevent="submit" class="flex flex-col gap-6">
                <div class="flex flex-col gap-2">
                    <Input 
                        id="email" 
                        type="email" 
                        required 
                        autofocus 
                        autocomplete="email" 
                        v-model="form.email" 
                        placeholder="E-mail"
                        class="netflix-input h-14"
                    />
                    <InputError :message="form.errors.email ? 'O campo email e necessario' : ''" />
                </div>
                
                <Button 
                    type="submit"
                    class="netflix-btn w-full h-14 text-base font-bold" 
                    :disabled="form.processing"
                >
                    <LoaderCircle v-if="form.processing" class="h-5 w-5 animate-spin mr-2" />
                    Enviar Link de Recuperacao
                </Button>
            </form>
            
            <div class="mt-8">
                <TextLink :href="route('login')" class="flex items-center gap-2 text-[#B3B3B3] hover:text-white">
                    <ArrowLeft class="w-4 h-4" />
                    Voltar para o login
                </TextLink>
            </div>
        </div>
    </div>
</template>
