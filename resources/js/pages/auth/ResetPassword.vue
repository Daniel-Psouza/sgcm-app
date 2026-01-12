<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

interface Props {
    token: string;
    email: string;
}

const props = defineProps<Props>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <Head title="Redefinir Senha" />
    <div class="min-h-screen netflix-bg flex flex-col items-center justify-center px-4">
        <!-- Netflix Logo -->
        <div class="netflix-logo text-4xl mb-8">SGCM</div>
        
        <!-- Reset Password Card -->
        <div class="netflix-card w-full max-w-md">
            <h1 class="text-3xl font-bold text-white mb-4">Redefinir Senha</h1>
            <p class="text-[#B3B3B3] mb-8">
                Digite sua nova senha abaixo.
            </p>
            
            <form @submit.prevent="submit" class="flex flex-col gap-5">
                <div class="flex flex-col gap-2">
                    <Input 
                        id="email" 
                        type="email" 
                        autocomplete="email" 
                        v-model="form.email" 
                        class="netflix-input h-14 opacity-60"
                        readonly
                    />
                    <InputError :message="form.errors.email" />
                </div>
                
                <div class="flex flex-col gap-2">
                    <Input 
                        id="password" 
                        type="password" 
                        required 
                        autofocus
                        autocomplete="new-password" 
                        v-model="form.password" 
                        placeholder="Nova senha"
                        class="netflix-input h-14"
                    />
                    <InputError :message="form.errors.password" />
                </div>
                
                <div class="flex flex-col gap-2">
                    <Input 
                        id="password_confirmation" 
                        type="password" 
                        required 
                        autocomplete="new-password" 
                        v-model="form.password_confirmation" 
                        placeholder="Confirmar nova senha"
                        class="netflix-input h-14"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>
                
                <Button 
                    type="submit"
                    class="netflix-btn w-full h-14 text-base font-bold mt-4" 
                    :disabled="form.processing"
                >
                    <LoaderCircle v-if="form.processing" class="h-5 w-5 animate-spin mr-2" />
                    Redefinir Senha
                </Button>
            </form>
        </div>
    </div>
</template>
