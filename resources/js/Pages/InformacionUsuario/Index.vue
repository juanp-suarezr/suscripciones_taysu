<template>
    <Head title="informacion_usuario" />

    <AuthenticatedLayout>
        <template #header>
            Informacion usuarios
        </template>

        <div class="mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md">
            <div class="flex w-16 items-center justify-center bg-blue-500">
                <i class="fa-solid fa-circle-info text-xl"></i>
            </div>

            <div class="md:flex items-center px-5 py-3 md:justify-between font-semibold w-full">

                <div class="md:w-96 xs:w-full m-auto">
                    <input v-model="searchTerm" type="text" placeholder="Buscar por nombre o correo"
                        class="w-full h-10 mt-2 px-3 bg-gray-200 border border-gray-500 rounded-md focus:outline-none focus:ring focus:border-blue-800" />

                </div>
                <div class="text-xs text-gray-500 my-auto">
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
        </div>

        <div class="md:inline-block min-w-full overflow-x-scroll sm:overflow-x-scroll md:overflow-x-auto rounded-lg shadow">
            <table class="w-full whitespace-no-wrap overflow-x-auto">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">

                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nombre
                        </th>

                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Identificación
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Correo
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Edad
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Ciudad
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Facultad
                        </th>
                        
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 sm:px-5 sm:py-3 p-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Acciones
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="informacion_usuario in slicedInfoUsers" :key="informacion_usuario.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <p class="text-gray-900 whitespace-no-wrap">{{ informacion_usuario.name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <p class="text-gray-900 whitespace-no-wrap">{{ informacion_usuario.identificacion }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <p class="text-gray-900 whitespace-no-wrap">{{ informacion_usuario.email }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <p class="text-gray-900 whitespace-no-wrap">{{ informacion_usuario.edad }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <p class="text-gray-900 whitespace-no-wrap">{{ informacion_usuario.ciudad }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white sm:px-5 sm:py-5 p-2 sm:text-sm text-xs">
                            <p class="text-gray-900 whitespace-no-wrap">{{ informacion_usuario.facultad }}</p>
                        </td>
                        <td class="flex-row border-b border-gray-200 bg-white sm:px-5 sm:py-5 sm:text-sm text-xs">
                            <Link
                                :href="route('profile.edit', { id: informacion_usuario.id_usuario, originPage: 'clienteEdit' })"
                                class="bg-cyan-600 md:mr-2 text-white xs:text-xs sm:px-4 sm:py-2 p-2 bg-blue-600 rounded-lg">
                            Editar</Link>

                            <Link @click="confirmDelete(informacion_usuario.id)"
                                class="mt-9 bg-cyan-600 md:mr-2 text-white xs:text-xs sm:px-4 sm:py-2 p-2 bg-blue-600 rounded-lg">
                            Eliminar</Link>
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
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from "@inertiajs/inertia";
import { ref, computed, watch } from 'vue';


const props = defineProps({
    informacion_usuario: Object
})


//paginacion tutores
const itemsPerPage = ref(8);
const currentPage = ref(0);

const totalPages = computed(() => Math.ceil(props.informacion_usuario.length / itemsPerPage.value));



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

//SEARCH
const searchTerm = ref('');

watch(itemsPerPage, () => {
    currentPage.value = 0;
});

//Paginacion y filtro
const slicedInfoUsers = computed(() => {
    const start = currentPage.value * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    const filteredUsers = props.informacion_usuario.filter(infoUser =>
        infoUser.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
        infoUser.email.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
    return filteredUsers.slice(start, end);
});




const confirmDelete = infoUserId => {
    const usuarioEncontrado = props.informacion_usuario.find(usuario => usuario.id === infoUserId);

    if (confirm('¿Estás seguro de que desea eliminar la información del usuario ' + usuarioEncontrado.name)) {
        Inertia.delete(route('informacionUsuario.destroy', infoUserId));
        setTimeout(() => {
            // Redireccionar usando Inertia
            window.location.reload();
        }, 2000);
    }
}


</script>
