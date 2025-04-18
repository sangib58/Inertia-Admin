<template>
    <div class="flex h-screen items-center justify-center">
        <div v-if="registerWindow"
            class="flex min-h-[510px] min-w-[380px] flex-col space-y-12 rounded-br-3xl rounded-tl-3xl px-4 py-2 shadow-2xl">
            <div class="flex flex-col items-center justify-center">
                <img class="size-12 cursor-pointer object-contain" @click.stop="$inertia.visit('/')" :src="siteLogo" />
                <div class="text-xl font-semibold">Register</div>
            </div>
            <div>
                <form @submit.prevent="register">
                    <div>
                        <label
                            class="block text-sm font-semibold after:ml-0.5 after:text-red-500 after:content-['*']">Name</label>
                        <input type="text" autocomplete="off" v-model="registerform.fullName"
                            class="w-full rounded-2xl px-2 py-1 outline outline-gray-600 focus:outline-blue-600" />
                        <p v-if="registerform.errors.fullName" class="mt-2 text-sm text-red-500">
                            {{ registerform.errors.fullName }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-semibold after:ml-0.5 after:text-red-500 after:content-['*']">Email</label>
                        <input type="email" autocomplete="off" v-model="registerform.email"
                            class="w-full rounded-2xl px-2 py-1 outline outline-gray-600 focus:outline-blue-600" />
                        <p v-if="registerform.errors.email" class="mt-2 text-sm text-red-500">
                            {{ registerform.errors.email }}
                        </p>
                    </div>
                    <div class="pt-2">
                        <label
                            class="block text-sm font-semibold after:ml-0.5 after:text-red-500 after:content-['*']">Password</label>
                        <input type="password" v-model="registerform.password" autocomplete="off"
                            class="w-full rounded-2xl px-2 py-1 outline outline-gray-600 focus:outline-blue-600" />
                        <p v-if="registerform.errors.password" class="mt-2 text-sm text-red-500">
                            {{ registerform.errors.password }}
                        </p>
                    </div>
                    <div class="mt-12 flex justify-between">
                        <button class="cursor-pointer text-base font-semibold" @click.stop="resetWindow">
                            Close
                        </button>
                        <button class="cursor-pointer text-base font-semibold disabled:text-gray-300" type="submit"
                            :disabled="registerform.processing">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="forgetPasswordWindow"
            class="flex min-h-[510px] min-w-[380px] flex-col space-y-12 rounded-br-3xl rounded-tl-3xl px-4 py-2 shadow-2xl">
            <div class="flex flex-col items-center justify-center">
                <img class="size-12 cursor-pointer object-contain" @click.stop="$inertia.visit('/')" :src="siteLogo" />
                <div class="text-xl font-semibold">Forget Password</div>
            </div>
            <div>
                <form @submit.prevent="sendPassword">
                    <div>
                        <label
                            class="block text-sm font-semibold after:ml-0.5 after:text-red-500 after:content-['*']">Email</label>
                        <input type="email" autocomplete="off" v-model="passwordEmail"
                            class="w-full rounded-2xl px-2 py-1 outline outline-gray-600 focus:outline-blue-600" />
                    </div>
                    <div class="mt-12 flex justify-between">
                        <button class="cursor-pointer text-base font-semibold" @click.stop="resetWindow">
                            Close
                        </button>
                        <button class="cursor-pointer text-base font-semibold" type="submit">
                            Sent Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="signInWindow"
            class="flex min-h-[510px] min-w-[380px] flex-col space-y-12 rounded-br-3xl rounded-tl-3xl px-4 py-2 shadow-2xl">
            <div class="flex flex-col items-center justify-center">
                <img class="size-12 cursor-pointer object-contain" @click.stop="$inertia.visit('/')" :src="siteLogo" />
                <div class="text-xl font-semibold">{{ allSettings?.siteTitle }}</div>
                <div class="text-sm font-light">{{ allSettings?.welComeMessage }}</div>
            </div>
            <div>
                <form @submit.prevent="login">
                    <div>
                        <label
                            class="block text-sm font-semibold after:ml-0.5 after:text-red-500 after:content-['*']">Email</label>
                        <input type="email" autocomplete="off" v-model="signInform.email"
                            class="w-full rounded-2xl px-2 py-1 outline outline-gray-600 focus:outline-blue-600" />
                        <p v-if="signInform.errors.email" class="mt-2 text-sm text-red-500">
                            {{ signInform.errors.email }}
                        </p>
                    </div>
                    <div class="pt-2">
                        <label
                            class="block text-sm font-semibold after:ml-0.5 after:text-red-500 after:content-['*']">Password</label>
                        <input type="password" v-model="signInform.password" autocomplete="off"
                            class="w-full rounded-2xl px-2 py-1 outline outline-gray-600 focus:outline-blue-600" />
                        <p v-if="signInform.errors.password" class="mt-2 text-sm text-red-500">
                            {{ signInform.errors.password }}
                        </p>
                    </div>
                    <div class="flex justify-center space-x-2 pt-16 font-semibold">
                        <span class="cursor-pointer" @click.stop="adminCred">Admin</span>
                        <span class="cursor-pointer" @click.stop="userCred">User</span>
                    </div>
                    <div class="flex flex-col space-y-1 pt-2">
                        <button type="submit" :disabled="signInform.processing"
                            class="rounded-3xl cursor-pointer bg-dark-gray py-1 font-semibold text-white outline disabled:bg-gray-300">
                            Sign In
                        </button>
                        <button @click.stop="registerToggle" type="button"
                            class="bg-deep-gray cursor-pointer rounded-3xl py-1 font-semibold text-gray-800">
                            Register
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex justify-center">
                <div class="cursor-pointer font-semibold" @click.stop="forgetPasswordToggle">
                    Forget Password
                </div>
            </div>
        </div>
    </div>
</template>


<script lang="ts" setup>
import { useToast } from 'vue-toastification';
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { PageProps } from '@inertiajs/vue3';
import { detect } from 'detect-browser';
import { computed, onMounted, ref } from 'vue';
import fallBackLogo from '../../../public/images/vue-admin-logo.png';

const toast = useToast();
const browser = detect();
const allSettings = usePage<PageProps>().props.appSettings;
const signInWindow = ref(true);
const registerWindow = ref(false);
const forgetPasswordWindow = ref(false);

const signInform = useForm({
    email: "",
    password: "",
});
const registerform = useForm({
    fullName: "",
    email: "",
    password: "",
});
const userLog = useForm({
    browser: browser?.name,
    platform: browser?.os,
    browserVersion: browser?.version,
    ipAddress: null,
});
const passwordEmail = ref("");

const adminCred = () => {
    signInform.email = "admin@vueadmin.com";
    signInform.password = "abcd1234";
};
const userCred = () => {
    signInform.email = "user@vueadmin.com";
    signInform.password = "abcd1234";
};

const siteLogo = computed(() => {
    if (allSettings?.logoPath == '' || allSettings?.logoPath == null) {
        return fallBackLogo;
    } else {
        return window.location.origin + '/images/' + allSettings?.logoPath;
    }
});

const registerToggle = () => {
    registerWindow.value = true;
    signInWindow.value = false;
    forgetPasswordWindow.value = false;
};

const forgetPasswordToggle = () => {
    registerWindow.value = false;
    signInWindow.value = false;
    forgetPasswordWindow.value = true;
};

const resetWindow = () => {
    registerWindow.value = false;
    signInWindow.value = true;
    forgetPasswordWindow.value = false;
};

const login = () => {
    signInform.post('/signInPost', {
        preserveScroll: true,
        onSuccess: () => {
            //console.log('success')
            browseHistory();
            if (Object.keys(signInform.errors).length == 0) {
                signInform.reset();
            }
        }
    });
}

const register = () => {
    registerform.post('/register', {
        preserveScroll: true,
        onSuccess: () => {
            browseHistory();
            if (Object.keys(registerform.errors).length == 0) {
                registerform.reset();
            }
        }
    });
}

const sendPassword = () => {
    console.log('sendPassword')
}

const browseHistory = async () => {
    const response = await fetch("https://api.ipify.org?format=json");
    if (response.ok) {
        const data = await response.json();
        userLog.ipAddress = data.ip;
        userLog.post('/user-log', {
            onSuccess: () => {
                if (Object.keys(userLog.errors).length == 0) {
                    userLog.reset();
                }
            },
        });
    }
}

onMounted(() => {
    resetWindow();
});
</script>