<template>
    <Head title="Gestionar tutores" />

    <AuthenticatedLayout>
        <template #header> Gestionar suscriptores </template>

        <div class="md:flex items-center px-5 pb-4 md:justify-between font-semibold">

            <div class="md:w-96 xs:w-full">
                <input v-model="searchTerm" type="text" placeholder="Buscar por nombre o correo"
                    class="w-full h-10 mt-2 px-3 bg-gray-200 border border-gray-500 rounded-md focus:outline-none focus:ring focus:border-blue-800" />

            </div>
            <div class="text-xs text-gray-500">
                <select id="cantidad" v-model="itemsPerPage"
                    class="block md:w-18 md:h-10 md:text-sm md:mt-0 w-18 h-8 text-xs mt-2 border border-gray-500 bg-gray-200 rounded-md"
                    required>
                    <option :value="2">2</option>
                    <option :value="4">4</option>
                    <option :value="6">6</option>
                    <option :value="8">8</option>

                </select>
                <InputError class="mt-2" :message="itemsPerPage.errors" />
            </div>
        </div>

        <div class="md:inline-block min-w-full overflow-x-scroll md:overflow-x-auto rounded-lg shadow">
            <table class="w-full whitespace-no-wrap overflow-x-auto">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nombre
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Correo Electronico
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Estado
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Telefono
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            identificación
                        </th>

                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in slicedClientes" :key="user.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.email }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.estado }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.telefono }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            
                                <p class="text-gray-900 whitespace-no-wrap">{{ user.identificacion }}</p>
                            
                        </td>
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <Link @click="edit(user.id)"
                                class="bg-cyan-600 md:mr-3 text-white xs:text-xs sm:px-4 sm:py-2 p-2 bg-yellow-800 rounded-lg" v-if="user.estado != 'aprobado'">
                            Aprobar</Link>

                            <Link @click="edit1(user.id)"
                                class="bg-cyan-600 md:mr-3 text-white xs:text-xs sm:px-4 sm:py-2 p-2 bg-yellow-800 rounded-lg" v-if="user.estado == 'aprobado'">
                            Denegar</Link>
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




    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref, computed, watch } from 'vue';
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";


import { useToast } from 'vue-toast-notification';

const $toast = useToast();

const props = defineProps({
    users: Object,
});

//paginacion tutores
const itemsPerPage = ref(8);
const currentPage = ref(0);

const totalPages = computed(() => Math.ceil(usePage().props.users.length / itemsPerPage.value));



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

watch(itemsPerPage, () => {
    currentPage.value = 0;
});

//SEARCH
const searchTerm = ref('');

//Paginacion y filtro
const slicedClientes = computed(() => {
    const start = currentPage.value * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    const filteredUsers = usePage().props.users.filter(monitor =>
        monitor.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
        monitor.email.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
    return filteredUsers.slice(start, end);
});


const edit = userId => {
    Inertia.patch(route('profile.change', userId));
    let instance = $toast.open({
        message: `suscriptor aprobado`,
        type: 'success',
        position: 'top-right',
        duration: 2000,
        pauseOnHover: true,

    });

    // setTimeout(() => {
    //     // Redireccionar usando Inertia
    //     window.location.reload();
    // }, 2000);
}

const edit1 = userId => {
    Inertia.patch(route('profile.reprobar', userId));
    let instance = $toast.open({
        message: `el suscriptor ha sido denegado por falta de pago`,
        type: 'warning',
        position: 'top-right',
        duration: 2000,
        pauseOnHover: true,

    });
    // setTimeout(() => {
    //     // Redireccionar usando Inertia
    //     window.location.reload();
    // }, 2000);
}

</script>

