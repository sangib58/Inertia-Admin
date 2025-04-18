<template>
    <div class="px-4 py-6">
        <!--General Settings Form-->
        <div @click.stop="toggleGeneralForm"
            class="flex cursor-pointer items-center justify-between rounded-md border border-gray-300 py-3 hover:bg-light-gray">
            <span class="pl-2 text-base font-semibold">General Settings</span>
            <span class="pr-2">
                <Icon icon-name="mdiArrowRight" size="20" color="#3a484a" v-if="isGeneralSettingsVisible" />
                <Icon icon-name="mdiArrowDown" size="20" color="#3a484a" v-else />
            </span>
        </div>
        <div :class="{
            'child-collapse': true,
            'child-expanded': !isGeneralSettingsVisible,
            'px-4 py-4': !isGeneralSettingsVisible,
        }">
            <form @submit.prevent="saveGeneralSettings" class="space-y-4" :class="{ hidden: isGeneralSettingsVisible }">
                <div class="grid grid-cols-1 md:grid-cols-3 md:gap-x-4 md:gap-y-4">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Site
                            Title</label>
                        <input type="text" v-model="generalSettingForm.siteTitle" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="generalSettingForm.errors.siteTitle" class="mt-2 text-sm text-red-500">
                            {{ generalSettingForm.errors.siteTitle }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Welcome
                            Message</label>
                        <input type="text" v-model="generalSettingForm.welComeMessage" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="generalSettingForm.errors.welComeMessage" class="mt-2 text-sm text-red-500">
                            {{ generalSettingForm.errors.welComeMessage }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Copyright
                            Text</label>
                        <input type="text" v-model="generalSettingForm.copyRightText" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="generalSettingForm.errors.copyRightText" class="mt-2 text-sm text-red-500">
                            {{ generalSettingForm.errors.copyRightText }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Version</label>
                        <input type="number" v-model="generalSettingForm.version" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="generalSettingForm.errors.version" class="mt-2 text-sm text-red-500">
                            {{ generalSettingForm.errors.version }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Allow Welcome Email</label>
                        <input type="checkbox" v-model="generalSettingForm.allowWelcomeEmail" class="mt-4" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Allow Faq</label>
                        <input type="checkbox" v-model="generalSettingForm.allowFaq" class="mt-4" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 md:gap-x-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Site Logo</label>
                        <input type="file" accept="image/*" @change="onLogoImageChange"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="generalSettingForm.errors.logoImage" class="mt-2 text-sm text-red-500">
                            {{ generalSettingForm.errors.logoImage }}
                        </p>
                    </div>
                    <div class="flex items-center justify-center">
                        <img :src="previewLogo" class="size-16 object-contain" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Site Favicon</label>
                        <input type="file" accept="image/*" @change="onFaviconImageChange"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="generalSettingForm.errors.faviconImage" class="mt-2 text-sm text-red-500">
                            {{ generalSettingForm.errors.faviconImage }}
                        </p>
                    </div>
                    <div class="flex items-center justify-center">
                        <img :src="previewFavicon" class="size-16 object-contain" />
                    </div>
                </div>
                <div>
                    <button :disabled="generalSettingForm.processing" type="submit"
                        class="mt-4 w-20 cursor-pointer rounded-md bg-dark-gray py-2 text-sm font-bold text-white disabled:bg-gray-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
        <!--Email Settings Form-->
        <div @click.stop="toggleEmailForm"
            class="mt-2 flex cursor-pointer items-center justify-between rounded-md border border-gray-300 py-3 hover:bg-light-gray">
            <span class="pl-2 text-base font-semibold">Email Settings</span>
            <span class="pr-2">
                <Icon icon-name="mdiArrowRight" size="20" color="#3a484a" v-if="isEmailSettingsVisible" />
                <Icon icon-name="mdiArrowDown" size="20" color="#3a484a" v-else />
            </span>
        </div>
        <div :class="{
            'child-collapse': true,
            'child-expanded': !isEmailSettingsVisible,
            'px-4 py-4': !isEmailSettingsVisible,
        }">
            <form @submit.prevent="saveEmailSettings" :class="{ hidden: isEmailSettingsVisible }" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 md:gap-x-4 md:gap-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" v-model="emailSettingForm.defaultEmail" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="emailSettingForm.errors.defaultEmail" class="mt-2 text-sm text-red-500">
                            {{ emailSettingForm.errors.defaultEmail }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" v-model="emailSettingForm.password" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="emailSettingForm.errors.password" class="mt-2 text-sm text-red-500">
                            {{ emailSettingForm.errors.password }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Port</label>
                        <input type="text" v-model="emailSettingForm.port" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="emailSettingForm.errors.port" class="mt-2 text-sm text-red-500">
                            {{ emailSettingForm.errors.port }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Host(SMTP)</label>
                        <input type="text" v-model="emailSettingForm.host" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="emailSettingForm.errors.host" class="mt-2 text-sm text-red-500">
                            {{ emailSettingForm.errors.host }}
                        </p>
                    </div>
                </div>
                <div>
                    <button type="submit" :disabled="emailSettingForm.processing"
                        class="mt-4 w-20 cursor-pointer rounded-md bg-dark-gray py-2 text-sm font-bold text-white disabled:bg-gray-300">
                        Update
                    </button>
                </div>
            </form>
        </div>

        <!--Email Text Settings Form-->

        <div @click.stop="toggleEmailTextForm"
            class="mt-2 flex cursor-pointer items-center justify-between rounded-md border border-gray-300 py-3 hover:bg-light-gray">
            <span class="pl-2 text-base font-semibold">Email Text Settings</span>
            <span class="pr-2">
                <Icon icon-name="mdiArrowRight" size="20" color="#3a484a" v-if="isEmailTextSettingsVisible" />
                <Icon icon-name="mdiArrowDown" size="20" color="#3a484a" v-else />
            </span>
        </div>
        <div :class="{
            'child-collapse': true,
            'child-expanded': !isEmailTextSettingsVisible,
            'px-4 py-4': !isEmailTextSettingsVisible,
        }">
            <form @submit.prevent="saveEmailTextSettings" class="space-y-4"
                :class="{ hidden: isEmailTextSettingsVisible }">
                <div class="text-base font-semibold">Welcome Email</div>
                <div class="grid grid-cols-1 md:grid-cols-3 md:gap-x-4 md:gap-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" v-model="emailTextSettingForm.welcomeEmailSubject" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Header</label>
                        <input type="text" v-model="emailTextSettingForm.welcomeEmailHeader" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Body</label>
                        <textarea v-model="emailTextSettingForm.welcomeEmailBody" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                </div>
                <div class="text-base font-semibold">Forget Password Email</div>
                <div class="grid grid-cols-1 md:grid-cols-3 md:gap-x-4 md:gap-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" v-model="emailTextSettingForm.forgetPasswordEmailSubject" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Header</label>
                        <input type="text" v-model="emailTextSettingForm.forgetPasswordEmailHeader" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Body</label>
                        <textarea v-model="emailTextSettingForm.forgetPasswordEmailBody" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" :disabled="emailTextSettingForm.processing"
                        class="mt-4 w-20 cursor-pointer rounded-md bg-dark-gray py-2 text-sm font-bold text-white disabled:bg-gray-300">
                        Update
                    </button>
                </div>
            </form>
        </div>

        <!--Landing Page Form-->
        <div @click.stop="toggleLandingPage"
            class="mt-2 flex cursor-pointer items-center justify-between rounded-md border border-gray-300 py-3 hover:bg-light-gray">
            <span class="pl-2 text-base font-semibold">Landing Page</span>
            <span class="pr-2">
                <Icon icon-name="mdiArrowRight" size="20" color="#3a484a" v-if="isLandingTextSettingsVisible" />
                <Icon icon-name="mdiArrowDown" size="20" color="#3a484a" v-else />
            </span>
        </div>

        <div :class="{
            'child-collapse': true,
            'child-expanded': !isLandingTextSettingsVisible,
            'px-4 py-4': !isLandingTextSettingsVisible,
        }">
            <form @submit.prevent="saveLandingSettings" class="space-y-4"
                :class="{ hidden: isLandingTextSettingsVisible }">
                <div class="grid grid-cols-1 gap-y-4 md:grid-cols-2 md:gap-x-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Header Top</label>
                        <input type="text" v-model="landingTextSettingForm.homeHeader1" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Detail Top</label>
                        <textarea v-model="landingTextSettingForm.homeDetail1" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Image</label>
                        <input type="file" accept="image/*" @change="onHomeImageChange"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div class="flex items-center justify-center">
                        <img :src="homeImagePreviewSrc" class="size-64 object-contain" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Header Bottom</label>
                        <input type="text" v-model="landingTextSettingForm.homeHeader2" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Detail Bottom</label>
                        <textarea v-model="landingTextSettingForm.homeDetail2" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Box1 Header</label>
                        <input type="text" v-model="landingTextSettingForm.homeBox1Header" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Box1 Detail</label>
                        <textarea v-model="landingTextSettingForm.homeBox1Detail" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Box2 Header</label>
                        <input type="text" v-model="landingTextSettingForm.homeBox2Header" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Box2 Detail</label>
                        <textarea v-model="landingTextSettingForm.homeBox2Detail" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Box3 Header</label>
                        <input type="text" v-model="landingTextSettingForm.homeBox3Header" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Box3 Detail</label>
                        <textarea v-model="landingTextSettingForm.homeBox3Detail" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Box4 Header</label>
                        <input type="text" v-model="landingTextSettingForm.homeBox4Header" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Home Box4 Detail</label>
                        <textarea v-model="landingTextSettingForm.homeBox4Detail" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature1 Header</label>
                        <input type="text" v-model="landingTextSettingForm.feature1Header" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature1 Detail</label>
                        <textarea v-model="landingTextSettingForm.feature1Detail" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature1 Picture</label>
                        <input type="file" accept="image/*" @change="onFeature1ImageChange"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div class="flex items-center justify-center">
                        <img :src="feature1PreviewSrc" class="size-64 object-contain" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature2 Header</label>
                        <input type="text" v-model="landingTextSettingForm.feature2Header" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature2 Detail</label>
                        <textarea v-model="landingTextSettingForm.feature2Detail" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature2 Picture</label>
                        <input type="file" accept="image/*" @change="onFeature2ImageChange"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div class="flex items-center justify-center">
                        <img :src="feature2PreviewSrc" class="size-64 object-contain" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature3 Header</label>
                        <input type="text" v-model="landingTextSettingForm.feature3Header" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature3 Detail</label>
                        <textarea v-model="landingTextSettingForm.feature3Detail" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature3 Picture</label>
                        <input type="file" accept="image/*" @change="onFeature3ImageChange"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div class="flex items-center justify-center">
                        <img :src="feature3PreviewSrc" class="size-64 object-contain" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature4 Header</label>
                        <input type="text" v-model="landingTextSettingForm.feature4Header" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature4 Detail</label>
                        <textarea v-model="landingTextSettingForm.feature4Detail" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feature4 Picture</label>
                        <input type="file" accept="image/*" @change="onFeature4ImageChange"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div class="flex items-center justify-center">
                        <img :src="feature4PreviewSrc" class="size-64 object-contain" />
                    </div>
                </div>
                <div class="grid grid-cols-1">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Registration Text</label>
                        <textarea v-model="landingTextSettingForm.registrationText" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-y-4 md:grid-cols-3 md:gap-x-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contact Us Text</label>
                        <textarea v-model="landingTextSettingForm.contactUsText" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contact Us Email</label>
                        <input type="text" v-model="landingTextSettingForm.contactUsEmail" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contact Us Telephone</label>
                        <input type="text" v-model="landingTextSettingForm.contactUsTelephone" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                </div>
                <div class="grid grid-cols-1">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Landing Footer Text</label>
                        <textarea v-model="landingTextSettingForm.footerText" autocomplete="off" rows="4"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"></textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-y-4 md:grid-cols-4 md:gap-x-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Footer Facebook</label>
                        <input type="text" v-model="landingTextSettingForm.footerFacebook" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Footer Instagram</label>
                        <input type="text" v-model="landingTextSettingForm.footerInstagram" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Footer LinkedIn</label>
                        <input type="text" v-model="landingTextSettingForm.footerLinkedin" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Footer Twitter</label>
                        <input type="text" v-model="landingTextSettingForm.footerTwitter" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    </div>
                </div>
                <div>
                    <button type="submit" :disabled="landingTextSettingForm.processing"
                        class="mt-4 w-20 cursor-pointer rounded-md bg-dark-gray py-2 text-sm font-bold text-white disabled:bg-gray-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { useToast } from "vue-toastification";
import Icon from "../Components/helper/Icon.vue";
import Root from "../Layouts/root.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
defineOptions({ layout: Root })

interface Props {
    settings: {
        [key: string]: any;
    }
}
const props = defineProps<Props>()
const toast = useToast();
const previewLogo = ref("");
const previewFavicon = ref("");
const homeImagePreviewSrc = ref("");
const feature1PreviewSrc = ref("");
const feature2PreviewSrc = ref("");
const feature3PreviewSrc = ref("");
const feature4PreviewSrc = ref("");
const isGeneralSettingsVisible = ref(true);
const isEmailSettingsVisible = ref(true);
const isEmailTextSettingsVisible = ref(true);
const isLandingTextSettingsVisible = ref(true);
const generalSettingForm = useForm({
    siteSettingsId: "",
    siteTitle: "",
    welComeMessage: "",
    copyRightText: "",
    logoImage: null,
    faviconImage: null,
    logoPath: "",
    faviconPath: "",
    allowWelcomeEmail: false,
    allowFaq: false,
    version: "",
});
const emailSettingForm = useForm({
    siteSettingsId: "",
    defaultEmail: "",
    password: "",
    host: "",
    port: "",
});
const emailTextSettingForm = useForm({
    siteSettingsId: "",
    forgetPasswordEmailSubject: "",
    forgetPasswordEmailHeader: "",
    forgetPasswordEmailBody: "",
    welcomeEmailSubject: "",
    welcomeEmailHeader: "",
    welcomeEmailBody: "",
});
const landingTextSettingForm = useForm({
    siteSettingsId: "",
    homeHeader1: "",
    homeDetail1: "",
    homePictureSrc: null,
    homePicture: "",
    homeHeader2: "",
    homeDetail2: "",
    homeBox1Header: "",
    homeBox1Detail: "",
    homeBox2Header: "",
    homeBox2Detail: "",
    homeBox3Header: "",
    homeBox3Detail: "",
    homeBox4Header: "",
    homeBox4Detail: "",
    feature1Header: "",
    feature1Detail: "",
    feature1PictureSrc: null,
    feature1Picture: "",
    feature2Header: "",
    feature2Detail: "",
    feature2PictureSrc: null,
    feature2Picture: "",
    feature3Header: "",
    feature3Detail: "",
    feature3PictureSrc: null,
    feature3Picture: "",
    feature4Header: "",
    feature4Detail: "",
    feature4PictureSrc: null,
    feature4Picture: "",
    registrationText: "",
    contactUsText: "",
    contactUsTelephone: "",
    contactUsEmail: "",
    footerText: "",
    footerFacebook: "",
    footerTwitter: "",
    footerLinkedin: "",
    footerInstagram: "",
});

//toggle general settings visibility
const toggleGeneralForm = () => {
    isGeneralSettingsVisible.value = !isGeneralSettingsVisible.value;
};

//toggle email settings visibility
const toggleEmailForm = () => {
    isEmailSettingsVisible.value = !isEmailSettingsVisible.value;
};

//toggle email text settings visibility
const toggleEmailTextForm = () => {
    isEmailTextSettingsVisible.value = !isEmailTextSettingsVisible.value;
};

//toggle landing settings visibility
const toggleLandingPage = () => {
    isLandingTextSettingsVisible.value = !isLandingTextSettingsVisible.value;
};

//get all settings
if (Object.keys(props.settings).length > 0) {
    generalSettingForm.siteSettingsId = props.settings.siteSettingsId;
    generalSettingForm.siteTitle = props.settings.siteTitle;
    generalSettingForm.welComeMessage = props.settings.welComeMessage;
    generalSettingForm.copyRightText = props.settings.copyRightText;
    generalSettingForm.version = props.settings.version;
    generalSettingForm.allowWelcomeEmail = props.settings.allowWelcomeEmail == 1 ? true : false;
    generalSettingForm.allowFaq = props.settings.allowFaq == 1 ? true : false;
    generalSettingForm.logoPath = props.settings.logoPath;
    previewLogo.value = window.location.origin + '/images/' + props.settings.logoPath
    generalSettingForm.faviconPath = props.settings.faviconPath;
    previewFavicon.value = window.location.origin + '/images/' + props.settings.faviconPath

    emailSettingForm.siteSettingsId = props.settings.siteSettingsId;
    emailSettingForm.defaultEmail = props.settings.defaultEmail;
    emailSettingForm.password = props.settings.password;
    emailSettingForm.port = props.settings.port;
    emailSettingForm.host = props.settings.host;

    emailTextSettingForm.siteSettingsId = props.settings.siteSettingsId;
    emailTextSettingForm.forgetPasswordEmailSubject =
        props.settings.forgetPasswordEmailSubject;
    emailTextSettingForm.forgetPasswordEmailHeader =
        props.settings.forgetPasswordEmailHeader;
    emailTextSettingForm.forgetPasswordEmailBody =
        props.settings.forgetPasswordEmailBody;
    emailTextSettingForm.welcomeEmailSubject =
        props.settings.welcomeEmailSubject;
    emailTextSettingForm.welcomeEmailHeader =
        props.settings.welcomeEmailHeader;
    emailTextSettingForm.welcomeEmailBody = props.settings.welcomeEmailBody;

    landingTextSettingForm.siteSettingsId = props.settings.siteSettingsId;
    landingTextSettingForm.homeHeader1 = props.settings.homeHeader1;
    landingTextSettingForm.homeDetail1 = props.settings.homeDetail1;
    landingTextSettingForm.homePicture = props.settings.homePicture;
    homeImagePreviewSrc.value = window.location.origin + '/images/' + landingTextSettingForm.homePicture;
    landingTextSettingForm.homeHeader2 = props.settings.homeHeader2;
    landingTextSettingForm.homeDetail2 = props.settings.homeDetail2;
    landingTextSettingForm.homeBox1Header = props.settings.homeBox1Header;
    landingTextSettingForm.homeBox1Detail = props.settings.homeBox1Detail;
    landingTextSettingForm.homeBox2Header = props.settings.homeBox2Header;
    landingTextSettingForm.homeBox2Detail = props.settings.homeBox2Detail;
    landingTextSettingForm.homeBox3Header = props.settings.homeBox3Header;
    landingTextSettingForm.homeBox3Detail = props.settings.homeBox3Detail;
    landingTextSettingForm.homeBox4Header = props.settings.homeBox4Header;
    landingTextSettingForm.homeBox4Detail = props.settings.homeBox4Detail;
    landingTextSettingForm.feature1Header = props.settings.feature1Header;
    landingTextSettingForm.feature1Detail = props.settings.feature1Detail;
    feature1PreviewSrc.value = window.location.origin + '/images/' + props.settings.feature1Picture;
    landingTextSettingForm.feature1Picture = props.settings.feature1Picture;
    landingTextSettingForm.feature2Header = props.settings.feature2Header;
    landingTextSettingForm.feature2Detail = props.settings.feature2Detail;
    feature2PreviewSrc.value = window.location.origin + '/images/' + props.settings.feature2Picture;
    landingTextSettingForm.feature2Picture = props.settings.feature2Picture;
    landingTextSettingForm.feature3Header = props.settings.feature3Header;
    landingTextSettingForm.feature3Detail = props.settings.feature3Detail;
    feature3PreviewSrc.value = window.location.origin + '/images/' + props.settings.feature3Picture;
    landingTextSettingForm.feature3Picture = props.settings.feature3Picture;
    landingTextSettingForm.feature4Header = props.settings.feature4Header;
    landingTextSettingForm.feature4Detail = props.settings.feature4Detail;
    feature4PreviewSrc.value = window.location.origin + '/images/' + props.settings.feature4Picture;
    landingTextSettingForm.feature4Picture = props.settings.feature4Picture;
    landingTextSettingForm.registrationText = props.settings.registrationText;
    landingTextSettingForm.contactUsText = props.settings.contactUsText;
    landingTextSettingForm.contactUsEmail = props.settings.contactUsEmail;
    landingTextSettingForm.contactUsTelephone = props.settings.contactUsTelephone;
    landingTextSettingForm.footerText = props.settings.footerText;
    landingTextSettingForm.footerFacebook = props.settings.footerFacebook;
    landingTextSettingForm.footerInstagram = props.settings.footerInstagram;
    landingTextSettingForm.footerLinkedin = props.settings.footerLinkedin;
    landingTextSettingForm.footerTwitter = props.settings.footerTwitter;
}

const onLogoImageChange = (event: any) => {
    generalSettingForm.logoImage = event.target.files[0];
}

const onFaviconImageChange = (event: any) => {
    generalSettingForm.faviconImage = event.target.files[0];
}

const onHomeImageChange = (event: any) => {
    landingTextSettingForm.homePictureSrc = event.target.files[0];
}

const onFeature1ImageChange = (event: any) => {
    landingTextSettingForm.feature1PictureSrc = event.target.files[0];
}

const onFeature2ImageChange = (event: any) => {
    landingTextSettingForm.feature2PictureSrc = event.target.files[0];
}

const onFeature3ImageChange = (event: any) => {
    landingTextSettingForm.feature3PictureSrc = event.target.files[0];
}

const onFeature4ImageChange = (event: any) => {
    landingTextSettingForm.feature4PictureSrc = event.target.files[0];
}

//update general settings
const saveGeneralSettings = () => {
    generalSettingForm.post("/update-generalSettings", {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            if (Object.keys(generalSettingForm.errors).length == 0) {
                previewLogo.value = window.location.origin + '/images/' + usePage().props.settings.logoPath;
                previewFavicon.value = window.location.origin + '/images/' + usePage().props.settings.faviconPath;
                toast.success("General settings updated successfully.");
            }
        },
    });
};

//update email settings
const saveEmailSettings = () => {
    emailSettingForm.put("/update-emailSettings", {
        preserveScroll: true,
        onSuccess: () => {
            if (Object.keys(emailSettingForm.errors).length == 0) {
                toast.success("Email settings updated successfully.");
            }
        },
    });
};

//update email text settings
const saveEmailTextSettings = () => {
    emailTextSettingForm.put("/update-emailTextSettings", {
        preserveScroll: true,
        onSuccess: () => {
            if (Object.keys(emailTextSettingForm.errors).length == 0) {
                toast.success("Email text settings updated successfully.");
            }
        },
    });
};

//update landing text settings
const saveLandingSettings = () => {
    landingTextSettingForm.post("/update-landingSettings", {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            if (Object.keys(landingTextSettingForm.errors).length == 0) {
                homeImagePreviewSrc.value = window.location.origin + '/images/' + usePage().props.settings.homePicture;
                feature1PreviewSrc.value = window.location.origin + '/images/' + usePage().props.settings.feature1Picture;
                feature2PreviewSrc.value = window.location.origin + '/images/' + usePage().props.settings.feature2Picture;
                feature3PreviewSrc.value = window.location.origin + '/images/' + usePage().props.settings.feature3Picture;
                feature4PreviewSrc.value = window.location.origin + '/images/' + usePage().props.settings.feature4Picture;
                toast.success("Landing settings updated successfully.");
            }
        },
    });
};
</script>

<style scoped>
.child-collapse {
    transition:
        max-height 0.4s ease-out,
        opacity 0.4s ease-out;
    max-height: 0;
    opacity: 0;
}

.child-expanded {
    max-height: 500px;
    opacity: 1;
}
</style>