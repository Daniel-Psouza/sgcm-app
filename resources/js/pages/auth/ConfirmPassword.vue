<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle, Lock } from 'lucide-vue-next';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Confirmar Senha" />
    <div class="min-h-screen netflix-bg flex flex-col items-center justify-center px-4">
        <!-- Netflix Logo -->
        <div class="netflix-logo text-4xl mb-8">SGCM</div>
        
        <!-- Confirm Password Card -->
        <div class="netflix-card w-full max-w-md">
            <div class="p-4 bg-[#E50914]/20 rounded-full w-fit mx-auto mb-6">
                <Lock class="w-12 h-12 text-[#E50914]" />
            </div>
            
            <h1 class="text-3xl font-bold text-white mb-4 text-center">Confirmar Senha</h1>
            <p class="text-[#B3B3B3] mb-8 text-center">
                Esta e uma area segura. Por favor, confirme sua senha antes de continuar.
            </p>
            
            <form @submit.prevent="submit" class="flex flex-col gap-6">
                <div class="flex flex-col gap-2">
                    <Input 
                        id="password" 
                        type="password" 
                        required 
                        autofocus 
                        autocomplete="current-password" 
                        v-model="form.password" 
                        placeholder="Sua senha"
                        class="netflix-input h-14"
                    />
                    <InputError :message="form.errors.password" />
                </div>
                
                <Button 
                    type="submit"
                    class="netflix-btn w-full h-14 text-base font-bold" 
                    :disabled="form.processing"
                >
                    <LoaderCircle v-if="form.processing" class="h-5 w-5 animate-spin mr-2" />
                    Confirmar
                </Button>
            </form>
        </div>
    </div>
</template>
