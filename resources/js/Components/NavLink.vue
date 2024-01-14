<template>
    <Link :href="href" :class="classes">
    <slot name="icon" />
    <span class="mx-3">
        <slot />
    </span>
    </Link>
</template>

<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'flex items-center py-3 px-3 bg-gray-700 bg-opacity-25 text-yellow-100 font-bold'
    : 'flex items-center py-3 px-3 text-yellow-800'
);
</script>
