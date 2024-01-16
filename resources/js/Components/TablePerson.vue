<template>
    <ul role="list" class="divide-y divide-gray-100">
        <li v-for="person in users" :key="person.id" class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">

                <div class="min-w-0 flex-auto">
                    <p class="text-sm italic font-semibold leading-6 text-gray-900">{{ person.name }}</p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ person.email }}</p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-500">Mascota: {{ person.nombre_mascota }}</p>
                </div>
            </div>
            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                <p class="text-sm leading-6 text-gray-900">{{ person.cumpleanos_m }}</p>
                <p class="mt-1 text-sm leading-5 text-gray-500">
                    {{ months[new Date(person.cumpleanos_m).getMonth()] }}
                </p>

            </div>
        </li>
    </ul>
</template>
  
<script setup>


const props = defineProps({
    users: Object
})

const months = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];

</script>