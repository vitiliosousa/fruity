<template>
    <div class="min-h-screen flex">
        <AuthImageSide />
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <!-- Logo for mobile -->
                <div class="lg:hidden text-center mb-8">
                    <h1 class="text-4xl font-bold text-green-700">Fruity</h1>
                </div>
                <Head title="Recuperar Senha" />
                
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-green-700 mb-2">
                        Esqueceu a Senha?
                    </h2>
                    <p class="text-green-600">
                        Sem problemas. Informe seu email e enviaremos um link para redefinir sua senha.
                    </p>
                </div>

                <div v-if="status" class="mb-6 p-4 bg-green-100 border-l-4 border-green-600 text-green-700 rounded-lg">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <InputLabel for="email" value="Email" class="text-green-700 font-semibold mb-2" />
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-green-500 transition"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="seu@email.com"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="space-y-4">
                        <button
                            type="submit"
                            class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition shadow-lg hover:shadow-xl disabled:opacity-50"
                            :disabled="form.processing"
                        >
                            <span v-if="!form.processing">Enviar Link de Recuperação</span>
                            <span v-else>Enviando...</span>
                        </button>

                        <div class="text-center text-sm">
                            <Link
                                :href="route('login')"
                                class="text-green-600 hover:text-green-700 font-bold"
                            >
                                ← Voltar para o login
                            </Link>
                        </div>
                        <div class="text-center pt-2">
                            <Link
                                href="/"
                                class="text-sm text-green-600 hover:text-green-700 font-semibold"
                            >
                                Voltar para início
                            </Link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthImageSide from '@/Components/AuthImageSide.vue';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>