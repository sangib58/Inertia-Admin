<template>
    <Teleport to="body" v-if="showProps.show">
        <div class="fixed inset-0 z-50 flex min-h-dvh items-center justify-center bg-black/50">
            <div
                class="flex flex-col justify-center items-center min-w-64 space-y-6 rounded-md bg-dark-black px-4 py-2">
                <div>
                    <img :src="profileImg" class="size-12 rounded-full object-cover" />
                </div>
                <div>
                    <input type="password" placeholder="Type password" v-model="lockForm.password"
                        class="bg-dark-black py-2 pl-1 text-white outline-1 outline-gray-300 placeholder:pl-1 placeholder:text-sm" />
                    <p v-if="lockForm.errors.password" class="mt-2 text-sm text-red-500">
                        {{ lockForm.errors.password }}
                    </p>
                </div>
                <div class="text-sm font-bold text-white">
                    <button @click.stop="changePassword" class="cursor-pointer">
                        <Icon icon-name="mdiKey" size="32" color="#ffffff" />
                    </button>
                </div>
            </div>
        </div>
    </Teleport>
</template>

<script lang="ts" setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { PageProps } from "@inertiajs/vue3";
import fallBackProfileImg from '~/images/profile.png';
import Icon from "../../Components/helper/Icon.vue";
import { computed } from "vue";

interface Props {
    show: boolean
}
const userInfo = usePage<PageProps>().props.auth.user;
const showProps = defineProps<Props>();
const emit = defineEmits<{
    (e: "close", value: boolean): void
}>();
const lockForm = useForm({
    password: null,
});

const profileImg = computed(() => {
    if (userInfo?.imagePath == null) {
        return fallBackProfileImg;
    } else {
        return window.location.origin + '/images/' + userInfo?.imagePath;
    }
});

const changePassword = () => {
    lockForm.post('/unlock', {
        onSuccess: () => {
            emit('close', false);
        },
        onError: () => {
            if (lockForm.errors.password) {
                lockForm.setError('password', 'Incorrect Password!')
            }
        }
    })
};
</script>