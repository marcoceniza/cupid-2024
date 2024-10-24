<template>
  <main>
    <div v-if="isAuthenticated" class="absolute bg-[rgba(0,0,0,0.8)] w-full h-full top-0 left-0 z-10">
      <section class="mx-auto text-center bg-[#ff8398] w-[450px] max-w-full min-h-[200px] flex justify-center items-center rounded-[4px] absolute left-0 right-0 top-[50%] translate-y-[-50%]">
        <form @submit.prevent="authenticate('register', formData)">
          <input type="text" v-model="formData.name" placeholder="Enter your codename..." class="rounded-[30px] py-0 px-[20px] border-[#c86e7e] border-solid border-[1px] h-[50px] leading-[50px] w-[300px] max-w-full">
          <input type="hidden" :value="email" />
        </form>
      </section>
    </div>

    <div class="container mx-auto px-4 mt-5">
      <div class="flex justify-between">
        <button @click="isShowInputMessage = true" class="bg-[#ff8398] w-[120px] relative leading-[40px] bold text-[#b7213b] rounded-[30px] pr-[20px] hover:bg-[#d65a6f]">ADD <PlusIcon class="size-6 text-[#b7213b] absolute top-[9px] right-[25px]" /></button>
        <input type="text" placeholder="Search..." class="rounded-[30px] py-0 px-[20px] border-[#c86e7e] border-solid border-[1px]">
      </div>
      <div class="flex flex-wrap justify-center mt-10 msg_wrap">
        <section v-if="isShowInputMessage">
          <span @click="isShowInputMessage = false" class="absolute top-[-20px] right-[-7px] text-center rounded-[30px] text-[23px] cursor-pointer hover:opacity-[0.5]">&times;</span>
          <textarea cols="30" @keydown.enter.prevent="store(formDataMessage)" v-model="formDataMessage.content" rows="10" placeholder="Enter message here..." class="w-[100%] p-2"></textarea>
          <PaperAirplaneIcon @click="store(formDataMessage)" class="size-5 text-[#b7213b] absolute bottom-[18px] right-[20px] cursor-pointer hover:opacity-[0.5]" />
        </section>
        <section v-for="msg in messageData" :key="msg.id">
          <MessageList :msg="msg" />
        </section>
      </div>

      <!-- modal -->
      <CommentList v-if="isShowComment" />
    </div>
  </main>
</template>

<script setup>
import { PlusIcon, PaperAirplaneIcon } from '@heroicons/vue/24/solid';
import { reactive, watch, computed } from 'vue';
import { useAuthStore } from '@/stores/authStore';
import { useMessageStore } from '@/stores/messageStore';
import { useCommentStore } from '@/stores/commentStore';
import CommentList from '../components/CommentList.vue';
import MessageList from '../components/MessageList.vue';
import { storeToRefs } from 'pinia';

const { authenticate } = useAuthStore();
const { store } = useMessageStore();
const { isShowComment } = storeToRefs(useCommentStore());
const { messageData, isShowInputMessage } = storeToRefs(useMessageStore());
const { token, user } = storeToRefs(useAuthStore());
const formData = reactive({
  name: '',
  email: '',
  password: '123',
  password_confirmation: '123'
});

const formDataMessage = reactive({
  content: ''
});

const isAuthenticated = computed(() => !token.value && !user.value );
const email = computed(() => formData.name + '@gmail.com');

watch(email, (newEmail) => {
  formData.email = newEmail
});
</script>
