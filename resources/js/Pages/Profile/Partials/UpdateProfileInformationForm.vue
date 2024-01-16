<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from "vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    updatedUser: {
        type: Object,
    }
});


const user = ref({});
const userInfo = usePage().props.updatedUser;
const form = ref();

if (usePage().props.originPage == "UsuariosEdit") {


    user.value = usePage().props.usersXAdmin;
    console.log(user.value);
    form.value = useForm({
        name: user.value.data[0].name,
        email: user.value.data[0].email,
        identificacion: user.value.data[0].identificacion,
        edad: user.value.data[0].edad,
        ciudad: user.value.data[0].ciudad,
        facultad: user.value.data[0].facultad,
        semestre: user.value.data[0].semestre,

    });

} else if (usePage().props.originPage == "clienteEdit") {
    
    user.value = usePage().props.informacion_usuarioID;
    console.log(user.value);
    form.value = useForm({
        name: user.value.data[0].name,
        email: user.value.data[0].email,
        identificacion: user.value.data[0].identificacion,
        edad: user.value.data[0].edad,
        ciudad: user.value.data[0].ciudad,
        facultad: user.value.data[0].facultad,
        semestre: user.value.data[0].semestre,
    });

}

console.log(userInfo);



console.log(form.value.name);

</script>

<template>
    <section>
        <header>
            <div v-if="$page.props.originPage != 'UsuariosEdit' && $page.props.auth.user.email != form.email" class="">
                <Link class="text-indigo-400 hover:text-indigo-600" href="/informacionUsuario">Información usuario</Link> /
                editar información de {{ form.name }}
            </div>

            <div v-if="$page.props.auth.user.id && $page.props.auth.user.email != form.email && $page.props.originPage == 'UsuariosEdit'">
                <Link class="text-indigo-400 hover:text-indigo-600" href="/users">Usuarios</Link> /
                editar información de {{ form.name }}
            </div>

            <h2 class="text-lg font-medium text-gray-900">Información de perfil</h2>

            <p class="mt-1 text-sm text-gray-600">
                Actualiza tu información de usuario y correo.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update', { id: $page.props.id_user, originPage: $page.props.originPage }))"
            class="mt-6 space-y-6">
            <!-- nombre -->
            <div>
                <InputLabel for="name" value="Nombre" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <!-- email -->
            <div>
                <InputLabel for="email" value="Correo" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <!-- VISTA EDIT INFORMACION -->
            <div class="" v-if="$page.props.originPage != 'UsuariosEdit'">
                <!-- identificacion -->
                <div>
                    <InputLabel for="identificacion" value="identificación" />

                    <TextInput id="identificacion" type="identificacion" class="mt-1 block w-full"
                        v-model="form.identificacion" autocomplete="identificacion" />

                    <InputError class="mt-2" :message="form.errors.identificacion" />
                </div>
                <!-- edad -->
                <div>
                    <InputLabel class="mt-4 block w-full" for="edad" value="Edad" />

                    <TextInput id="edad" type="edad" class="mt-1 block w-full" v-model="form.edad" autocomplete="edad" />

                    <InputError class="mt-2" :message="form.errors.edad" />
                </div>
                <!-- ciudad -->
                <div>
                    <InputLabel class="mt-4 block w-full" for="ciudad" value="Ciudad" />

                    <TextInput id="ciudad" type="ciudad" class="mt-1 block w-full" v-model="form.ciudad"
                        autocomplete="ciudad" />

                    <InputError class="mt-2" :message="form.errors.ciudadciudad" />
                </div>

                <!-- Facultad -->
                <div>
                    <InputLabel class="mt-4 block w-full" for="facultad" value="Facultad" />

                    <TextInput id="facultad" type="facultad" class="mt-1 block w-full" v-model="form.facultad"
                        autocomplete="facultad" />

                    <InputError class="mt-2" :message="form.errors.facultad" />
                </div>
                <!-- semestre -->
                <div>
                    <InputLabel class="mt-4 block w-full" for="semestre" value="Semestre" />

                    <TextInput id="semestre" type="semestre" class="mt-1 block w-full" v-model="form.semestre"
                        autocomplete="semestre" />

                    <InputError class="mt-2" :message="form.errors.semestre" />
                </div>
            </div>


            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Tu correo no esta verificado.
                    <Link :href="route('verification.send')" method="post" as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Haz clic aquí para reenviar la autentificación.
                    </Link>
                </p>

                <div v-show="status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-600">
                    Un nuevo link de verificación ha sido enviado a su correo.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Guardar</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Guardado.</p>
                </Transition>
            </div>
        </form>
    </section></template>
