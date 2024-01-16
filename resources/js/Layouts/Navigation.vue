<template>
    <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
        class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="$page.props.showingMobileMenu
        ? 'translate-x-0 ease-out'
        : '-translate-x-full ease-in'
        "
        class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-64 bg-yellow-200 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex justify-center items-center mt-8">
            <a class="hover:scale-125 transition duration-500 cursor-pointer" :href="route('dashboard')">
                <div class="flex items-center">
                    <img class="object-cover w-96 px-4" src="../../assets/TAYSU LOGO REGISTRADO.svg" />
                </div>
            </a>
        </div>

        <nav class="mt-10" x-data="{ isMultiLevelMenuOpen: false }">
            <SeparadorMenu>Menú</SeparadorMenu>
            <nav-link :href="route('dashboard')" :active="route().current('dashboard')" class="hover:bg-gray-200">

                <i class="fa-solid fa-home"></i>
                Inicio

            </nav-link>

            <nav-link :href="route('cumpleaños')" :active="route().current('cumpleaños')" class="hover:bg-gray-200">

                <i class="fa-solid fa-cake-candles"></i>
                Cumpleaños mascota

            </nav-link>

            <!-- ROL ADMIN -->


            <SeparadorMenu v-if="$page.props.auth.user.id_rol != estudianteID && $page.props.auth.user.id_rol != monitorID">
                Configuración</SeparadorMenu>

            <!-- ROL ADMIN -->
            <nav-link
                :href="route('aprobar.index')" :active="route().current('aprobar.index')" class="hover:bg-gray-200">
                <i class="fa-regular fa-check-circle"></i>
                Gestión Suscriptores
            </nav-link>

            





            <!-- ROL ADMIN -->
            <nav-link v-if="$page.props.auth.user.id_rol != estudianteID && $page.props.auth.user.id_rol != monitorID"
                :href="route('users.index')" :active="route().current('users.index')" class="hover:bg-gray-200">
                <i class="fa-solid fa-users-gear"></i>
                Usuarios
            </nav-link>

            <!-- ROL ADMIN -->
            <!-- <nav-link v-if="$page.props.auth.user.id_rol != estudianteID && $page.props.auth.user.id_rol != monitorID"
                :href="route('cliente.index')" :active="route().current('cliente.index')" class="hover:bg-gray-200">
                <i class="fa-solid fa-circle-info"></i>
                Información usuarios
            </nav-link> -->


        </nav>
    </div>
</template>

<script>
import NavLink from "@/Components/NavLink.vue";
import SeparadorMenu from "@/Components/SeparadorMenu.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

export default {
    components: {
        NavLink,
        Link,
        SeparadorMenu,
    },

    setup() {
        const estudianteID = ref(localStorage.getItem("estudianteID"));
        const monitorID = ref(localStorage.getItem("monitorID"));

        return {
            estudianteID,
            monitorID,
        };
    },
};
</script>

<style scoped></style>
