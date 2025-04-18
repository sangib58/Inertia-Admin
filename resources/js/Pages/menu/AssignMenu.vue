<template>
    <Teleport to="body" v-if="show">
        <div @click="cancel" class="fixed inset-0 z-50 flex min-h-dvh items-center justify-center bg-black/50">
            <div class="flex min-w-[580px] flex-col space-y-10 rounded-md bg-gray-900 px-4 py-6" @click.stop>
                <ul class="space-y-1">
                    <!-- <li v-for="(item, index) in totalItems" :key="index">
                        <NuxtLink
                            class="parent flex items-center px-3 py-3.5 text-gray-300 hover:rounded-lg hover:bg-gray-950 hover:text-white"
                            :class="{
                                'cursor-pointer': item.children.length > 0,
                                'parent-active': index === expandedIndex,
                            }" @click.stop="toggleItem(index)">
                            <span class="ml-2 text-sm">{{ item.title }}</span>
                            <span class="ml-auto" v-if="item.children.length == 0"><input type="checkbox"
                                    v-model="item.isParentSelected" @click.stop="assignNewMenu(item)" /></span>
                            <span class="ml-auto" v-if="item.children.length > 0">
                                <Icon v-if="index === expandedIndex" icon-name="mdiArrowDown" size="18"
                                    color="#ffffff" />
                                <Icon v-else icon-name="mdiArrowRight" size="18" color="#ffffff" />
                            </span>
                        </NuxtLink>
                        <ul v-if="item.children.length > 0 && index === expandedIndex" class="space-y-3">
                            <li v-for="(child, cIndex) in item.children" :key="cIndex" class="ml-6 mt-1">
                                <NuxtLink class="child text-gray-300 before:mr-4">
                                    <span class="text-sm">{{ child.title }}</span>
                                    <span class="ml-auto"><input type="checkbox" v-model="child.isSelected"
                                            @click.stop="assignNewMenu(child)" /></span>
                                </NuxtLink>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </Teleport>
</template>

<script setup>
import { ref } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();
const expandedIndex = ref(null);
const totalItems = ref([]);
const props = defineProps({
    show: {
        type: Boolean,
        required: true,
    },
    id: {
        type: Number,
        required: true,
    },
    allMenu: {
        type: Array,
        required: true,
    },
});
const emit = defineEmits(["close"]);

//toggle child menu
const toggleItem = (index) => {
    expandedIndex.value = expandedIndex.value === index ? null : index;
};

//assign a menu to menu group
const assignNewMenu = (item) => {
    console.log(item);
    /* try {
        const obj = {
            menuId: item.id,
            menuGroupId: item.groupId,
            isSelected:
                item.isParentSelected == undefined
                    ? !item.isSelected
                    : !item.isParentSelected,
            addedBy: userInfo?.value.obj.userId,
        };
        const response = await $fetch.raw(
            config.public.apiUrl + "/api/Menu/MenuAssign",
            {
                method: "POST",
                body: obj,
                headers: {
                    Authorization: `Bearer ${userInfo?.value.token}`,
                },
            },
        );
        if (response.status == 200) {
            toast.success(response._data.responseMsg);
        } else if (response.status == 202) {
            toast.error(response._data.responseMsg);
        }
    } catch (error) {
        console.error(error);
        useSiteError(error?.response);
    } */
};

//calcel action
const cancel = () => {
    emit("close", false);
};
</script>