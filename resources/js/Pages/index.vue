<template>
    <main>
        <section id="home">
            <div class="grid gap-2 px-4 pt-24 md:grid-cols-2 md:px-20">
                <div class="flex flex-col justify-center space-y-6">
                    <div class="text-5xl font-bold leading-[3.5rem] text-dark-black">
                        {{ settings?.homeHeader1 }}
                    </div>
                    <div class="text-base text-gray-600">
                        {{ settings?.homeDetail1 }}
                    </div>
                    <button class="w-44 rounded-md px-4 py-2 font-semibold outline outline-black hover:bg-gray-200">
                        Get Registered
                    </button>
                </div>
                <div class="flex justify-center">
                    <img class="md:max-h-[520px] md:max-w-[520px]" :src="homeImage" alt="" />
                </div>
            </div>

            <div class="flex flex-col space-y-24 px-4 pt-52 md:px-20">
                <div class="text-center text-5xl font-bold leading-[3.5rem] text-dark-black">
                    {{ settings?.homeHeader2 }}
                </div>
                <div class="text-center text-base text-gray-600">
                    {{ settings?.homeDetail2 }}
                </div>
                <div class="grid grid-cols-1 gap-x-8 gap-y-4 md:grid-cols-2 lg:grid-cols-4">
                    <div class="flex flex-col">
                        <div class="rounded-tl-2xl bg-dark-gray py-4 text-center text-lg font-bold text-white">
                            {{ settings?.homeBox1Header }}
                        </div>
                        <div class="rounded-br-2xl pb-8 pt-1 text-center shadow-2xl">
                            {{ settings?.homeBox1Detail }}
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="rounded-tl-2xl bg-dark-gray py-4 text-center text-lg font-bold text-white">
                            {{ settings?.homeBox2Header }}
                        </div>
                        <div class="rounded-br-2xl pb-8 pt-1 text-center shadow-2xl">
                            {{ settings?.homeBox2Detail }}
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="rounded-tl-2xl bg-dark-gray py-4 text-center text-lg font-bold text-white">
                            {{ settings?.homeBox3Header }}
                        </div>
                        <div class="rounded-br-2xl pb-8 pt-1 text-center shadow-2xl">
                            {{ settings?.homeBox3Detail }}
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="rounded-tl-2xl bg-dark-gray py-4 text-center text-lg font-bold text-white">
                            {{ settings?.homeBox4Header }}
                        </div>
                        <div class="rounded-br-2xl pb-8 pt-1 text-center shadow-2xl">
                            {{ settings?.homeBox4Detail }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features">
            <div class="space-y-32 px-4 pt-52 md:px-20">
                <div class="grid xs:grid-cols-1 md:grid-cols-2">
                    <div class="flex flex-col justify-center space-y-2 md:order-1">
                        <div class="text-2xl font-bold text-dark-black">
                            {{ settings?.feature1Header }}
                        </div>
                        <div class="text-base text-gray-600">
                            {{ settings?.feature1Detail }}
                        </div>
                    </div>
                    <div class="flex justify-center md:order-2">
                        <img class="md:max-h-[520px] md:max-w-[520px]" :src="feature1Image" alt="" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="flex flex-col justify-center space-y-2 md:order-2">
                        <div class="text-2xl font-bold text-dark-black">
                            {{ settings?.feature2Header }}
                        </div>
                        <div class="text-base text-gray-600">
                            {{ settings?.feature2Detail }}
                        </div>
                    </div>
                    <div class="flex justify-center md:order-1">
                        <img class="md:max-h-[520px] md:max-w-[520px]" :src="feature2Image" alt="" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="flex flex-col justify-center space-y-2 md:order-1">
                        <div class="text-2xl font-bold text-dark-black">
                            {{ settings?.feature3Header }}
                        </div>
                        <div class="text-base text-gray-600">
                            {{ settings?.feature3Detail }}
                        </div>
                    </div>
                    <div class="flex justify-center md:order-2">
                        <img class="md:order-2 md:max-h-[520px] md:max-w-[520px]" :src="feature3Image" alt="" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="flex flex-col justify-center space-y-2 md:order-2">
                        <div class="text-2xl font-bold text-dark-black">
                            {{ settings?.feature4Header }}
                        </div>
                        <div class="text-base text-gray-600">
                            {{ settings?.feature4Detail }}
                        </div>
                    </div>
                    <div class="flex justify-center md:order-1">
                        <img class="md:order-2 md:max-h-[520px] md:max-w-[520px]" :src="feature4Image" alt="" />
                    </div>
                </div>
            </div>
        </section>

        <section id="register">
            <div class="pt-52 text-white">
                <div class="flex flex-col space-y-6 bg-dark-gray py-10 text-center">
                    <div class="text-base">{{ settings?.registrationText }}</div>
                    <div>
                        <button class="outline-3 rounded-sm px-8 py-2 text-lg font-bold outline-gray-100">
                            Register Now
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="px-4 pt-52 md:px-20">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="flex flex-col space-y-2">
                        <p class="text-2xl font-bold text-dark-black">Contact-us</p>
                        <p class="text-base text-gray-600">
                            {{ settings?.contactUsText }}
                        </p>
                        <p class="text-base text-gray-600">
                            {{ settings?.contactUsTelephone }}
                        </p>
                        <p class="text-base text-gray-600">
                            {{ settings?.contactUsEmail }}
                        </p>
                    </div>
                    <div>
                        <form @submit.prevent="saveContact" class="space-y-8">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Name</label>
                                <input type="text" v-model="contactForm.name" autocomplete="off"
                                    class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                                <p v-if="contactForm.errors.name" class="mt-2 text-sm text-red-500">
                                    {{ contactForm.errors.name }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Email</label>
                                <input type="email" v-model="contactForm.email" autocomplete="off"
                                    class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                                <p v-if="contactForm.errors.email" class="mt-2 text-sm text-red-500">
                                    {{ contactForm.errors.email }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Message</label>
                                <textarea v-model="contactForm.message"
                                    class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"
                                    rows="6"></textarea>
                                <p v-if="contactForm.errors.message" class="mt-2 text-sm text-red-500">
                                    {{ contactForm.errors.message }}
                                </p>
                            </div>
                            <div>
                                <button :disabled="contactForm.processing" type="submit"
                                    class="w-full cursor-pointer rounded-3xl bg-dark-gray py-2 text-lg font-semibold text-white disabled:bg-gray-300">
                                    Submit
                                </button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script lang="ts" setup>
import { computed } from 'vue';
import Default from '../Layouts/default.vue';
import { useToast } from 'vue-toastification';
import {PageProps} from '@inertiajs/vue3';
import { useForm,usePage } from '@inertiajs/vue3';
defineOptions({ layout: Default });

const settings = usePage<PageProps>().props.appSettings;
const toast = useToast();
const contactForm = useForm({
    name: "",
    email: "",
    message: "",
});
const successMessage = computed(() => usePage<PageProps>().props.flash.success);
const homeImage = computed(() => {
    return window.location.origin + '/images/' + settings?.homePicture;
})
const feature1Image = computed(() => {
    return window.location.origin + '/images/' + settings?.feature1Picture;
})
const feature2Image = computed(() => {
    return window.location.origin + '/images/' + settings?.feature2Picture;
})
const feature3Image = computed(() => {
    return window.location.origin + '/images/' + settings?.feature3Picture;
})
const feature4Image = computed(() => {
    return window.location.origin + '/images/' + settings?.feature4Picture;
})

//handle form submission
const saveContact = () => {
    contactForm.post('/storeContact', {
        preserveScroll: true,
        onSuccess: () => {
            contactForm.reset();
            toast.success(successMessage.value);
        },
    });
};
</script>