<template>
    <button :type="type" class="rounded-md bg-gradient-to-r from-yellow-200 via-yellow-300 to-yellow-200 px-4 py-2 text-center text-sm sm:text-xl font-bold text-black transition-all transition duration-100 duration-300 hover:shadow-xl">
        <slot />
    </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>
