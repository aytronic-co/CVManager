<template>
  <q-page class="flex flex-center">
    <div class="row justify-center">
      <div class="col-auto text-center">
        <q-avatar size="80px">
          <q-img
            v-if="userData"
            :src="'http://localhost:8000/storage/' + userData.profile.image.url"
          />
          <q-skeleton v-else type="circle" />
        </q-avatar>
        <h4 v-if="userData" class="text-h6 q-ma-none">
          من {{ userData.profile.full_name }} هستم. به صفحه شخصی من خوش آمدید.
        </h4>
        <h5 v-if="userData">
          تاریخ تولد من : {{ userData.profile.birth_date }}
        </h5>
        <h5 v-if="userData">ایمیل من : {{ userData.profile.contact_email }}</h5>

        <div>تحصیلات من:</div>
        <div
          class="col-6"
          v-for="(edu, index) in userEdus"
          :key="'edu' + index + 1"
        >
          <q-card
            ><q-card-section>
              <h6 class="q-ma-none">{{ edu.degree }} : {{ edu.school }}</h6>
            </q-card-section></q-card
          >
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { onMounted, ref } from "vue";
import { api } from "src/boot/axios";

export default {
  name: "AboutPage",
  setup() {
    const userData = ref("");
    const usrprf = ref("");
    const userEdus = ref([]);
    function fetchUser() {
      api.get("api/user").then((r) => {
        console.log(r.data);
        userData.value = r.data;
        usrprf.value = r.data.profile;
        console.log(r.data.profile);
      });
    }
    function fetchUserEdu() {
      api.get("api/userEdu").then((r) => {
        console.log(r.data);
        userEdus.value = r.data;
      });
    }
    onMounted(() => {
      fetchUser();
      fetchUserEdu();
    });
    return {
      fetchUser,
      fetchUserEdu,
      userData,
      userEdus,
      usrprf,
    };
  },
};
</script>
