<template>
    <button type="button" @click="closeToast()" v-show="visible" x-transition.duration.300ms
        class="fixed right-4 top-4 z-50 rounded-md bg-green-500 px-4 py-2 text-white transition hover:bg-green-600">
        <div class="flex items-center space-x-2">
            <span class="text-3xl"><i class="fa fa-check"></i></span>
            <p class="font-bold">
                <slot v-if="show" />
            </p>
        </div>
    </button>
</template>

<script setup>
import { onMounted, ref } from 'vue';


const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    }
});

const visible = ref(true);

onMounted(() => {
    setTimeout(() => {
        visible.value = false;
    }, 4000);
})
</script>