<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
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

    <Head title="Cadastro" />
    <div class="min-h-screen netflix-bg flex flex-col items-center justify-center px-4 py-8">
        <!-- Netflix Logo -->
        <div class="netflix-logo text-4xl mb-8">SGCM</div>

        <!-- Register Card -->
        <div class="netflix-card w-full max-w-md">
            <h1 class="text-3xl font-bold text-white mb-8">Criar Conta</h1>

            <form @submit.prevent="submit" class="flex flex-col gap-5">
                <div class="flex flex-col gap-2">
                    <Input id="name" type="text" required autofocus autocomplete="name" v-model="form.name"
                        placeholder="Nome completo" class="netflix-input h-14" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="flex flex-col gap-2">
                    <Input id="email" type="email" required autocomplete="email" v-model="form.email"
                        placeholder="E-mail" class="netflix-input h-14" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="flex flex-col gap-2">
                    <Input id="password" type="password" required autocomplete="new-password" v-model="form.password"
                        placeholder="Senha" class="netflix-input h-14" />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="flex flex-col gap-2">
                    <Input id="password_confirmation" type="password" required autocomplete="new-password"
                        v-model="form.password_confirmation" placeholder="Confirmar senha" class="netflix-input h-14" />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit" class="netflix-btn w-full h-14 text-base font-bold mt-4"
                    :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-5 w-5 animate-spin mr-2" />
                    Criar Conta
                </Button>
            </form>

            <div class="mt-10">
                <p class="text-[#737373]">
                    Ja tem uma conta?
                    <TextLink :href="route('login')" class="text-white hover:underline">
                        Entrar
                    </TextLink>
                </p>
            </div>
        </div>
    </div>
</template>
