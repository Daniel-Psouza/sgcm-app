<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
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
  <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-200 via-white to-blue-400 relative dark:text-black">
    <div class="flex flex-col items-center justify-center w-80 z-10" style="margin-top: 80px; margin-bottom: 40px;">
        <Head title="Entrar" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6 p-6 bg-white/90 rounded-xl shadow-lg w-full">
          <header class="text-center font-bold">Login</header>
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Email</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="exemplo@emai.com"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Senha</Label>
                    </div>
                    <Input
                    id="password"
                    type="password"
                    required
                    :tabindex="2"
                    autocomplete="current-password"
                    v-model="form.password"
                    placeholder="Senha"
                    />
                    <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm dark:text-black" :tabindex="5">
                        Esqueceu a senha?
                    </TextLink>
                    <InputError :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
                        <span>Manter Conectado</span>
                    </Label>
                </div>

                <Button type="submit" class="mt-4 w-full " :tabindex="4" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 " />
                    Entrar
                </Button>
            </div>
            
            <div class="text-center text-sm text-muted-foreground ">
                Não possui uma conta?
                <TextLink :href="route('register')" :tabindex="5" >Cadastre-se</TextLink>
            </div>
        </form>
    </div>
  </div>
</template>
