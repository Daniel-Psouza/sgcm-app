<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
<div class="h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-200 via-white to-blue-400 dark:from-gray-900 dark:via-gray-700 dark:to-blue-900 relative py-8 px-2 sm:px-6 lg:px-8 transition-colors">
    <div class="flex flex-col items-center justify-center w-full max-w-md z-10">
        <Head title="Entrar" />
        <div class="w-full bg-white/95 dark:bg-gray-900/95 rounded-2xl shadow-2xl p-6 sm:p-8 border-4 border-blue-500 dark:border-blue-700 transition-colors">
            <div class="flex flex-col items-center mb-6">
                <img src="/copio.png" alt="Logo ClinicSys" class="w-14 h-14 sm:w-20 sm:h-20 mb-2 drop-shadow" />
                <h2 class="text-2xl sm:text-3xl font-extrabold text-blue-500 dark:text-blue-400 text-center mb-1 tracking-tight">Acesse sua conta no ClinicSys</h2>
            </div>
            <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600 dark:text-green-400">
                {{ status }}
            </div>
            <form @submit.prevent="submit" class="flex flex-col gap-6">
                <div class="grid gap-5">
                    <div class="grid gap-2">
                        <Label for="email" class="text-black dark:text-white">E-mail</Label>
                        <Input
                            id="email"
                            type="email"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="email"
                            v-model="form.email"
                            placeholder="exemplo@email.com"
                            class="text-black dark:text-white dark:bg-gray-800 placeholder:text-gray-500 dark:placeholder:text-gray-400"
                        />
                        <InputError :message="form.errors.email" class="text-red-600 dark:text-red-400" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="password" class="text-black dark:text-white">Senha</Label>
                        <Input
                            id="password"
                            type="password"
                            required
                            :tabindex="2"
                            autocomplete="current-password"
                            v-model="form.password"
                            placeholder="Senha"
                            class="text-black dark:text-white dark:bg-gray-800 placeholder:text-gray-500 dark:placeholder:text-gray-400"
                        />
                        <InputError :message="form.errors.password" class="text-red-600 dark:text-red-400" />
                    </div>
                    <div class="flex items-center gap-2">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
                        <Label for="remember" class="text-black dark:text-white">Manter Conectado</Label>
                    </div>
                    <Button type="submit" class="mt-2 w-full bg-blue-500 hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 rounded-xl shadow transition-all" :tabindex="4" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        Entrar
                    </Button>
                </div>
                <div class="text-center text-sm text-gray-400 dark:text-gray-300 mt-2">
                    Não possui uma conta?
                    <TextLink :href="route('register')" class="text-blue-600 dark:text-blue-300 underline underline-offset-4" :tabindex="5">
                        Cadastre-se
                    </TextLink>
                </div>
            </form>
        </div>
    </div>
</div>
</template>
