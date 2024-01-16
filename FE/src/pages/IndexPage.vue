<template>
  <q-page class="flex flex-center">
    <div class="row justify-center">
      <div class="col-auto text-center">
        <q-page>
          <a id="homeTag"></a>
          <br /><br /><br /><br />
          <q-avatar size="80px">
            <q-img
              v-if="userData"
              :src="
                'http://localhost:8000/storage/' + userData.profile.image.url
              "
            />
            <q-skeleton v-else type="circle" />
          </q-avatar>
          <h4 v-if="userData" class="text-h6 q-ma-none">
            من {{ userData.profile.full_name }} هستم. به صفحه شخصی من خوش آمدید.
            <br />
            درباره من :{{ userData.profile.about }}
          </h4>
        </q-page>
        <q-page>
          <a id="aboutTag">
            <br /><br /><br /><br />
            <h3 left>اطلاعات من</h3></a
          >
          <h6 v-if="userData">
            <div class="row">
              <div class="col s12 m4">
                <div>تاریخ تولد : {{ userData.profile.birth_date }}</div>
                <div>محل تولد : {{ userData.profile.birth_country }}</div>
                <div>آدرس : {{ userData.profile.address }}</div>
              </div>
              <div class="col s12 m4">
                <div>وضعیت کاری :{{ userData.profile.status }}</div>
                <div>وضعیت تاهل :{{ userData.profile.marrid }}</div>
                <div>وضعیت خدمت :{{ userData.profile.khedmat }}</div>
                <!-- <div> جنیست :{{ userData.profile.gender }} </div> -->
              </div>
            </div>
          </h6>
          <div>لینکهای فضای مجازی من:</div>
          <q-card>
            <q-card-section>
              <h8 class="q-ma-none">
                "Instagram:" {{ social_links.instagram }}
              </h8>
            </q-card-section>
            <q-card-section>
              <h8 class="q-ma-none">
                "Telegram:" {{ social_links.telegram }}
              </h8>
            </q-card-section>
            <q-card-section>
              <h8 class="q-ma-none">
                "LinkedIn:" {{ social_links.linkedin }}
              </h8>
            </q-card-section>
          </q-card>
          <div>تحصیلات من:</div>
          <div
            class="col-6"
            v-for="(edu, index) in userEdus"
            :key="'edu' + index + 1"
          >
            <q-card
              ><q-card-section>
                <h8 class="q-ma-none"> {{ edu.degree }} : {{ edu.school }} </h8>
              </q-card-section></q-card
            >
          </div>
        </q-page>
        <q-page>
          <a id="portfolioTag"
            ><br /><br /><br /><br />
            <h3>نمونه کارهای من</h3></a
          >
          <h5 v-if="userData">نمونه کاری من</h5>
        </q-page>
        <q-page>
          <a id="contactTag"
            ><br /><br /><br /><br />
            <h3>تماس با من</h3></a
          >
          <h5 v-if="userData">
            ایمیل ارتباطی من : {{ userData.profile.contact_email }}
          </h5>
          <h5 v-if="userData">
            شماره تماس من : {{ userData.profile.contact_number }}
          </h5>
        </q-page>
        <q-page>
          <a id="resumeTag"
            ><br /><br /><br /><br />
            <h3>رزومه من</h3></a
          >
          دانلود رزومه من
        </q-page>
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
    const social_links = ref("");
    const userEdus = ref([]);
    function fetchUser() {
      api.get("api/user").then((r) => {
        // console.log(r.data);
        userData.value = r.data;
        usrprf.value = r.data.profile;
        // console.log(r.data.profile);
        social_links.value = JSON.parse(r.data.profile.social_links);
      });
    }
    function fetchUserEdu() {
      api.get("api/userEdu").then((r) => {
        //console.log(r.data);
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
      social_links,
    };
  },
};
</script>
