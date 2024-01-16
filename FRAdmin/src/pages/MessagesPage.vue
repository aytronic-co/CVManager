<template>
  <q-page>
    <div class="row">
      <div class="col-2 clmn">فرستنده</div>
      <div class="col-3 clmn">متن پیام</div>
      <div class="col-1 clmn">ایمیل</div>
      <div class="col-1 clmn">موبایل</div>
      <div class="col-1 clmn">نمایش</div>
      <div class="col-4 clmn">جواب</div>
    </div>
    <div v-if="Messages">
      <div
        class="row"
        v-for="(message, index) in Messages"
        :key="'AdminMess' + index + 1"
      >
        <div class="col-2 clmn">
          {{ message.full_name }}
        </div>
        <div class="col-3 clmn">
          {{ message.text }}
        </div>
        <div class="col-1 clmn">
          {{ message.email }}
        </div>
        <div class="col-1 clmn">
          {{ message.contact_number }}
        </div>
        <div class="col-1 clmn">
          <q-input v-model="message.status" label="status"></q-input>
        </div>
        <div class="col-4 clmn">
          <span>
            <q-input v-model="message.answerText" label="answer"></q-input>
          </span>
          <span>
            <q-btn icon="done" @click="upload(message.id, index)" />
          </span>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { onMounted, ref } from "vue";
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { reactive, toRefs } from "vue";
import { useRouter, useRoute } from "vue-router";

export default {
  name: "MessagePage",
  setup() {
    const Messages = ref([]);
    const props = reactive({
      full_name: null,
      contact_number: null,
      ElementInternals: null,
      text: null,
      status: false,
      answerText: null,
      gender: null,
    });
    function fetchMessages() {
      api.get("api/admin/message").then((r) => {
        if (r.data.status) Messages.value = r.data.messages;
      });
      console.log(Messages.value);
    }
    onMounted(() => {
      fetchMessages();
    });
    function upload(id, index) {
      console.log(Messages.value[index].answerText);
      api
        .put("api/admin/message/" + id, {
          answerText: Messages.value[index].answerText,
          status: Messages.value[index].status,
        })
        .then((r) => {
          if (r.data.status) {
            $q.notify({
              message: "با موفقیت ثبت شد",
              color: "positive",
              position: "top",
              icon: "ion-ios-happy",
            });
          } else {
            $q.notify({
              message: "خطایی پیش آمده، لطفا دوباره تلاش کنید",
              color: "negative",
              position: "top",
              icon: "ion-ios-sad",
            });
          }
        });
    }
    return {
      ...toRefs(props),
      fetchMessages,
      Messages,
      upload,
    };
  },
};
</script>
<style>
.clmn {
  border-style: solid;
}
</style>
