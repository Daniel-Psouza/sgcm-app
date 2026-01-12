<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem, type SharedData, type User } from '@/types';
import { LoaderCircle, User as UserIcon, Mail, Check } from 'lucide-vue-next';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Configuracoes de Perfil', href: '/settings/profile' },
];

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Configuracoes de Perfil" />

        <SettingsLayout>
            <div class="space-y-6">
                <div class="flex items-center gap-4 mb-8">
                    <div class="p-4 bg-[#E50914]/20 rounded-full">
                        <UserIcon class="w-8 h-8 text-[#E50914]" />
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Informacoes do Perfil</h2>
                        <p class="text-[#B3B3B3]">Atualize seu nome e e-mail</p>
                    </div>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="space-y-2">
                        <Label for="name" class="text-[#B3B3B3]">Nome</Label>
                        <Input 
                            id="name" 
                            v-model="form.name" 
                            required 
                            autocomplete="name" 
                            placeholder="Nome completo"
                            class="netflix-input h-12"
                        />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="space-y-2">
                        <Label for="email" class="text-[#B3B3B3]">E-mail</Label>
                        <Input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="E-mail"
                            class="netflix-input h-12"
                        />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at" class="p-4 bg-yellow-500/20 border border-yellow-500 rounded text-yellow-400 text-sm">
                        <p>
                            Seu e-mail nao foi verificado.
                            <Link :href="route('verification.send')" method="post" as="button" class="underline hover:text-yellow-300">
                                Clique aqui para reenviar o e-mail de verificacao.
                            </Link>
                        </p>
                        <div v-if="status === 'verification-link-sent'" class="mt-2 text-green-400">
                            Um novo link de verificacao foi enviado para seu e-mail.
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <Button type="submit" class="netflix-btn px-8 py-3" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin mr-2" />
                            Salvar
                        </Button>
                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <span v-show="form.recentlySuccessful" class="flex items-center gap-2 text-green-400">
                                <Check class="w-4 h-4" />
                                Salvo!
                            </span>
                        </Transition>
                    </div>
                </form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
