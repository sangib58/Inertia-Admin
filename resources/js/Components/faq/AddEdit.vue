<template>
    <Teleport to="body" v-if="show">
        <div class="fixed inset-0 z-50 flex min-h-dvh items-center justify-center bg-black/50">
            <div class="flex min-w-[680px] flex-col space-y-10 rounded-md bg-white px-4 py-6">
                <div v-if="isEdit == true" class="text-xl font-semibold">Edit Faq</div>
                <div v-else class="text-xl font-semibold">Add Faq</div>
                <form @submit.prevent="saveFaq" class="space-y-8">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Title</label>
                        <input type="text" v-model="faqForm.title" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="faqForm.errors.title" class="mt-2 text-sm text-red-500">
                            {{ faqForm.errors.title }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Description</label>
                        <textarea v-model="faqForm.description"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"
                            rows="6"></textarea>
                        <p v-if="faqForm.errors.description" class="mt-2 text-sm text-red-500">
                            {{ faqForm.errors.description }}
                        </p>
                    </div>
                    <div class="flex justify-end space-x-4 text-sm font-bold text-white">
                        <button @click.stop="cancel" class="cursor-pointer text-blue-500 hover:text-blue-600">
                            Cancel
                        </button>
                        <button class="text-gray-700 hover:text-gray-800 disabled:text-gray-300 cursor-pointer"
                            type="submit" :disabled="faqForm.processing">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Teleport>
</template>

<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3";
import { computed } from "vue";
import { useToast } from "vue-toastification";

interface Props {
    show: boolean;
    obj: Partial<Faq>;
}
interface Faq {
    faqId: number;
    title: string;
    description: string;
}
interface FaqForm extends Faq {
    [key: string]: any;
    errors?: Record<string, string>;
    processing?: boolean;
}
const toast = useToast();
const props = defineProps<Props>();
const emit = defineEmits<{
    (e: "close", value: boolean): void
}>();
const faqForm = useForm<FaqForm>({
    faqId: 0,
    title: "",
    description: "",
});

//check add or edit
const isEdit = computed(() => {
    if (props.obj?.faqId == undefined) {
        return false;
    }
    Object.assign(faqForm, {
        faqId: props.obj.faqId ?? 0,
        title: props.obj.title ?? "",
        description: props.obj.description ?? "",
    })
    return true;
});

//calcel action
const cancel = (): void => {
    emit("close", false);
};

//faq add/edit
const saveFaq = () => {
    const requestConfig = {
        preserveState: true,
        onSuccess: () => {
            toast.success(`FAQ ${isEdit.value ? "updated" : "added"} successfully.`);
            emit("close", false);
            faqForm.reset();
        },
    };
    isEdit.value
        ? faqForm.put('/update-faq', requestConfig)
        : faqForm.post('/add-faq', requestConfig)
};
</script>