<template>
  <q-page padding>
    <!-- content -->
    <h4 class="text-center">فرم ورود</h4>
    <div class="row justify-center">
      <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
        <q-input
          placeholder="enter your phone number"
          label="mobile"
          rounded
          outlined
          class="q-mt-lg"
          ref="usernameRef"
          type="text"
          v-model="username"
          autocomplete="off"
          :rules="[
            (val) => !!val || 'Field is required',
            (val) => val.length > 9,
          ]"
        />

        <q-btn
          outline
          class="full-width q-mt-md q-py-sm"
          color="light-blue-6"
          label="ورود"
          icon="security"
          rounded
          outlined
          @click="login"
        />
      </div>
    </div>
  </q-page>
</template>

<script>
import { useQuasar } from "quasar";
import { api } from "src/boot/axios";
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useAppDataStore } from "src/stores/appData";
import { storeToRefs } from "pinia";

export default {
  name: "LoginPage",
  setup() {
    const appData = useAppDataStore();
    const { userMobile } = storeToRefs(appData);
    const q = useQuasar();
    const usernameRef = ref(null);
    const username = ref();
    const router = useRouter();
    function login() {
      usernameRef.value.validate();
      if (usernameRef.value.hasError) {
        q.notify({
          color: "negative",
          position: "top",
          message: "Please chech your inputs",
        });
      } else {
        appData.userMobile = username.value;
        api
          .post("api/admin/send-vc", {
            mobile: username.value,
          })
          .then((r) => {
            console.log(r.data);
            if (r.data.status) {
              router.push("/verify");
            } else {
              alert("مشکلی پیش آمده");
            }
          });
      }
    }
    return {
      login,
      usernameRef,
      username,
    };
  },
};
</script>
