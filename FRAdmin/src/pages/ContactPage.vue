<template>
  <q-page class="flex flex-center">
    <h1>
      <q-input v-model="number" label="شماره تماس ارتباطی"> </q-input>
      <q-input v-model="email" label="آدرس ایمیل ارتباطی"> </q-input>
      <q-btn @click="upload" icon="done" unelevated />
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
    const ProfileExist = ref(false);
    const profileData = ref("");
    function fetchUserProfile() {
      api.get("api/user").then((r) => {
        if (r.data.profile) {
          profileData.value = r.data.profile;
          number.value = r.data.profile.contact_number;
          email.value = r.data.profile.contact_email;
          console.log(profileData.value.id);
          ProfileExist.value = true;
        } else {
          number.value = "";
          email.value = "";
        }
      });
    }
    onMounted(() => {
      fetchUserProfile();
    });
    function edit() {
      api
        .put("api/admin/profile/" + profileData.value.id, {
          contact_number: number.value,
          contact_email: email.value,
          whichPartUpdate: 2,
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
    function create() {
      api
        .post("api/admin/profile", {
          contact_number: number.value,
          contact_email: email.value,
          whichPartUpdate: 2,
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
    function upload() {
      if (ProfileExist.value) edit();
      else create();
    }
    return {
      fetchUserProfile,
      profileData,
      edit,
      number,
      email,
      ProfileExist,
      upload,
      create,
    };
  },
};
</script>
