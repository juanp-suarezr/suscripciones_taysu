<template>
    <Head title="Email Verification" />

    <GuestLayout>
        <Link href="/" class="mb-4 flex items-center justify-center">
            <img class="w-60 object-cover text-gray-500" src="../../../assets/TAYSU LOGO REGISTRADO.svg">
        </Link>

        <div class="mb-4 text-sm text-gray-600">
            Gracias por registrarse, Antes de empezar, porfavor validarse dando clic en el email que justo enviamos.
        </div>

        <div class="mb-4 text-sm font-medium text-green-600" v-if="verificationLinkSent">
            Una nueva validación ha sido enviada a su correo.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reenviar validación al correo.
                </PrimaryButton>

                <Link :href="route('logout')" method="post" as="button" class="text-sm text-gray-600 underline hover:text-gray-900">
                    Cerrar sesión
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>
