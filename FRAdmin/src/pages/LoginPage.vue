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
<<<<<<<< HEAD:FE/src/pages/LoginPage.vue
          v-model="mobile"
          ref="mobileRef"
          autocomplete="off"
          :rules="[val => !!val || 'Field is required' ,
           val => val.length === 10 ||  'Please enter 10 characters' ]"
========
          v-model="username"
          autocomplete="off"
          :rules="[
            (val) => !!val || 'Field is required',
            (val) => val.length > 9,
          ]"
>>>>>>>> 6cc72777352c1fbc895c0b4373a675d2a49e80c1:FRAdmin/src/pages/LoginPage.vue
        />

        <q-btn
          outline
          class="full-width q-mt-md q-py-sm"
          color="light-blue-6"
          label="بزن بریم"
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
<<<<<<<< HEAD:FE/src/pages/LoginPage.vue
import { useQuasar } from "Quasar";
========
import { storeToRefs } from "pinia";
>>>>>>>> 6cc72777352c1fbc895c0b4373a675d2a49e80c1:FRAdmin/src/pages/LoginPage.vue

export default {
  name: "LoginPage",
  setup() {
    const q = useQuasar();
    const mobileRef = ref();
    const appData = useAppDataStore();
    const { userMobile } = storeToRefs(appData);
    const q = useQuasar();
    const usernameRef = ref(null);
    const username = ref();
    const router = useRouter();
    function login() {
<<<<<<<< HEAD:FE/src/pages/LoginPage.vue
      mobileRef.value.validate()
        if (mobileRef.value.hasError ) {
        q.notify({
            color: 'negative',
            position : 'top' ,
            message: 'please check your input!'
          })
        }else{
          if (mobile.value) {
        if(mobile.value.length === 10 ){
        appData.userMobile = mobile.value
        api.post("api/admin/send-vc", {
            mobile: mobile.value,
========
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
>>>>>>>> 6cc72777352c1fbc895c0b4373a675d2a49e80c1:FRAdmin/src/pages/LoginPage.vue
          })
          .then((r) => {
            console.log(r.data);
            if (r.data) {
              router.push('/confirm');
            }else{
              alert('مشکلی پیش آمده لطفا بعدا دوباره تست نمایید')
            }
          });
        } else{
        alert("mobile not match")
      }
      }else{
        alert("Enter Data")
      }
    }
        }


    return {
<<<<<<<< HEAD:FE/src/pages/LoginPage.vue
      mobile,
      login ,
      mobileRef
========
      login,
      usernameRef,
      username,
>>>>>>>> 6cc72777352c1fbc895c0b4373a675d2a49e80c1:FRAdmin/src/pages/LoginPage.vue
    };
  },
};
</script>
