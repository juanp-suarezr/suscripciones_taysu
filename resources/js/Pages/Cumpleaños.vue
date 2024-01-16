<template>
    <Head title="Estudiantes" />

    <AuthenticatedLayout>
        <template #header>
            CUMPLEAÑOS MASCOTA
        </template>


        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="md:flex items-center border-b bg-gray-50 px-5 py-1 md:justify-between font-semibold">
                    <i class="fa-solid fa-cake-candles"></i>
                    <div class="md:w-60 xs:w-full">
                        <input v-model="searchTerm" type="text" placeholder="Buscar por nombre o correo"
                            class="w-full h-10 mt-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300" />

                    </div>
                    <div class="text-xs border-b bg-gray-50 text-gray-500">
                        <select id="cantidad" v-model="itemsPerPage"
                            class="block md:w-18 md:h-10 md:text-sm md:mt-0 w-18 h-8 text-xs mt-2 border border-gray-300 rounded-md"
                            required>
                            <option :value="2">2</option>
                            <option :value="4">4</option>
                            <option :value="6">6</option>
                            <option :value="8">8</option>

                        </select>
                        <InputError class="mt-2" :message="itemsPerPage.errors" />
                    </div>
                </div>

                <TablePerson :users=slicedClientes />


            </div>
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
import TablePerson from '@/Components/TablePerson.vue';
import { ref, computed, watch } from "vue";
import { Head, usePage } from '@inertiajs/vue3';


//paginacion Clientes
const itemsPerPage = ref(6);
const currentPage = ref(0);

//Lista con fechas del mes
const cumpleanosSegunMes = ref([]);

const totalPages = computed(() => Math.ceil(usePage().props.clientes.length / itemsPerPage.value));



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


usePage().props.clientes.forEach(element => {
    if (new Date(element.cumpleanos_m).getMonth() + 1 == new Date().getMonth() + 1) {

        cumpleanosSegunMes.value.push(element);
        console.log(cumpleanosSegunMes.value);
    }
});


//Paginacion y filtro
const slicedClientes = computed(() => {
    const start = currentPage.value * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    const filteredUsers = cumpleanosSegunMes.value.filter(cli =>
        cli.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
        cli.email.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
    return filteredUsers.slice(start, end);
});

//Fin Filtrado




</script>
