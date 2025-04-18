<template>
    <Teleport to="body" v-if="show">
        <div class="fixed inset-0 z-50 flex min-h-dvh items-center justify-center bg-black/50">
            <div class="flex min-w-64 flex-col space-y-2 rounded-md bg-white px-4 py-3">
                <div class="text-lg font-semibold">
                    Are you sure to delete this item?
                </div>
                <div class="flex justify-end space-x-2 text-sm font-bold text-white">
                    <button @click.stop="cancel" class="test base cursor-pointer text-blue-500 hover:text-blue-600">
                        Cancel
                    </button>
                    <button @click.stop="remove" class="cursor-pointer text-gray-700">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </Teleport>
</template>

<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

interface Props {
    show: boolean;
    id: number;
}
const toast = useToast();
const props = defineProps < Props > ();
const emit = defineEmits < {
    (e: "close", value: boolean): void
}> ();
const roleForm = useForm({
    userRoleId: props.id,
});

//calcel action
const cancel = () => {
    emit("close", false);
};

//delete action
const remove = () => {
    roleForm.delete('delete-role', {
        preserveState: true,
        onSuccess: () => {
            toast.success("Role deleted successfully.");
            emit("close", false);
        }
    });
};
</script>