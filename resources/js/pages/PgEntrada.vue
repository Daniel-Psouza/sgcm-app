<script setup lang='ts'>
import { router } from '@inertiajs/vue3';

function goToLogin() {
    router.visit(route('login'));
}
</script>

<template>
    <div class="bg-blue-500 text-white h-screen flex flex-col">
        <div class="flex justify-end pr-8 mt-8">
            <button class="bg-blue-900 text-white p-2 rounded-lg" @click="goToLogin">
                Login
            </button>
        </div>
        <div class="text-center mt-28 text-xl">
            <h1 class="inline-block mx-auto bg-blue-900 p-4 rounded-lg ">
                Sistema de Gerenciamento de Clínicas Médicas</h1>
        </div>
    </div>

</template>
