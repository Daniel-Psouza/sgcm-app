<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

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
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-200 via-white to-blue-400 relative">
        <div class="flex flex-col items-center justify-center w-80 z-10" style="margin-top: 80px; margin-bottom: 40px;">

            <Head title="Mudar senha" />

            <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <div class="space-y-6 flex flex-col gap-6 p-6 bg-white/90 rounded-xl shadow-lg w-full">
                <form @submit.prevent="submit">
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input id="email" type="email" name="email" autocomplete="off" v-model="form.email" autofocus
                            placeholder="exemplo@email.com" />
                        <InputError :message="form.errors.email ? 'O campo email é necessário' : ''" />
                    </div>

                    <div class="my-6 flex items-center justify-start">
                        <Button class="w-full" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Resetar Senha do Email
                        </Button>
                    </div>
                </form>


                    <div class="space-x-1 text-center text-sm text-muted-foreground">
                        <span>Retorne para</span>
                        <TextLink :href="route('login')">Entar</TextLink>
                    </div>
            </div>
        </div>
    </div>
</template>
