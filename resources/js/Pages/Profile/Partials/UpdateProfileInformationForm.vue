<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <!-- Header -->
        <header class="mb-6">
            <h2 class="text-2xl font-bold text-green-700">
                Informações do Perfil
            </h2>
            <p class="mt-2 text-gray-600">
                Atualize as informações do seu perfil e endereço de e-mail.
            </p>
        </header>

        <!-- Formulário -->
        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="space-y-6"
        >
            <!-- Nome -->
            <div>
                <InputLabel for="name" value="Nome" class="text-green-700" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full border-green-200 focus:border-green-500 focus:ring-green-500 rounded-xl"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2 text-red-500" :message="form.errors.name" />
            </div>

            <!-- Email -->
            <div>
                <InputLabel for="email" value="E-mail" class="text-green-700" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full border-green-200 focus:border-green-500 focus:ring-green-500 rounded-xl"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2 text-red-500" :message="form.errors.email" />
            </div>

            <!-- Verificação de email -->
            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm text-gray-800">
                    Seu endereço de e-mail não está verificado.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="text-green-600 underline hover:text-green-800 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                    >
                        Clique aqui para reenviar o e-mail de verificação
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 text-sm font-medium text-green-600"
                >
                    Um novo link de verificação foi enviado para seu e-mail.
                </div>
            </div>

            <!-- Botão Salvar -->
            <div class="flex items-center gap-4">
                <PrimaryButton
                    :disabled="form.processing"
                    class="bg-green-600 hover:bg-green-700 text-white rounded-xl shadow-md px-6 py-3"
                >
                    Salvar
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out duration-300"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out duration-300"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-green-700">
                        Salvo com sucesso!
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
