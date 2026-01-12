<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { User, Lock, Palette, ArrowLeft } from 'lucide-vue-next';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Perfil',
        href: '/settings/profile',
        icon: 'user',
    },
    {
        title: 'Senha',
        href: '/settings/password',
        icon: 'lock',
    },
    {
        title: 'Aparencia',
        href: '/settings/appearance',
        icon: 'palette',
    },
];

const page = usePage();
const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';

const icons = {
    user: User,
    lock: Lock,
    palette: Palette,
};
</script>

<template>
    <div class="min-h-screen netflix-bg py-8 px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <Link href="/dashboard" class="flex items-center gap-2 text-[#B3B3B3] hover:text-white mb-4 transition-colors">
                    <ArrowLeft class="w-5 h-5" />
                    Voltar
                </Link>
                <h1 class="text-4xl font-bold text-white">Configuracoes</h1>
                <p class="text-[#B3B3B3] mt-2">Gerencie suas configuracoes de conta</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <aside class="lg:w-64">
                    <nav class="netflix-modal-content rounded-lg p-4 space-y-2">
                        <Link
                            v-for="item in sidebarNavItems"
                            :key="item.href"
                            :href="item.href"
                            :class="[
                                'flex items-center gap-3 px-4 py-3 rounded transition-all duration-200',
                                currentPath === item.href 
                                    ? 'bg-[#E50914] text-white' 
                                    : 'text-[#B3B3B3] hover:bg-[#333] hover:text-white'
                            ]"
                        >
                            <component :is="icons[item.icon]" class="w-5 h-5" />
                            {{ item.title }}
                        </Link>
                    </nav>
                </aside>

                <!-- Content -->
                <div class="flex-1">
                    <div class="netflix-modal-content rounded-lg p-8">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
