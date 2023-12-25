<template>
  <q-page padding>
    <h4 class="text-center">فرم تایید</h4>
    <!-- content -->
    <div class="row justify-center">
      <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
        <q-input
          placeholder="enter password"
          label="password"
          rounded
          outlined
          class="q-mt-lg"
          ref="passwordRef"
          type="password"
          v-model="password"
          autocomplete="off"
          :rules="[
            (val) => !!val || 'Field is required',
            //(val) => val.length > 3 || 'please use more than 3 charachters',
          ]"
        />

        <q-btn
          outline
          class="full-width q-mt-md q-py-sm"
          @click="verify"
          color="light-blue-6"
          label="شروع کن"
          rounded
          outlined
        />
      </div>
    </div>
  </q-page>
</template>

<script>
import { onMounted, ref } from "vue";
import { useQuasar } from "quasar";
import { api } from "src/boot/axios";
import { useRoute, useRouter } from "vue-router";
import { useAppDataStore } from "src/stores/appData";

export default {
  name: "ConfirmPage",
  setup() {
    const appData = useAppDataStore();
    const route = useRoute();
    const q = useQuasar();
    const username = ref(null);
    const password = ref(null);
    const passwordRef = ref();
    const clientSecret = ref("zxcWziazfDDlJOB77LMqRLVCvOsZWf9qKLvPMvFX");
    const cliendId = ref(2);
    const router = useRouter();
    function verify() {
      passwordRef.value.validate();
      if (passwordRef.value.hasError) {
        q.notify({
          color: "negative",
          position: "top",
          message: "Please chech your inputs",
        });
      } else {
        api
          .post("api/admin/auth", {
            grant_type: "password",
            client_id: cliendId.value,
            client_secret: clientSecret.value,
            username: appData.mobile, //route.params.modelValue, //username.value,
            password: password.value,
          })
          .then((r) => {
            console.log(r.data);
            if (r.data.access_token) {
              q.cookies.set("access_token", r.data.access_token);
              q.cookies.set("refresh_token", r.data.refresh_token);
              q.cookies.set("expires_in", r.data.expires_in);
              router.push("/dashboard");
            } else {
              alert("مشکلی پیش آمده");
            }
          });
      }
    }
    return {
      username,
      password,
      passwordRef,
      verify,
    };
  },
};
</script>
