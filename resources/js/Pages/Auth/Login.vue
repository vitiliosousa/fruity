<template>
    <div class="min-h-screen flex">
        <AuthImageSide />

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <!-- Logo for mobile -->
                <div class="lg:hidden text-center mb-8">
                    <h1 class="text-4xl font-bold text-green-700">Fruity</h1>
                </div>

                <Head title="Login" />

                <!-- Welcome Text -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-green-700 mb-2">
                        Entrar
                    </h2>
                    <p class="text-green-600">
                        Entre na sua conta para continuar
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

                    <div>
                        <InputLabel for="password" value="Senha" class="text-green-700 font-semibold mb-2" />

                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-green-500 transition"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                        />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <Checkbox name="remember" v-model:checked="form.remember" class="rounded border-green-300 text-green-600 focus:ring-green-500" />
                            <span class="ml-2 text-sm text-green-700">Lembrar-me</span>
                        </label>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-sm text-green-600 hover:text-green-700 font-semibold"
                        >
                            Esqueceu a senha?
                        </Link>
                    </div>

                    <div class="space-y-4">
                        <button
                            type="submit"
                            class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition shadow-lg hover:shadow-xl disabled:opacity-50"
                            :disabled="form.processing"
                        >
                            <span v-if="!form.processing">Entrar</span>
                            <span v-else>Entrando...</span>
                        </button>

                        <div class="text-center text-sm">
                            <span class="text-gray-600">Não tem uma conta?</span>
                            <Link
                                :href="route('register')"
                                class="ml-2 text-green-600 hover:text-green-700 font-bold"
                            >
                                Criar conta
                            </Link>
                        </div>

                        <div class="text-center pt-2">
                            <Link
                                href="/"
                                class="text-sm text-green-600 hover:text-green-700 font-semibold"
                            >
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
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthImageSide from '@/Components/AuthImageSide.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>