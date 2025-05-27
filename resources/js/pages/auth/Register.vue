<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <div
        class="h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-200 via-white to-blue-400 dark:from-gray-900 dark:via-gray-700 dark:to-blue-900 relative transition-colors">
        <div class="flex flex-col items-center justify-center">

            <Head title="Cadastrar" />
            <div class="bg-white/95 dark:bg-gray-900/95 rounded-2xl shadow-2xl p-6 border-4 border-blue-500 dark:border-blue-700 transition-colors">
                <div class="flex flex-col items-center mb-3">
                    <img src="/copio.png" alt="Logo ClinicSys" class="sm:w-20 sm:h-20 mb-2 drop-shadow" />
                    <h2
                        class="text-xl sm:text-3xl font-extrabold text-blue-500 dark:text-blue-400 text-center  tracking-tight">
                        Crie sua conta no ClinicSys</h2>
                </div>
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-5">
                        <div class="grid gap-2">
                            <Label for="name" class="text-black dark:text-white">Nome</Label>
                            <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name"
                                v-model="form.name" placeholder="Nome"
                                class="text-black dark:text-white dark:bg-gray-800 placeholder:text-gray-500 dark:placeholder:text-gray-400" />
                            <InputError :message="form.errors.name" class="text-red-600 dark:text-red-400" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="email" class="text-black dark:text-white">E-mail</Label>
                            <Input id="email" type="email" required autocomplete="email"
                                v-model="form.email" placeholder="exemplo@email.com"
                                class="text-black dark:text-white dark:bg-gray-800 placeholder:text-gray-500 dark:placeholder:text-gray-400" />
                            <InputError :message="form.errors.email" class="text-red-600 dark:text-red-400" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="password" class="text-black dark:text-white">Senha</Label>
                            <Input id="password" type="password" required :tabindex="3" autocomplete="new-password"
                                v-model="form.password" placeholder="Senha"
                                class="text-black dark:text-white dark:bg-gray-800 placeholder:text-gray-500 dark:placeholder:text-gray-400" />
                            <InputError :message="form.errors.password" class="text-red-600 dark:text-red-400" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="password_confirmation" class="text-black dark:text-white">Confirme sua
                                Senha</Label>
                            <Input id="password_confirmation" type="password" required :tabindex="4"
                                autocomplete="new-password" v-model="form.password_confirmation"
                                placeholder="Confirmar Senha"
                                class="text-black dark:text-white dark:bg-gray-800 placeholder:text-gray-500 dark:placeholder:text-gray-400" />
                            <InputError :message="form.errors.password_confirmation"
                                class="text-red-600 dark:text-red-400" />
                        </div>
                        <Button type="submit"
                            class=" w-full bg-blue-500 hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 rounded-xl shadow transition-all"
                            tabindex="5" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Criar conta
                        </Button>
                    </div>
                    <div class="text-center text-sm text-gray-400 dark:text-gray-300">
                        Já possui uma conta?
                        <TextLink :href="route('login')"
                            class="text-blue-600 dark:text-blue-300 underline underline-offset-4" :tabindex="6">Entre
                        </TextLink>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
