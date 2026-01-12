<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="min-h-screen netflix-bg flex flex-col items-center justify-center px-4">
        <slot />
    </div>
</template>
