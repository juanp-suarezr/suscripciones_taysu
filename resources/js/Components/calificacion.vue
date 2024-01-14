<template>
    <div class="stars-outer">
        <div class="stars-inner" :style="{ width: starPercentageRounded }"></div>
    </div>
</template>
  
<script setup>
import { defineProps, ref, watch, computed } from 'vue';

const props = defineProps(['calificacion']);


// total number of stars
const starTotal = 5;

const starPercentage = computed(() => (props.calificacion / starTotal) * 100);
const starPercentageRounded = computed(() => `${Math.round(starPercentage.value / 10) * 10}%`);

watch(() => props.calificacion, () => {
    starPercentage.value = (props.calificacion / starTotal) * 100;
    starPercentageRounded.value = `${Math.round(starPercentage.value / 10) * 10}%`;
});

</script>
  
<style scoped>
.stars-outer {
    display: inline-block;
    position: relative;
    font-family: FontAwesome;
}

.stars-outer::before {
    content: "\f006 \f006 \f006 \f006 \f006";
}

.stars-inner {
    position: absolute;
    top: 0;
    left: 0;
    white-space: nowrap;
    overflow: hidden;
}

.stars-inner::before {
    content: "\f005 \f005 \f005 \f005 \f005";
    color: #40b4e4;
}
</style>
  