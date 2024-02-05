<template>
    <Head title="suscribirse" />

    <GuestLayout>
        <Link href="/" class="flex items-center justify-center mt-6">
        <img class="h-38 w-28 fill-current text-gray-500" src="../../../assets/TS NUEVO.png">
        </Link>

        <form @submit.prevent="submit">
            <div class="md:grid md:grid-cols-2 md:gap-2 mt-4">

                <div>
                    <InputLabel for="name" value="Nombre" />
                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="identificacion" value="identificación" />
                    <TextInput id="identificacion" type="text" class="mt-1 block w-full" v-model="form.identificacion"
                        required autofocus autocomplete="identificacion" />
                    <InputError class="mt-2" :message="form.errors.identificacion" />
                </div>

                <div class="mt-2">
                    <InputLabel for="edad" value="Edad" />
                    <TextInput id="edad" type="text" class="mt-1 block w-full" v-model="form.edad" required autofocus
                        autocomplete="edad" />
                    <InputError class="mt-2" :message="form.errors.edad" />
                </div>

                <div class="mt-2">
                    <InputLabel for="ciudad" value="Ciudad" />
                    <TextInput id="ciudad" type="text" class="mt-1 block w-full" v-model="form.ciudad" required autofocus
                        autocomplete="ciudad" />
                    <InputError class="mt-2" :message="form.errors.ciudad" />
                </div>

                <div class="mt-2">
                    <InputLabel for="direccion" value="Dirección" />
                    <TextInput id="direccion" type="text" class="mt-1 block w-full" v-model="form.direccion" required autofocus
                        autocomplete="direccion" />
                    <InputError class="mt-2" :message="form.errors.direccion" />
                </div>

                <div class="mt-2">
                    <InputLabel for="telefono" value="telefono" />
                    <TextInput id="telefono" type="text" class="mt-1 block w-full" v-model="form.telefono" required
                        autofocus autocomplete="telefono" />
                    <InputError class="mt-2" :message="form.errors.telefono" />
                </div>

                <div class="mt-2">
                    <InputLabel for="mascota" value="Mascota" />
                    <TextInput id="mascota" type="mascota" class="mt-1 block w-full" v-model="form.mascota" required
                        autocomplete="mascota" />
                    <InputError class="mt-2" :message="form.errors.mascota" />
                </div>

                <div class="mt-2">
                    <InputLabel for="nombre_mascota" value="Nombre de la mascota" />
                    <TextInput id="nombre_mascota" type="nombre_mascota" class="mt-1 block w-full"
                        v-model="form.nombre_mascota" required autocomplete="nombre_mascota" />
                    <InputError class="mt-2" :message="form.errors.nombre_mascota" />
                </div>

                <div class="mt-2">
                    <InputLabel for="raza" value="Raza de la mascota" />
                    <TextInput id="raza" type="raza" class="mt-1 block w-full" v-model="form.raza" required
                        autocomplete="raza" />
                    <InputError class="mt-2" :message="form.errors.raza" />
                </div>

                <div class="mt-2">
                    <InputLabel for="cumpleanos_m" value="Cumpleaños de la mascota" />
                    <VueDatePicker v-model="date" :format="format"></VueDatePicker>
                </div>

                <div class="mt-2">

                    <InputLabel for="email" value="Correo electronico" />
                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

            </div>


            <div class="mt-4 flex flex-col items-end">
                <div class="border-b border-gray-800 w-full pb-6 flex flex-col">
                    <div class="mx-auto flex rounded-lg bg-yellow-700">
                        <h1 class="m-auto p-4 text-white font-bold">$180.000 anuales</h1>
                    </div>

                    <h2 class="sm:text-xl mx-auto mt-2 font-bold">cuenta nequi -- 3054025529</h2>
                    <PrimaryButton class="w-full mt-2" :class="{ 'opacity-25': form.processing }"
                        v-on:click="paypalButtonClicked = false" :disabled="form.processing">
                        Transferir, Enviar comprobante y Registrarse
                    </PrimaryButton>
                </div>

                <h2 class="sm:text-xl mx-auto mt-2 font-bold">O</h2>
                <button id="paypalButton" v-on:click="paypalButtonClicked = true"
                    class="w-full z-10 mt-2 rounded-md bg-gradient-to-r from-blue-400/90 via-blue-600/90 to-blue-400/90 px-4 py-2 text-center text-base sm:text-2xl text-white transition-all transition duration-100 duration-300 hover:shadow-xl"
                    :disabled="form.processing">
                    Pagar con <b><i>PayPal</i></b>
                </button>

                <div id="paypal-button-container" class="w-full border-b border-gray-800 mt-4 z-50"></div>


                <!-- <Link :href="route('login')" class="mt-4 text-sm text-gray-600 underline hover:text-gray-900">
                Ya eres taysuLover Vip?

                </Link> -->
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>

import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, onMounted, watch, computed } from 'vue';

import { useToast } from 'vue-toast-notification';

const $toast = useToast();
watch(
    () => usePage().props.flash.code,

);

const estado = ref('');
const date = ref(new Date());
const fechaCumple = ref();
// In case of a range picker, you'll receive [Date, Date]
const format = (date) => {
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    fechaCumple.value = ` ${year}-${month}-${day} `;
    return `Fecha seleccionada: ${day}/${month}/${year}`;

}

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    identificacion: "",
    edad: "",
    ciudad: "",
    direccion: "",
    telefono: "",
    mascota: "perro, gato, conejo, etc.",
    nombre_mascota: "",
    cumpleanos_m: fechaCumple.value,
    raza: "criollito - talla M",
    estado: estado.value,
    rol: "cliente",
});



const paypalButtonClicked = ref(false);  // Variable para rastrear si el botón de PayPal ha sido clicado



const submit = () => {




    if (paypalButtonClicked.value) {


        console.log(usePage().props.clientes);

        let emailExist = usePage().props.clientes.find(item => item.email == form.email);

        if (emailExist) {
            let instance = $toast.open({
                message: "El correo ingresado ya ha sido registrado",
                type: 'error',
                position: 'top-right',

            });
        } else {
            const paypalButton = document.getElementById('paypalButton');
            if (paypalButton) {
                paypalButton.style.display = 'none';
            }
            loadPayPalScript();
        }




    } else {
        estado.value = "pendiente";
        form.estado = estado.value;
        console.log(date.value);
        form.cumpleanos_m = fechaCumple.value;
        console.log(form.cumpleanos_m);
        console.log(usePage().props);
        form.post(route("register"), {
            onFinish: () => {
                form.reset("password", "password_confirmation");
                if (usePage().props.errors.email) {
                    let instance = $toast.open({
                        message: "El correo ingresado ya ha sido registrado",
                        type: 'error',
                        position: 'top-right',

                    });
                } else {
                    let instance = $toast.open({
                        message: usePage().props.flash.message,
                        type: 'success',
                        position: 'top-right',

                    });
                    window.open("https://api.whatsapp.com/send/?phone=3054025529&text=hola+Taysu+Accesorios+envío+comprobante+de+transacción+de+suscripción&type=phone_number&app_absent=0", '_blank');
                }

            },
        });
    }


};




//PRECIO EN DOLARES DE 180.000 PESOS
const precioEnUSD = ref();





const loadPayPalScript = async () => {
    
    try {
        const key = "d66d9b0aea44804cd610438bf25e7230b7328cb0";
        const precioCOP = 180000;
        const url = `https://api.getgeoapi.com/v2/currency/convert?api_key=${key}&from=COP&to=USD&amount=${precioCOP}&format=json`;

        // Realizar la petición Fetch y esperar su respuesta
        const response = await fetch(url);
        const data = await response.json();

        // Actualizar el valor de precioEnUSD con la tasa de conversión
        const conversionRate = parseFloat(data.rates.USD.rate_for_amount);
        precioEnUSD.value = conversionRate.toFixed(2);

        // Cargar el script de PayPal después de que se resuelva la petición Fetch
        const script = document.createElement('script');
        //CAMBIAR CADA VEZ DEL RUN BUILD
        const clientID = usePage().props.paypal_token;
        console.log(precioEnUSD.value + " " + typeof (precioEnUSD.value));
        script.src = `https://www.paypal.com/sdk/js?client-id=${clientID}&currency=USD`;
        script.onload = () => {
            paypal.Buttons({
                style: {
                    layout: 'vertical',
                    color: 'blue',
                    shape: 'rect',
                    label: 'pay',
                },
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: precioEnUSD.value,
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    actions.order.capture().then(function (detalles) {
                        console.log(detalles);
                        estado.value = "aprobado";
                        form.estado = estado.value;
                        form.cumpleanos_m = fechaCumple.value;
                        console.log(form.cumpleanos_m);
                        form.post(route("register"), {
                            onFinish: () => {
                                form.reset("password", "password_confirmation");

                                let instance = $toast.open({
                                    message: "Registro completado",
                                    type: 'success',
                                    position: 'top-right',
                                    duration: 6000,
                                    pauseOnHover: true,
                                });
                            }
                        });

                    });
                },
                onCancel: function (data) {
                    let instance = $toast.open({
                        message: "Pago cancelado",
                        type: 'error',
                        position: 'top-right',
                        duration: 6000,
                        pauseOnHover: true,
                    });
                }
            }).render('#paypal-button-container');

        };
        document.head.appendChild(script);
    } catch (error) {
        console.error('Error al cargar el script de PayPal:', error);
    }
};





</script>

