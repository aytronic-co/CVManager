<template>
  <q-page class="flex flex-center">
    <h1 v-if="profileData">
      <q-input v-model="number" label="شماره تماس ارتباطی"> </q-input>
      <q-input v-model="email" label="آدرس ایمیل ارتباطی"> </q-input>
      <q-btn @click="edit" icon="done" unelevated />
    </h1>
  </q-page>
</template>

<script>
import { onMounted, ref } from "vue";
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";

export default {
  name: "contactPage",
  setup() {
    const $q = useQuasar();
    const email = ref("");
    const number = ref("");
    const profileData = ref("");
    function fetchUserProfile() {
      api.get("api/user").then((r) => {
        profileData.value = r.data.profile;
        number.value = r.data.profile.contact_number;
        email.value = r.data.profile.contact_email;
        console.log(profileData.value.id);
      });
    }
    onMounted(() => {
      fetchUserProfile();
    });
    function edit() {
      api
        .put("api/admin/profile/" + profileData.value.id, {
          full_name: profileData.value.full_name,
          contact_number: number.value,
          contact_email: email.value,
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
      fetchUserProfile,
      profileData,
      edit,
      number,
      email,
    };
  },
};
</script>
