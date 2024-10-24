<template>
    <p>{{ props.msg.content }}</p>
    <span @click="commentStore.isShowComment = true; show(props.msg.id)" class="text-right block mt-[10px] text-[14px] cursor-pointer hover:underline">15 comments</span>
</template>

<script setup>
import { useCommentStore } from '@/stores/commentStore';

const props = defineProps(['msg']);
const commentStore = useCommentStore();
const { show } = useCommentStore();
</script>