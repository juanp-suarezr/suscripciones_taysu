<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import { onMounted, ref } from 'vue';
import AOS from 'aos';
import 'aos/dist/aos.css';


AOS.init();

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },

    roles: {
        type: Object,
    },
});



if (document.getElementById("nav-mobile-btn")) {
    const navBtn = document.getElementById("nav-mobile-btn");
    const navMenu = document.getElementById("nav");

    navBtn.addEventListener("click", function () {
        if (navMenu.classList.contains("hidden")) {
            navMenu.classList.remove("hidden");
        } else {
            navMenu.classList.add("hidden");
        }
    });
}


const estudianteID = ref();
const monitorID = ref();
const roles = usePage().props.roles;
console.log(roles);

for (let index in roles) {

    if (roles[index].name == "Estudiante") {
        estudianteID.value = roles[index].id;
    }
    else if (roles[index].name == "Monitor") {
        monitorID.value = roles[index].id;
    }

    localStorage.setItem('estudianteID', estudianteID.value);
    localStorage.setItem('monitorID', monitorID.value);


}

onMounted(() => {
    const script = document.createElement('script');
    script.src = 'https://cdn.lightwidget.com/widgets/lightwidget.js';
    document.head.appendChild(script);
});


</script>


<template>
    <Head title="Taysu accesorios" />


    <header class="relative z-50 w-full h-24 bg-gradient-to-r from-yellow-100 via-yellow-200 to-yellow-300">
        <div class="container flex items-center justify-center h-full max-w-6xl px-8 mx-auto sm:justify-between xl:px-0">
            <a href="/" class="relative flex items-center inline-block h-5 h-full font-black leading-none">
                <img class="object-cover w-44 px-4 sm:w-44" src="../../assets/TAYSU LOGO REGISTRADO.svg" />
            </a>



            <div
                class="absolute left-0 flex-col items-center justify-center hidden w-full pb-8 mt-48 border-b border-gray-200 md:relative md:w-auto md:bg-transparent md:border-none md:mt-0 md:flex-row md:p-0 md:items-end md:flex md:justify-between">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="z-index relative md:mr-3 z-40 inline-block w-auto h-full px-2 py-3 text-sm font-bold leading-none text-white transition-all transition duration-100 duration-300 bg-yellow-700 rounded shadow-md fold-bold lg:bg-white lg:text-yellow-700 sm:w-full lg:shadow-none hover:shadow-xl">
                Dashboard</Link>

                <template v-else>
                    <div class="hidden md:flex md:relative md:w-auto">
                        <Link :href="route('login')"
                            class="relative md:mr-3 z-40 inline-block w-auto h-full px-2 py-3 text-sm font-bold leading-none text-white text-center transition-all transition duration-100 duration-300 bg-yellow-700 rounded shadow-md fold-bold lg:bg-white lg:text-yellow-700 sm:w-full lg:shadow-none hover:shadow-xl">
                        Admin</Link>

                        <Link :href="route('register')"
                            class="relative z-40 inline-block w-auto h-auto px-5 py-3 text-sm font-bold leading-none text-white text-center transition-all transition duration-100 duration-300 bg-yellow-700 rounded shadow-md fold-bold lg:bg-white lg:text-yellow-700 sm:w-full lg:shadow-none hover:shadow-xl">
                        Suscribirse</Link>
                    </div>



                </template>




            </div>

        </div>
    </header>
    <!-- End Header Section-->

    <div class="md:hidden w-auto mt-2 grid grid-cols-2 gap-4 mx-4">
        <Link :href="route('login')"
            class="relative md:mr-3 z-40 inline-block w-auto h-full px-2 py-3 text-sm font-bold leading-none text-white transition-all transition duration-100 duration-300 bg-yellow-700 rounded shadow-md fold-bold lg:bg-white lg:text-indigo-700 sm:w-full lg:shadow-none hover:shadow-xl">
        Iniciar Sesion</Link>

        <Link :href="route('register')"
            class="relative z-40 inline-block w-auto h-full px-5 py-3 text-sm font-bold leading-none text-white transition-all transition duration-100 duration-300 bg-yellow-700 rounded shadow-md fold-bold lg:bg-white lg:text-indigo-700 sm:w-full lg:shadow-none hover:shadow-xl">
        Suscribirse</Link>
    </div>

    <!-- BEGIN HERO SECTION -->
    <div class="relative items-center justify-center w-full  lg:pb-20 xl:pb-64 p-0 md:mt-0 mt-2">

        <img class="w-full" src="../../assets/bannerProductos.png">

        <div
            class="container flex flex-col items-center justify-between h-full max-w-6xl px-8 mx-auto -mt-32 lg:flex-row xl:px-0">

        </div>
    </div>
    <!-- HERO SECTION END -->

    <!-- BEGIN SECOND PART -->
    <div class="relative items-center justify-center w-full lg:pb-40 xl:pb-64">
        <div
            class="container flex flex-col items-center justify-between h-full max-w-6xl px-4 mx-auto -mt-32 lg:flex-row xl:px-0">
            <div class="relative z-50 flex flex-col items-end justify-center w-full h-full lg:w-1/2 ms:pl-10"
                data-aos="fade-down-right" data-aos-duration="2000">
                <div class="container relative right-0 w-full max-w-4xl lg:absolute xl:max-w-6xl lg:w-screen">
                    <img src="../../assets/33.png"
                        class="w-full h-auto mt-20 mb-20 ml-0 lg:mt-24 xl:mt-40 lg:mb-0 lg:h-full lg:-ml-12" />
                </div>
            </div>

            <div
                class="z-30 flex flex-col items-center w-full max-w-xl  lg:items-end lg:w-1/2 lg:pt-40 xl:pt-44 lg:text-right">
                <h1 class="relative mb-4 text-4xl font-black leading-tight text-yellow-800 sm:text-8xl xl:mb-8">
                    ¿Te gustaria?
                </h1>
                <p class="pr-2 mb-8 text-base text-gray-600 sm:text-lg xl:text-4xl lg:pl-20">
                    Recibir pañoletas, regalos y muchos descuentos para darle amor a tu peludito.
                </p>

                <a href="#thirdPart"
                    class="w-auto h-full leading-none hover:scale-125 transition duration-500 cursor-pointer">
                    <i class="fa-solid fa-angles-down sm:text-md xl:text-2xl lg:pl-20 text-yellow-800 animate-bounce"></i>
                </a>


                <!-- Integrates with section -->


            </div>

        </div>
    </div>
    <!-- END SECOND PART -->

    <!-- THIRD PART -->
    <div id="thirdPart" class="relative px-4 py-10 bg-white border-t border-gray-200 md:py-16 lg:py-24 xl:py-40 xl:px-0"
        data-aos="fade-down" data-aos-duration="2000">
        <div id="pricing" class="container flex flex-col items-center h-full max-w-8xl mx-auto">

            <h1 class="relative mb-4 text-3xl font-black leading-tight text-indigo-800 sm:text-6xl xl:mb-8">
                SUSCRIBIRSE
            </h1>

            <h4
                class="w-full max-w-2xl px-5 px-8 mt-2 text-xl font-black leading-tight text-center text-gray-900 sm:mt-0 sm:px-0 sm:text-2xl md:px-0">
                Recibe amor y diversión por todo el año.
            </h4>

            <div class="max-w-full mx-auto md:max-w-8xl sm:px-8">

                <div class="relative flex flex-col items-center block sm:flex-row">
                    <!-- privilegios-->
                    <div class="relative z-10 w-full my-8 bg-white rounded-lg shadow-lg sm:my-5 mx-2">
                        <div
                            class="py-4 text-sm font-bold leading-none tracking-wide text-center text-black uppercase bg-yellow-200 rounded-t">
                            Taysu membresia Vip
                        </div>

                        <div class="flex justify-start pl-12 mt-8 sm:justify-start pb-8">
                            <ul>
                                <li class="flex items-center">
                                    <div class="p-2 text-green-500 rounded-full fill-current">
                                        <svg class="w-6 h-6 align-middle" viewBox="0 0 24 24" fill="none" stroke="#ECC084"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-lg text-gray-700">Kit de bienvenida</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="p-2 text-green-500 rounded-full fill-current">
                                        <svg class="w-6 h-6 align-middle" viewBox="0 0 24 24" fill="none" stroke="#ECC084"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-lg text-gray-700">4 pañoletas personalizadas de regalo durante el
                                        año</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="p-2 text-green-500 rounded-full fill-current">
                                        <svg class="w-6 h-6 align-middle" viewBox="0 0 24 24" fill="none" stroke="#ECC084"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-lg text-gray-700">Regalo de cumpleaños</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="p-2 text-green-500 rounded-full fill-current">
                                        <svg class="w-6 h-6 align-middle" viewBox="0 0 24 24" fill="none" stroke="#ECC084"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-lg text-gray-700">Descuentos exclusivos y preventas VIP</span>
                                </li>
                            </ul>
                        </div>


                    </div>


                    <!-- PRECIO-->
                    <div class="relative z-10 w-full h-auto my-8 bg-white rounded-lg shadow-lg sm:my-5 mx-2">
                        <div
                            class="py-4 text-sm font-semibold leading-none tracking-wide text-center text-white uppercase bg-indigo-500 rounded-t">
                            Precio<span class="ml-2 font-light">Anual</span>
                        </div>
                        <h4 class="items-center justify-center pb-6 text-4xl font-bold text-center text-gray-900">
                            <span class="mx-auto text-lg text-gray-700">Membresía premium <br> PAGO UNICO ANUAL</span>
                            <br>
                            <span class="mx-auto">$180.000</span>
                        </h4>


                        <div class="flex items-center block p-8 uppercase">
                            <Link :href="route('register')"
                                class="relative mx-auto z-40 inline-block w-auto h-full px-5 py-3 text-sm font-bold leading-none text-white transition-all transition duration-100 duration-300 bg-indigo-700 rounded shadow-md fold-bold hover:shadow-xl">
                            Suscribirme</Link>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- End Pricing Section -->

    <!-- Start Instagram -->
    <div id="instagram"
        class="items-center justify-center w-full h-full px-8 py-10 border-t border-gray-200 md:py-16 lg:py-14 xl:py-20 xl:px-0"
        data-aos="fade-up" data-aos-duration="4000">

        <h2>
            <p class="text-center">
                <b>SIGUENOS EN INSTAGRAM</b>
            </p>
        </h2>

        <!-- LightWidget WIDGET -->
        <iframe src="//lightwidget.com/widgets/d7ea71a8e7fc5da9a4d3c97aeeec8571.html" scrolling="no"
            allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:auto;"></iframe>


    </div>
    <!-- End Instagram-->

    <footer class="px-4 pt-2 pb-2 text-white bg-white border-t border-gray-200">
        <div class="container flex flex-col justify-between max-w-6xl px-4 mx-auto overflow-hidden lg:flex-row">
            <div class="w-full mr-4 text-left lg:w-1/4 text-center sm:pl-0 lg:text-left mx-auto">
                <a href="/" class="relative flex items-center inline-block h-full font-black leading-none w-full">
                    <img class="object-cover w-44 sm:w-44 mx-auto" src="../../assets/TAYSU LOGO REGISTRADO.svg" />
                </a>
            </div>
            <div class="block w-full pl-10 mt-6 text-sm lg:w-3/4 sm:flex lg:mt-0">
                <div class="flex flex-col w-full p-0 font-medium text-left text-gray-700">
                    <h2 class="inline-block px-3 py-2 mt-5 font-bold tracking-wide text-gray-800 uppercase md:mt-0">
                        4 años
                    </h2>
                    <p class="inline-block px-3 py-2 text-gray-600">Dando amor y diversión a todos los peluditos</p>
                </div>
                <div class="flex flex-col w-full p-0 font-medium text-left text-gray-700">
                    <h2 class="inline-block px-3 py-2 mt-5 font-bold tracking-wide text-gray-800 uppercase md:mt-0">
                        100% Pereiranos y sostenibles
                    </h2>
                    <p class="inline-block px-3 py-2 text-gray-600">Orgullosos de nuestra tierra y de cuidar el medio ambiente</p>
                </div>
                
                <div class="flex flex-col w-full text-gray-700">
                    <div class="inline-block px-3 py-2 mt-5 font-bold text-gray-800 uppercase md:mt-0">
                        Siguenos o escribenos
                    </div>
                    <div class="flex justify-start pl-4 mt-2">
                        <a class="flex items-center block mr-6 text-gray-400 no-underline hover:text-gray-600"
                            target="_blank" rel="noopener noreferrer" href="https://devdojo.com">
                            <svg viewBox="0 0 24 24" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23.998 12c0-6.628-5.372-12-11.999-12C5.372 0 0 5.372 0 12c0 5.988 4.388 10.952 10.124 11.852v-8.384H7.078v-3.469h3.046V9.356c0-3.008 1.792-4.669 4.532-4.669 1.313 0 2.686.234 2.686.234v2.953H15.83c-1.49 0-1.955.925-1.955 1.874V12h3.328l-.532 3.469h-2.796v8.384c5.736-.9 10.124-5.864 10.124-11.853z" />
                            </svg>
                        </a>
                        <a class="flex items-center block mr-6 text-gray-400 no-underline hover:text-gray-600"
                            target="_blank" rel="noopener noreferrer" href="https://devdojo.com">
                            <svg viewBox="0 0 24 24" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23.954 4.569a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.691 8.094 4.066 6.13 1.64 3.161a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.061a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.937 4.937 0 004.604 3.417 9.868 9.868 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63a9.936 9.936 0 002.46-2.548l-.047-.02z" />
                            </svg>
                        </a>
                        <a class="flex items-center block text-gray-400 no-underline hover:text-gray-600" target="_blank"
                            rel="noopener noreferrer" href="https://devdojo.com">
                            <svg viewBox="0 0 24 24" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-4 pt-6 mt-10 text-center text-gray-500 border-t border-gray-100">
            © 2024 Taysu accesorios. todos los derechos reservados.
        </div>

        <div class="pt-2 pt-4 mt-2 text-center text-gray-600 border-t border-gray-100">
            Desarrollado By <a href="/">JPRS</a>
        </div>
    </footer>
</template>


<style>
@media (max-width: 1520px) {
    .left-svg {
        display: none;
    }
}

/* small css for the mobile nav close */
#nav-mobile-btn.close span:first-child {
    transform: rotate(45deg);
    top: 4px;
    position: relative;
    background: #a0aec0;
}

#nav-mobile-btn.close span:nth-child(2) {
    transform: rotate(-45deg);
    margin-top: 0px;
    background: #a0aec0;
}

body {
    overflow-x: hidden;
}
</style>
