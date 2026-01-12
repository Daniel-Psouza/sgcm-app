<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance';
import { Monitor, Moon, Sun } from 'lucide-vue-next';

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', Icon: Sun, label: 'Claro' },
    { value: 'dark', Icon: Moon, label: 'Escuro' },
    { value: 'system', Icon: Monitor, label: 'Sistema' },
] as const;
</script>

<template>
    <div class="flex flex-wrap gap-4">
        <button
            v-for="{ value, Icon, label } in tabs"
            :key="value"
            @click="updateAppearance(value)"
            :class="[
                'flex flex-col items-center gap-3 p-6 rounded-lg border-2 transition-all duration-300 min-w-[140px]',
                appearance === value
                    ? 'bg-[#E50914]/20 border-[#E50914] text-white'
                    : 'bg-[#181818] border-[#333] text-[#B3B3B3] hover:border-[#E50914]/50 hover:text-white'
            ]"
        >
            <component :is="Icon" class="w-8 h-8" />
            <span class="text-sm font-medium">{{ label }}</span>
        </button>
    </div>
</template>
