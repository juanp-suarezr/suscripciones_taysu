<template>
    <Head title="Log in" />

    <GuestLayout>
        <Link href="/" class="flex items-center justify-center">
        <img class="h-28 w-28 fill-current text-gray-500" src="../../../assets/TS NUEVO.png">
        </Link>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Correo electronico" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                    autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-3">
                <InputLabel for="password" value="Contraseña" />
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="current-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 flex justify-between">
                <label class="inline-flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="mx-2 text-sm text-gray-600">Recordar</span>
                </label>

                <Link v-if="canResetPassword" :href="route('password.request')"
                    class="text-sm text-gray-600 underline hover:text-gray-900">
                Olvidaste tu contraseña?
                </Link>
            </div>

            <div class="mt-6">
                <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Iniciar Sesión
                </PrimaryButton>
                <Link :href="route('register')" class="mt-4 text-sm text-gray-600 underline hover:text-gray-900">
                no esta registrado?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>

import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useToast } from 'vue-toast-notification';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const pendientes = usePage().props.clientes.data;
const usuarioLog = ref([]);

const $toast = useToast();

const submit = () => {
    for (let pendiente of pendientes) {
        if (pendiente.email == form.email) {
            usuarioLog.value.push(pendiente);
        }
    }

    if (usuarioLog.value.length > 0) {
        let instance = $toast.open({
            message: "Eres muy especial para la taysu familia, pero no puedes acceder a esta zona.",
            type: 'warning',
            position: 'top-right',
            duration: 8000,
            pauseOnHover: true,

        });

        setTimeout(() => {
            // Redireccionar usando Inertia
            window.location.href = "/dashboard";
        }, 8000);

    } else {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    }

};
</script>
