<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { type BreadcrumbItem } from '@/types';
import { LoaderCircle, Lock, Check } from 'lucide-vue-next';

const breadcrumbItems: BreadcrumbItem[] = [
    { title: 'Configuracoes de Senha', href: '/settings/password' },
];

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: (errors: any) => {
            if (errors.password) {
                form.reset('password', 'password_confirmation');
                if (passwordInput.value instanceof HTMLInputElement) {
                    passwordInput.value.focus();
                }
            }
            if (errors.current_password) {
                form.reset('current_password');
                if (currentPasswordInput.value instanceof HTMLInputElement) {
                    currentPasswordInput.value.focus();
                }
            }
        },
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Configuracoes de Senha" />

        <SettingsLayout>
            <div class="space-y-6">
                <div class="flex items-center gap-4 mb-8">
                    <div class="p-4 bg-[#E50914]/20 rounded-full">
                        <Lock class="w-8 h-8 text-[#E50914]" />
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Alterar Senha</h2>
                        <p class="text-[#B3B3B3]">Use uma senha longa e segura</p>
                    </div>
                </div>

                <form @submit.prevent="updatePassword" class="space-y-6">
                    <div class="space-y-2">
                        <Label for="current_password" class="text-[#B3B3B3]">Senha Atual</Label>
                        <Input
                            id="current_password"
                            ref="currentPasswordInput"
                            v-model="form.current_password"
                            type="password"
                            autocomplete="current-password"
                            placeholder="Senha atual"
                            class="netflix-input h-12"
                        />
                        <InputError :message="form.errors.current_password" />
                    </div>

                    <div class="space-y-2">
                        <Label for="password" class="text-[#B3B3B3]">Nova Senha</Label>
                        <Input
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            autocomplete="new-password"
                            placeholder="Nova senha"
                            class="netflix-input h-12"
                        />
                        <InputError :message="form.errors.password" />
                    </div>

                    <div class="space-y-2">
                        <Label for="password_confirmation" class="text-[#B3B3B3]">Confirmar Nova Senha</Label>
                        <Input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            autocomplete="new-password"
                            placeholder="Confirmar nova senha"
                            class="netflix-input h-12"
                        />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <Button type="submit" class="netflix-btn px-8 py-3" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin mr-2" />
                            Atualizar Senha
                        </Button>
                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <span v-show="form.recentlySuccessful" class="flex items-center gap-2 text-green-400">
                                <Check class="w-4 h-4" />
                                Senha alterada!
                            </span>
                        </Transition>
                    </div>
                </form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
