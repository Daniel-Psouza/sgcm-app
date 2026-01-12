<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { LoaderCircle } from 'lucide-vue-next';

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

    <Head title="Entrar" />
    <div class="min-h-screen netflix-bg flex flex-col items-center justify-center px-4">
        <!-- Netflix Logo -->
        <div class="netflix-logo text-4xl mb-8">SGCM</div>

        <!-- Login Card -->
        <div class="netflix-card w-full max-w-md">
            <h1 class="text-3xl font-bold text-white mb-8">Entrar</h1>

            <form @submit.prevent="submit" class="flex flex-col gap-6">
                <div class="flex flex-col gap-2">
                    <Input id="email" type="email" required autofocus autocomplete="email" v-model="form.email"
                        placeholder="E-mail ou numero de telefone" class="netflix-input h-14" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="flex flex-col gap-2">
                    <Input id="password" type="password" required autocomplete="current-password"
                        v-model="form.password" placeholder="Senha" class="netflix-input h-14" />
                    <InputError :message="form.errors.password" />
                </div>

                <Button type="submit" class="netflix-btn w-full h-14 text-base font-bold mt-4"
                    :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-5 w-5 animate-spin mr-2" />
                    Entrar
                </Button>

                <div class="flex items-center justify-between mt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input id="remember" type="checkbox" v-model="form.remember"
                            class="w-4 h-4 accent-[#E50914] bg-[#333] border-none rounded" />
                        <span class="text-[#B3B3B3] text-sm">Lembre-se de mim</span>
                    </label>
                    <TextLink :href="route('password.request')" class="text-[#B3B3B3] hover:text-white text-sm">
                        Precisa de ajuda?
                    </TextLink>
                </div>
            </form>

            <div class="mt-12">
                <p class="text-[#737373]">
                    Novo no SGCM?
                    <TextLink :href="route('register')" class="text-white hover:underline">
                        Cadastre-se agora
                    </TextLink>
                </p>
            </div>

            <p class="text-[#8c8c8c] text-xs mt-4">
                Esta pagina e protegida pelo Google reCAPTCHA para garantir que voce nao e um robo.
            </p>
        </div>
    </div>
</template>
