<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppHeader from '@/components/AppHeader.vue';
import AppShell from '@/components/AppShell.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <div class="min-h-screen w-full flex flex-col netflix-bg">
        <header class="netflix-header flex items-center justify-between px-8 py-4">
            <div class="netflix-logo">SGCM</div>
            <nav class="flex gap-6">
                <slot name="header-nav" />
            </nav>
        </header>
        <main class="flex-1 flex flex-col items-center justify-start py-8">
            <div class="w-full max-w-6xl">
                <slot />
            </div>
        </main>
    </div>
</template>
