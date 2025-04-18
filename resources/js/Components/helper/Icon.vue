<template>
    <svg :width="sizeValue" :height="sizeValue" :fill="color" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path :d="mdiIcon" />
    </svg>
</template>

<script lang="ts" setup>
import { computed } from "vue";
import {
    mdiHome,
    mdiMenu,
    mdiAccount,
    mdiHistory,
    mdiHelpCircle,
    mdiContacts,
    mdiCog,
    mdiFacebook,
    mdiLinkedin,
    mdiTwitter,
    mdiGithub,
    mdiInstagram,
    mdiArrowRight,
    mdiArrowDown,
    mdiLogout,
    mdiBell,
    mdiLock,
    mdiFullscreen,
    mdiFullscreenExit,
    mdiKey,
    mdiArrowDownBoldOutline,
    mdiLogin,
    mdiFeatureSearch,
    mdiPlus,
    mdiPencil,
    mdiDelete,
    mdiShieldCrown,
    mdiAccountCheck,
    mdiAccountCancel,
} from "@mdi/js";
interface Props {
    iconName: string;
    color: string;
    size: number | string;
}
const props = defineProps<Props>();
const sizeValue = computed(() => props.size || 24);

const mdiIcon = computed(() => {
    if (props.iconName == "mdiHome") {
        return mdiHome;
    } else if (props.iconName == "mdiMenu") {
        return mdiMenu;
    } else if (props.iconName == "mdiAccount") {
        return mdiAccount;
    } else if (props.iconName == "mdiHistory") {
        return mdiHistory;
    } else if (props.iconName == "mdiHelpCircle") {
        return mdiHelpCircle;
    } else if (props.iconName == "mdiContacts") {
        return mdiContacts;
    } else if (props.iconName == "mdiCog") {
        return mdiCog;
    } else if (props.iconName == "mdiFacebook") {
        return mdiFacebook;
    } else if (props.iconName == "mdiLinkedin") {
        return mdiLinkedin;
    } else if (props.iconName == "mdiTwitter") {
        return mdiTwitter;
    } else if (props.iconName == "mdiGithub") {
        return mdiGithub;
    } else if (props.iconName == "mdiInstagram") {
        return mdiInstagram;
    } else if (props.iconName == "mdiArrowRight") {
        return mdiArrowRight;
    } else if (props.iconName == "mdiArrowDown") {
        return mdiArrowDown;
    } else if (props.iconName == "mdiLogout") {
        return mdiLogout;
    } else if (props.iconName == "mdiBell") {
        return mdiBell;
    } else if (props.iconName == "mdiLock") {
        return mdiLock;
    } else if (props.iconName == "mdiFullscreen") {
        return mdiFullscreen;
    } else if (props.iconName == "mdiFullscreenExit") {
        return mdiFullscreenExit;
    } else if (props.iconName == "mdiKey") {
        return mdiKey;
    } else if (props.iconName == "mdiArrowDownBoldOutline") {
        return mdiArrowDownBoldOutline;
    } else if (props.iconName == "mdiLogin") {
        return mdiLogin;
    } else if (props.iconName == "mdiFeatureSearch") {
        return mdiFeatureSearch;
    } else if (props.iconName == "mdiPlus") {
        return mdiPlus;
    } else if (props.iconName == "mdiPencil") {
        return mdiPencil;
    } else if (props.iconName == "mdiDelete") {
        return mdiDelete;
    } else if (props.iconName == "mdiShieldCrown") {
        return mdiShieldCrown;
    } else if (props.iconName == "mdiAccountCheck") {
        return mdiAccountCheck;
    } else if (props.iconName == "mdiAccountCancel") {
        return mdiAccountCancel;
    }
});
</script>