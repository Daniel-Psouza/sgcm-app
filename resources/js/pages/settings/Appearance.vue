<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppearanceTabs from '@/components/AppearanceTabs.vue';
import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { Palette } from 'lucide-vue-next';

const breadcrumbItems: BreadcrumbItem[] = [
    { title: 'Configuracoes de Aparencia', href: '/settings/appearance' },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Configuracoes de Aparencia" />

        <SettingsLayout>
            <div class="space-y-6">
                <div class="flex items-center gap-4 mb-8">
                    <div class="p-4 bg-[#E50914]/20 rounded-full">
                        <Palette class="w-8 h-8 text-[#E50914]" />
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Aparencia</h2>
                        <p class="text-[#B3B3B3]">Personalize a aparencia do sistema</p>
                    </div>
                </div>
                <AppearanceTabs />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
