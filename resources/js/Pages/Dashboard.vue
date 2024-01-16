<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header> Panel de control </template>

        <!--         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                You're logged in!
            </div>
        </div> -->
        <br />

        <div class="md:grid md:grid-cols-2 md:gap-2" data-aos="fade-down-left" data-aos-duration="2000">
            <div class="px-2">
                <div
                    class="relative flex flex-col items-center rounded-[20px] p-4 bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                    <div class="relative flex h-32 w-full justify-center rounded-xl bg-cover">
                        <div
                            class="absolute flex h-32 w-full justify-center rounded-xl bg-gradient-to-r from-yellow-100 via-yellow-200 to-yellow-400">

                        </div>

                        <div
                            class="absolute -bottom-12 flex h-[87px] w-[87px] items-center justify-center rounded-full border-[4px] border-white bg-yellow-800 dark:!border-navy-700">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-10 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mt-16 flex flex-col items-center">
                        <h4 class="md:text-xl sm:text-base font-bold text-navy-700 dark:text-black">
                            {{ $page.props.auth.user.name }}
                        </h4>
                        <p class="sm:text-base text-xs font-normal text-gray-600">
                            {{ $page.props.auth.user.email }}
                        </p>
                    </div>

                </div>
            </div>
            <!-- VISTA ADMIN -->
            <div class="py-4 justify-center items-center">
                <div class="mb-12 grid gap-y-10 gap-x-6 md:grid-cols-2 xl:grid-cols-2">


                    <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                        <div
                            class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-yellow-900 to-yellow-600 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                            <i class="fa-regular fa-address-book text-xl"></i>
                        </div>
                        <div class="p-4 text-right">
                            <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                                Total suscripciones
                            </p>
                            <h4
                                class="block antialiased tracking-normal font-sans text-xs md:text-xl sm:text-base font-semibold leading-snug text-blue-gray-900 lg:mt-4">
                                {{ suscripciones.length }}
                            </h4>
                        </div>
                        <div class="border-t border-blue-gray-50 p-4">
                            <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                                <strong class="text-yellow-600">Ts</strong>
                            </p>
                        </div>
                    </div>
                    <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                        <div
                            class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-yellow-600 to-yellow-300 text-white shadow-yellow-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true" class="w-6 h-6 text-white">
                                <path
                                    d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                                </path>
                            </svg>
                        </div>
                        <div class="p-4 text-right">
                            <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">
                                META de suscripciones
                            </p>
                            <h4
                                class="block antialiased tracking-normal font-sans text-xs md:text-xl sm:text-base font-semibold leading-snug text-blue-gray-900 lg:mt-4">
                                15
                            </h4>
                        </div>
                        <div class="border-t border-blue-gray-50 p-4">
                            <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                                <strong class="text-yellow-300 font-bold">Ts</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- VISTA ADMIN -->
        <div class="md:grid md:grid-cols-1 text-center px-5 mt-6">

            <div class="md:flex items-center md:justify-between font-semibold">
                <h4 class="md:text-2xl sm:text-base font-bold text-navy-700 dark:text-black">Suscripciones
                    registradas</h4>
                <div class="md:w-6/12 xs:w-full">
                    <input v-model="searchTerm" type="text" placeholder="Buscar por nombre o correo"
                        class="w-full h-10 mt-2 px-3 bg-gray-200 border border-gray-500 rounded-md focus:outline-none focus:ring focus:border-blue-800" />
                </div>
            </div>

            <div class="md:inline-block min-w-full overflow-x-scroll md:overflow-x-auto rounded-lg shadow mt-6">
                <table class="w-full whitespace-no-wrap overflow-x-auto">
                    <thead>
                        <tr
                            class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th
                                class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Nombre cliente
                            </th>
                            <th
                                class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Nombre mascota
                            </th>
                            <th
                                class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Fecha vencimiento
                            </th>



                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sub in slicedSuscripciones" :key="sub.id" class="text-gray-700">
                            <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ clientes.find(item => item.id == sub.id_cliente)?.name ||
                                        'Desconocido' }}
                                </p>
                            </td>
                            <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ clientes.find(item => item.id == sub.id_cliente)?.nombre_mascota ||
                                        'Desconocido' }}
                                </p>
                            </td>

                            <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">

                                <p class="text-gray-900 whitespace-no-wrap">{{ sub.fecha_vencimiento }}</p>

                            </td>


                        </tr>
                    </tbody>
                </table>

                <div
                    class="flex items-center border-b bg-gray-50 px-5 py-2 xs:flex-row justify-between text-gray-500 text-xs font-semibold">
                    <button class="hover:scale-125 transition duration-500 cursor-pointer" @click="previousPage"
                        :disabled="currentPage === 0"><i class="fa-solid fa-arrow-left"></i></button>
                    <p>Pagina {{ currentPage + 1 }} de {{ totalPages }}</p>
                    <button class="hover:scale-125 transition duration-500 cursor-pointer" @click="nextPage"
                        :disabled="currentPage === totalPages - 1"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>

        </div>


        <!-- component -->
        <html>

        </html>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from '@inertiajs/vue3';
import { ref, computed, watch } from "vue";
import { format } from 'date-fns-tz';
import moment from 'moment';
import AOS from 'aos';
import 'aos/dist/aos.css';


AOS.init();


const clientes = usePage().props.clientes;
const suscripciones = usePage().props.suscripciones;



console.log(usePage().props);

//SEARCH 
const searchTerm = ref('');

//paginacion tutores
const itemsPerPage = 5;
const currentPage = ref(0);

const totalPages = computed(() => Math.ceil(suscripciones.length / itemsPerPage));

const slicedSuscripciones = computed(() => {
    const start = currentPage.value * itemsPerPage;
    const end = start + itemsPerPage;
    const filteredUsers = suscripciones.filter(sub =>
        clientes.find(item => item.id == sub.id_cliente)?.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
        clientes.find(item => item.id == sub.id_cliente)?.nombre_mascota.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
    return filteredUsers.slice(start, end);
});

const previousPage = () => {
    if (currentPage.value > 0) {
        currentPage.value--;
    }
};

const nextPage = () => {
    if (currentPage.value < totalPages.value - 1) {
        currentPage.value++;
    }
};
//FIN Paginacion


















</script>
