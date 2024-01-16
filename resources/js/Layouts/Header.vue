<template>
    <header class="flex items-center justify-between border-b-4 border-yellow-200 bg-white px-6 py-4">
        <div class="flex items-center">
            <button @click="$page.props.showingMobileMenu = !$page.props.showingMobileMenu"
                class="text-gray-500 focus:outline-none lg:hidden">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="flex items-center">
            <!-- notificaciones -->
            <dropdown class="mx-3">
                <template #trigger>
                    <button @click="dropdownOpen = !dropdownOpen" class="relative block overflow-hidden">
                        <i class="fa-solid fa-bell"></i><sup> {{ notification.length }} </sup>
                    </button>
                </template>

                <template #content>
                    <div v-for="noti in notification" :key="noti.id" class="">

                        <dropdown-link v-if="noti.noti == 'cumpleanos'" :href="route('cumpleaños')">
                            Cumpleaños de {{ noti.nombre_mascota }}
                        </dropdown-link>

                    </div>



                </template>
            </dropdown>
            <!-- perfil -->
            <dropdown class="mx-3">
                <template #trigger>
                    <button @click="dropdownOpen = !dropdownOpen" class="relative block overflow-hidden">
                        {{ $page.props.auth.user.name }} <i class="fa-solid fa-bars p-2"></i>
                    </button>
                </template>

                <template #content>
                    <dropdown-link
                        :href="route('profile.edit', { id: $page.props.auth.user.id, originPage: 'perfilEdit' })">
                        Perfil
                    </dropdown-link>

                    <dropdown-link class="w-full text-left" :href="route('logout')" method="post" as="button">
                        Cerrar Sesión
                    </dropdown-link>
                </template>
            </dropdown>
        </div>
    </header>
</template>

<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { ref } from "vue";
import { Head, usePage } from '@inertiajs/vue3';

//ARRAY DE MANEJO DE NOTIFICACIONES
const notification = ref([]);

//DATOS DEL STORAGE
const clientes = usePage().props.clientes;
const suscripciones = usePage().props.suscripciones;


//Para saber si cumpleaños es hoy
const isBirthdayToday = (birthday) => {
    const today = new Date();
    today.setHours(0, 0, 0, 0); // Establecer la hora a 00:00:00 para ignorar la hora

    const birthdayDate = new Date(`${birthday}T00:00:00-05:00`);
    console.log(birthdayDate);
    birthdayDate.setHours(0, 0, 0, 0);

    return today.getMonth() === birthdayDate.getMonth() && today.getDate() === birthdayDate.getDate();
};

//ENVIAR NOTIFICACION SI EL CUMPLEAÑOS ES HOY
if (clientes) {
    clientes.forEach(element => {

        console.log(element.cumpleanos_m);


        if (isBirthdayToday(element.cumpleanos_m)) {
            notification.value.push({
                id: element.id,
                noti: "cumpleanos",
                name: element.name,
                nombre_mascota: element.nombre_mascota,
                cumpleanos_m: element.cumpleanos_m,
                email: element.email,

            });
        }
    });
}










</script>
