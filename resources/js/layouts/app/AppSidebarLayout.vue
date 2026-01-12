<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <div class="min-h-screen w-full flex netflix-bg">
        <aside class="netflix-sidebar w-64 flex flex-col py-8 px-4 shadow-lg">
            <div class="netflix-logo mb-8">SGCM</div>
            <nav class="flex flex-col gap-4">
                <slot name="sidebar-nav" />
            </nav>
        </aside>
        <main class="flex-1 flex flex-col items-center justify-start py-8">
            <div class="w-full max-w-6xl">
                <AppSidebarHeader :breadcrumbs="breadcrumbs" />
                <slot />
            </div>
        </main>
    </div>
</template>
