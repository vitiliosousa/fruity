<template>
    <div class="min-h-screen flex">
        <AuthImageSide />
        <div
            class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <!-- Logo for mobile -->
                <div class="lg:hidden text-center mb-8">
                    <h1 class="text-4xl font-bold text-green-700">Fruity</h1>
                </div>
                <Head title="Registrar" />

                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-green-700 mb-2">
                        Criar Conta
                    </h2>
                    <p class="text-green-600">
                        Preencha os dados para se cadastrar
                    </p>
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <InputLabel
                            for="name"
                            value="Nome"
                            class="text-green-700 font-semibold mb-2"
                        />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-green-500 transition"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Seu nome completo"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel
                            for="email"
                            value="Email"
                            class="text-green-700 font-semibold mb-2"
                        />
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-green-500 transition"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="seu@email.com"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div>
                        <InputLabel
                            for="password"
                            value="Senha"
                            class="text-green-700 font-semibold mb-2"
                        />
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-green-500 transition"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>
                    <div>
                        <InputLabel
                            for="password_confirmation"
                            value="Confirmar Senha"
                            class="text-green-700 font-semibold mb-2"
                        />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-green-500 transition"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.password_confirmation"
                        />
                    </div>
                    <div class="space-y-4 pt-2">
                        <button
                            type="submit"
                            class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition shadow-lg hover:shadow-xl disabled:opacity-50"
                            :disabled="form.processing"
                        >
                            <span v-if="!form.processing">Criar Conta</span>
                            <span v-else>Criando...</span>
                        </button>
                        <div class="text-center text-sm">
                            <span class="text-gray-600">Já tem uma conta?</span>
                            <Link
                                :href="route('login')"
                                class="ml-2 text-green-600 hover:text-green-700 font-bold"
                            >
                                Fazer login
                            </Link>
                        </div>
                        <div class="text-center pt-2">
                            <Link
                                href="/"
                                class="text-sm text-green-600 hover:text-green-700 font-semibold">
                                ← Voltar para início
                            </Link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthImageSide from "@/Components/AuthImageSide.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>