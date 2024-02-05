<template>
    <Head title="Cumpleaños" />

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


                    <!-- Meses -->
                    <div class="text-xs border-b bg-gray-50 text-gray-500">
                        <select id="Meses" v-model="mes"
                            class="block md:w-18 md:h-10 md:text-sm md:mt-0 w-18 h-8 text-xs mt-2 border border-gray-300 rounded-md"
                            required>
                            <option :value="1">Enero</option>
                            <option :value="2">Febrero</option>
                            <option :value="3">Marzo</option>
                            <option :value="4">Abril</option>
                            <option :value="5">Mayo</option>
                            <option :value="6">Junio</option>
                            <option :value="7">Julio</option>
                            <option :value="8">Agosto</option>
                            <option :value="9">Septiembre</option>
                            <option :value="10">Octubre</option>
                            <option :value="11">Noviembre</option>
                            <option :value="12">Diciembre</option>

                        </select>
                        <InputError class="mt-2" :message="mes.errors" />
                    </div>

                    <div class="">
                        <Link
                            class="bg-cyan-600 md:mr-3 text-white xs:text-xs sm:px-4 sm:py-2 p-2 bg-yellow-800 rounded-lg">
                        Limpiar</Link>
                    </div>

                </div>

                <TablePerson :users=slicedClientes @id="showModal" />


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

        <!-- Modal para denegar registro -->
        <Modal :show="Isopen" @close="closeModal" class="w-auto">
            <header class="bg-gradient-to-r from-purple-400 via-purple-600 to-purple-800 flex">
                <h2 class="text-lg md:text-2xl font-bold text-white py-6 text-center m-auto">
                    Enviar correo de cumpleaños
                </h2>
            </header>
            <div class="p-6">


                <form @submit.prevent="edit">


                    <div class="mt-5 w-full">
                        <p class="mt-4 text-base md:text-xl text-gray-600 mb-2">
                            Seguro quiere enviar correo de cumpleaños a {{currentUser.name}} y su peludito {{ currentUser.nombre_mascota }}
                        </p>



                    </div>




                    <div class="mt-6 w-full flex">
                        <PrimaryButton :disabled="formEvent.processing" class="w-auto h-10 mx-auto">
                            Enviar
                        </PrimaryButton>
                        <DangerButton @click="closeModal" class="w-auto h-10 mx-auto">
                            Cancelar
                        </DangerButton>
                    </div>
                </form>

            </div>
        </Modal>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TablePerson from '@/Components/TablePerson.vue';
import { ref, computed, watch } from "vue";
import { Head, usePage, Link, useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { useToast } from 'vue-toast-notification';

const $toast = useToast();



//paginacion Clientes
const itemsPerPage = ref(6);
const currentPage = ref(0);

//Lista con fechas del mes
const cumpleanosSegunMes = ref([]);

const totalPages = computed(() => Math.ceil(usePage().props.clientes.length / itemsPerPage.value));

//Mes select
const mes = ref(new Date().getMonth() + 1);



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


watch(mes, () => {

    cumpleanosSegunMes.value = [];

    usePage().props.clientes.forEach(element => {
        console.log(mes.value);
        if (new Date(element.cumpleanos_m).getMonth() + 1 == mes.value) {

            cumpleanosSegunMes.value.push(element);
            console.log(cumpleanosSegunMes.value);
        }
    });


});


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

//Form para ENVIAR CUMPLEAÑOS
const formEvent = useForm({

    id: "",

});


//MODALES
//para saber current user 
const currentUser = ref();
const Isopen = ref(false);

const closeModal = () => {

    Isopen.value = false;


};

const showModal = (userId) => {

    Isopen.value = true;
    formEvent.id = userId;
    currentUser.value = usePage().props.clientes.find(user => user.id === userId);
};



const edit = () => {
    formEvent.post(route('profile.cumpleaños'), {
        onFinish: () => window.location.reload(),
    })

    let instance = $toast.open({
        message: `Correo enviado`,
        type: 'warning',
        position: 'top-right',
        duration: 2000,
        pauseOnHover: true,

    });

}


</script>
