<template>
    <div class="fixed bg-[rgba(0,0,0,0.5)] top-0 left-0 w-[100%] h-[100%]">
        <div class="w-[500px] bg-[#fff] p-[12px] mx-auto rounded-[6px] mt-[30px] relative">
          <div class="h-[300px] overflow-y-scroll">
            <span @click="isShowComment = false" class="absolute top-[-15px] right-[-12px] text-center rounded-[30px] text-[23px] cursor-pointer hover:opacity-[0.5] text-[#fff] bg-[#dd6e81] w-[25px] h-[25px] leading-[20px]">&times;</span>
            <!-- <div v-if="commentStore.commentLoading" class="animate-pulse">
              <div class="bg-[#ffe3e8] p-[12px] rounded-[4px] mb-[25px]"></div>
            </div>
            <p v-else class="bg-[#ffe3e8] p-[12px] rounded-[4px] mb-[25px]">{{ commentStore.msgComment }}</p>
            <hr class="bg-[#d97183] mb-5">
            <p v-if="commentStore.commentLoading" class="text-center text-[#7d7d7d] mt-5 text-[13px]">Loading...</p>
            <p v-else-if="commentStore.msgCommentList.length === 0" class="text-center text-[#7d7d7d] mt-5 text-[13px]">No comments available.</p> -->
            <ul class="mb-5">
              <li class="relative text-[15px] text-[#797979]"><UserCircleIcon class="size-10 text-[#b7213b] absolute top-0 left-0 cursor-pointer hover:opacity-[0.5]" /> <p class="bg-[#eee] ml-[40px] mb-[5px] rounded-[30px] block leading-[16px] p-[12px]">test comment</p></li>
            </ul>
          </div>
          <div class="relative">
            <input type="text" v-model="formDataComment.content" class="w-[100%] border-solid border-[#f09caa] border-[1px] rounded-[4px] bg-[#ffe6eb] py-[6px] pl-[12px] pr-[30px]" placeholder="Write a comment...">
            <PaperAirplaneIcon @click="store(formDataComment)" class="size-5 text-[#b7213b] absolute top-[10px] right-[6px] cursor-pointer hover:opacity-[0.5]" />
          </div>
        </div>
      </div>
</template>

<script setup>
import { PaperAirplaneIcon, UserCircleIcon } from '@heroicons/vue/24/solid';
import { useCommentStore } from '@/stores/commentStore';
import { useMessageStore } from '@/stores/messageStore';
import { storeToRefs } from 'pinia';
import { reactive } from 'vue';

const { store } = useCommentStore();
const { isShowComment } = storeToRefs(useCommentStore());
const { messageData } = storeToRefs(useMessageStore());
const formDataComment = reactive({
  content: ''
});
</script>