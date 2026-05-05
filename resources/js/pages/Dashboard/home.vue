<script setup>
import { ref, reactive, onMounted } from 'vue';
import Index from '../AdminLayout/index.vue';
</script>

<template>
    <Index>
        <template #title>Dashboard</template>
        <h1>đây là Dashboard</h1>
    </Index>
</template>

<style scoped></style>
