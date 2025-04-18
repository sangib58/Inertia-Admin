<template>
    <div>
        <header class="sticky top-0 flex items-center justify-between bg-light-gray px-2 py-2 shadow-2xl">
            <img class="size-12 object-contain" :src="siteLogo" />
            <div class="hidden space-x-2 md:block">
                <Link :href="homeUrl"
                    class="rounded-md px-2 py-1.5 text-base font-semibold text-gray-700 hover:bg-gray-200">Home
                </Link>
                <Link :href="featureUrl"
                    class="rounded-md px-2 py-1.5 text-base font-semibold text-gray-700 hover:bg-gray-200">Features
                </Link>
                <Link :href="contactUrl"
                    class="rounded-md px-2 py-1.5 text-base font-semibold text-gray-700 hover:bg-gray-200">Contact
                </Link>
            </div>
            <button @click.stop="$inertia.visit('/signIn')"
                class="cursor-pointer hidden rounded-md px-3 py-1 text-base font-semibold text-gray-700 outline outline-black hover:bg-gray-200 md:block">
                Sign In
            </button>
            <span class="cursor-pointer md:hidden" @click.stop="showNav = !showNav">
                <Icon icon-name="mdiMenu" size="26" color="#3a484a" />
            </span>
        </header>
        <Teleport to="body" v-if="showNav">
            <div class="fixed inset-0 z-50 bg-black/50" @click="showNav = !showNav">
                <nav class="left-0 top-0 min-h-full w-64 bg-dark-gray text-white" @click.stop>
                    <div class="flex flex-col">
                        <div class="flex justify-center py-[17px] text-xl font-semibold">
                            {{ settings?.siteTitle }}
                        </div>
                        <div class="border-b border-t border-b-gray-100 border-t-gray-100">
                            <ul class="py-2">
                                <li class="py-3 pl-6 hover:bg-gray-600">
                                    <Link class="flex" :href="homeUrl"><span>
                                        <Icon icon-name="mdiAccount" size="26" color="#ffffff" />
                                    </span><span class="pl-6 text-base font-semibold">Home</span></Link>
                                </li>
                                <li class="py-3 pl-6 hover:bg-gray-600">
                                    <Link class="flex" :href="featureUrl"><span>
                                        <Icon icon-name="mdiFeatureSearch" size="26" color="#ffffff" />
                                    </span><span class="pl-6 text-base font-semibold">Features</span></Link>
                                </li>
                                <li class="py-3 pl-6 hover:bg-gray-600">
                                    <Link class="flex" :href="contactUrl"><span>
                                        <Icon icon-name="mdiContacts" size="26" color="#ffffff" />
                                    </span><span class="pl-6 text-base font-semibold">Contact</span></Link>
                                </li>
                            </ul>
                        </div>
                        <div class="flex cursor-pointer py-4 hover:bg-gray-600" @click.stop="$inertia.visit('/signIn')">
                            <span class="pl-6">
                                <Icon icon-name="mdiLogin" size="26" color="#ffffff" />
                            </span>
                            <span class="pl-6 text-base font-semibold">Sign In</span>
                        </div>
                    </div>
                </nav>
            </div>
        </Teleport>

        <slot />

        <footer class="mt-52">
            <div class="bg-dark-gray py-2 text-center text-white">
                <div class="space-y-6">
                    <div class="flex justify-center space-x-6">
                        <a :href="settings?.footerInstagram" target="_blank">
                            <Icon icon-name="mdiInstagram" size="26" color="#ffffff" />
                        </a>
                        <a :href="settings?.footerLinkedin" target="_blank">
                            <Icon icon-name="mdiLinkedin" size="26" color="#ffffff" />
                        </a>
                        <a :href="settings?.footerFacebook" target="_blank">
                            <Icon icon-name="mdiFacebook" size="26" color="#ffffff" />
                        </a>
                        <a :href="settings?.footerTwitter" target="_blank">
                            <Icon icon-name="mdiTwitter" size="26" color="#ffffff" />
                        </a>
                    </div>
                    <div>{{ settings?.footerText }}</div>
                    <div class="border-t border-white pt-4">
                        {{ settings?.copyRightText }}
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script lang="ts" setup>
import { usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import { PageProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import Icon from '../Components/helper/Icon.vue';
import fallBackLogo from '~/images/vue-admin-logo.png';

const settings = usePage<PageProps>().props.appSettings;
const showNav = ref(false);
const homeUrl = ref("");
const featureUrl = ref("");
const contactUrl = ref("");
const siteLogo = computed(() => {
    if (settings?.logoPath == '' || settings?.logoPath == null) {
        return fallBackLogo;
    } else {
        return window.location.origin + '/images/' + settings?.logoPath;
    }
});

onMounted(() => {
    homeUrl.value = window?.location.origin + '/#homeUrl';
    featureUrl.value = window?.location.origin + '/#features';
    contactUrl.value = window?.location.origin + '/#contact';
});
</script>