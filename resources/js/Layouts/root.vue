<template>
    <div @click="closePopUps" ref="fullScreenElement">
        <nav class="sidebar fixed left-0 top-0 z-50 min-h-full w-64 bg-dark-black"
            :class="{ 'sidebar-hidden': hideSidebar }">
            <div class="flex flex-col">
                <div class="flex space-x-2 border-b border-b-gray-800 px-4 py-4">
                    <img :src="profileImg" class="size-12 rounded-full object-cover" />
                    <div class="flex flex-col justify-center text-white">
                        <span class="text-sm font-bold">{{ userInfo?.name }}</span>
                        <span class="text-xs font-medium text-blue-600">{{
                            userInfo?.roleName
                        }}</span>
                    </div>
                </div>
                <div class="mt-4 px-3">
                    <ul class="space-y-1">
                        <!-- <li v-for="(item, index) in menu" :key="index">
                            <Link :href=item.route @click.prevent="item.route == '' && $event.stopPropagation()"
                                class="parent cursor-pointer flex items-center px-3 py-3.5 text-gray-300 hover:rounded-lg hover:bg-semi-black hover:text-white"
                                :class="{
                                    'parent-active': usePage().url === item.route,
                                }" @click.stop="toggleItem(index)">
                            <span>
                                <Icon :icon-name="item.icon" size="20" color="#ffffff" />
                            </span>
                            <span class="ml-2 text-sm">{{ item.title }}</span>
                            <span class="ml-auto" v-if="item.childItems.length > 0">
                                <Icon v-if="index === expandedIndex" icon-name="mdiArrowDown" size="18"
                                    color="#ffffff" />
                                <Icon v-else icon-name="mdiArrowRight" size="18" color="#ffffff" />
                            </span>
                            </Link>
                            <ul v-if="item.childItems.length > 0" :class="{
                                'child-menu': true,
                                'child-menu-expanded': index === expandedIndex,
                            }">
                                <li v-for="(child, cIndex) in item.childItems" :key="cIndex" class="ml-6 mt-3">
                                    <Link :href="child.route" class="child text-gray-300 before:mr-4"><span
                                        class="text-sm">{{ child.title }}</span></Link>
                                </li>
                            </ul>
                        </li> -->
                        <li v-for="(item, index) in menu" :key="index">
                            <template v-if="item.route">
                                <Link :href="item.route" @click.stop="toggleItem(index)"
                                    class="parent cursor-pointer flex items-center px-3 py-3.5 text-gray-300 hover:rounded-lg hover:bg-semi-black hover:text-white"
                                    :class="{
                                        'parent-active': usePage().url === item.route,
                                    }">
                                <span>
                                    <Icon :icon-name="item.icon" size="20" color="#ffffff" />
                                </span>
                                <span class="ml-2 text-sm">{{ item.title }}</span>
                                <span class="ml-auto" v-if="item.childItems.length > 0">
                                    <Icon v-if="index === expandedIndex" icon-name="mdiArrowDown" size="18"
                                        color="#ffffff" />
                                    <Icon v-else icon-name="mdiArrowRight" size="18" color="#ffffff" />
                                </span>
                                </Link>
                            </template>
                            <template v-else>
                                <div @click.stop="toggleItem(index)"
                                    class="parent cursor-pointer flex items-center px-3 py-3.5 text-gray-300 hover:rounded-lg hover:bg-semi-black hover:text-white">
                                    <span>
                                        <Icon :icon-name="item.icon" size="20" color="#ffffff" />
                                    </span>
                                    <span class="ml-2 text-sm">{{ item.title }}</span>
                                    <span class="ml-auto" v-if="item.childItems.length > 0">
                                        <Icon v-if="index === expandedIndex" icon-name="mdiArrowDown" size="18"
                                            color="#ffffff" />
                                        <Icon v-else icon-name="mdiArrowRight" size="18" color="#ffffff" />
                                    </span>
                                </div>
                            </template>

                            <ul v-if="item.childItems.length > 0" :class="{
                                'child-menu': true,
                                'child-menu-expanded': index === expandedIndex,
                            }">
                                <li v-for="(child, cIndex) in item.childItems" :key="cIndex" class="ml-6 mt-3">
                                    <Link :href="child.route" class="child text-gray-300 before:mr-4">
                                    <span class="text-sm">{{ child.title }}</span>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div @click.stop="hideSidebar = true"
            class="overlay fixed z-40 ml-64 min-h-full w-[calc(100%-256px)] bg-black opacity-50 md:hidden"
            :class="{ 'overlay-hidden': hideSidebar }"></div>
        <main class="relative min-h-screen w-full" :class="{
            'md:ml-64 md:w-[calc(100%-256px)]': hideSidebar == false,
            'full-screen': isFullScreen,
        }">
            <header class="sticky top-0 z-30 flex items-center justify-between bg-light-gray px-2 py-2 shadow-2xl">
                <span @click.stop="sidebarToggle" class="cursor-pointer rounded-full p-1.5 hover:bg-ultra-light-gray">
                    <Icon icon-name="mdiMenu" size="24" color="#3a484a" />
                </span>
                <div class="flex space-x-12">
                    <span @click.stop="toggleFullScreen"
                        class="cursor-pointer rounded-full p-1.5 hover:bg-ultra-light-gray">
                        <Icon v-if="isFullScreen == false" icon-name="mdiFullscreen" size="24" color="#3a484a" />
                        <Icon v-else icon-name="mdiFullscreenExit" size="24" color="#3a484a" />
                    </span>
                    <span class="cursor-pointer rounded-full p-1.5 hover:bg-ultra-light-gray">
                        <Icon icon-name="mdiLock" size="24" color="#3a484a" @click.stop="openUserLock" />
                    </span>
                    <div @click.stop="
                        showNotification = !showNotification;
                    showPersonalize = false;
                    " class="flex cursor-pointer rounded-full p-1.5 hover:bg-ultra-light-gray">
                        <span>
                            <Icon icon-name="mdiBell" size="24" color="#3a484a" />
                        </span>
                        <span
                            class="absolute right-[242px] top-[1px] flex size-8 items-center justify-center rounded-full bg-semi-black text-sm font-semibold text-white">{{
                                notifications?.recordsTotal }}</span>
                        <div :class="{
                            'child-menu-notification': true,
                            'child-menu-expanded-notification':
                                notifications?.recordsTotal > 0 && showNotification,
                        }"
                            class="absolute right-0 top-10 max-h-64 space-y-1 overflow-y-scroll rounded-md bg-white shadow-2xl shadow-black/70">
                            <div v-for="(item, index) in notifications?.data" :key="index"
                                class="p-2 text-lg font-medium text-gray-700 odd:bg-white even:bg-light-gray">
                                LogIn Time: {{ item.logInTime }} IP: {{ item.ip }} Browser:
                                {{ item.browser }} Platform: {{ item.platform }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-0">
                        <button @click.stop="
                            showPersonalize = !showPersonalize;
                        showNotification = false;
                        " class="rounded-md p-1 px-2 hover:bg-ultra-light-gray focus:bg-ultra-light-gray">
                            <div class="flex">
                                <span class="pt-0.5">
                                    <Icon icon-name="mdiArrowDownBoldOutline" size="18" color="#3a484a" />
                                </span><span class="text-[15px] font-semibold">Personalize</span>
                            </div>
                        </button>
                        <div :class="{
                            'child-menu': true,
                            'child-menu-expanded': showPersonalize,
                        }"
                            class="right-18 absolute top-10 flex w-[120px] flex-col space-y-2 rounded-md bg-white text-sm font-semibold shadow-md shadow-black/20">
                            <Link href="/change-password"
                                class="py-2 text-center hover:rounded-md hover:bg-ultra-light-gray">
                            Password</Link>
                            <Link href="/profile" class="py-2 text-center hover:rounded-md hover:bg-ultra-light-gray">
                            Profile</Link>
                        </div>
                    </div>
                    <span class="cursor-pointer rounded-full p-1.5 hover:bg-ultra-light-gray" @click.stop="openSignOut">
                        <Icon icon-name="mdiLogout" size="24" color="#3a484a" />
                    </span>
                </div>
            </header>
            <slot />
            <UserLock v-if="showUserLock" :show="showUserLock" @close="handleLock" />
            <SignOut v-if="showSignOut" :show="showSignOut" @close="handleClose" />
        </main>
        <footer class="right-0 flex justify-end px-2 py-2 text-sm text-gray-700">
            {{ allSettings?.copyRightText }}
        </footer>
    </div>
</template>

<script lang="ts" setup>
import { computed, onMounted, onUnmounted, ref } from "vue";
import { Link, usePage } from '@inertiajs/vue3';
import { PageProps } from "@inertiajs/vue3";
import Icon from '../Components/helper/Icon.vue';
import fallBackProfileImg from '../../../public/images/profile.png';
import SignOut from "../Components/common/SignOut.vue";
import UserLock from "../Components/common/UserLock.vue";

const userInfo = usePage<PageProps>().props.auth.user;
const menu = usePage<PageProps>().props.menu;
const allSettings = usePage<PageProps>().props.appSettings;
const notifications = usePage<PageProps>().props.notifications;
const expandedIndex = ref<number | null>(null);
const hideSidebar = ref(false);
const showSignOut = ref(false);
const showUserLock = ref(false);
const showNotification = ref(false);
const showPersonalize = ref(false);
const fullScreenElement = ref<any>(null);
const isFullScreen = ref(false);

const closePopUps = () => {
    showNotification.value = false;
    showPersonalize.value = false;
};

const profileImg = computed(() => {
    if (userInfo?.imagePath == null) {
        return fallBackProfileImg;
    } else {
        return window.location.origin + '/images/' + userInfo?.imagePath;
    }
});

const openUserLock = () => {
    showUserLock.value = !showUserLock.value;
};

const handleLock = (confirmed: boolean) => {
    showUserLock.value = confirmed;
};

const openSignOut = () => {
    showSignOut.value = !showSignOut.value;
};

const handleClose = (confirmed: boolean) => {
    showSignOut.value = confirmed;
};

const sidebarToggle = () => {
    hideSidebar.value = !hideSidebar.value;
};

//toggle child menu
const toggleItem = (index: number) => {
    expandedIndex.value = expandedIndex.value === index ? null : index;
};

//toggle full screen
const toggleFullScreen = () => {
    if (!isFullScreen.value) {
        fullScreenElement.value.requestFullscreen();
    } else {
        document.exitFullscreen();
    }
};

//full screen status update
const handleFullscreenChange = () => {
    isFullScreen.value = !!document.fullscreenElement;
};

//Mount life cycle hook
onMounted(() => {
    document.addEventListener("fullscreenchange", handleFullscreenChange);
});

//Un-Mount life cycle hook
onUnmounted(() => {
    document.removeEventListener("fullscreenchange", handleFullscreenChange);
});
</script>

<style scoped>
.sidebar {
    transition: transform 0.2s ease-in-out;
}

.sidebar-hidden {
    transform: translateX(-100%);
}

.overlay {
    transition: opacity 0.2s ease-in-out;
}

.overlay-hidden {
    opacity: 0;
    pointer-events: none;
}

.child-menu-notification {
    transition: max-height 0.3s ease-in-out;
    max-height: 0;
}

.child-menu-expanded-notification {
    max-height: 300px;
}

.child-menu {
    overflow: hidden;
    transition: max-height 0.3s ease-in-out;
    max-height: 0;
}

.child-menu-expanded {
    max-height: 100px;
}

.full-screen {
    height: 100vh;
    overflow: auto;
    background-color: white;
}
</style>