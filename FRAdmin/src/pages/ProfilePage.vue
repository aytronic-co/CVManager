<template>
  <q-page class="flex flex-center">
    <h1>
      <q-item
        v-if="ProfileExist"
        @click="$router.push(`/profile/editpic/`)"
        clickable
      >
        <q-item-section>
          <q-icon size="12px" name="edit" />
          <q-avatar size="80px">
            <q-img
              v-if="profileData.image"
              :src="'http://localhost:8000/storage/' + profileData.image.url"
            />
            <q-skeleton v-else type="circle" />
          </q-avatar>
        </q-item-section>
      </q-item>
    </h1>
    <h1>
      <q-input v-model="name" label="اسم"> </q-input>
      <q-input v-model="birth_date" label="تاریخ تولد"> </q-input>
      <q-input v-model="birth_country" label="محل تولد"> </q-input>
      <q-input v-model="address" label="آدرس"> </q-input>
    </h1>
    <h1>
      <q-input v-model="status" label=" وضعیت کاری"> </q-input>
      <q-input v-model="khedmat" label="وضعیت خدمت"> </q-input>
      <q-input v-model="marrid" label="وضعیت تاهل"> </q-input>
      <q-input v-model="gender" label=" جنیست "> </q-input>
    </h1>
    <h1>
      <q-input v-model="instagram" label="لینک اینستاگرام"> </q-input>
      <q-input v-model="telegram" label="لینک تلگرام"> </q-input>
      <q-input v-model="linkedin" label="لینک لینکدین"> </q-input>
      <q-input v-model="about" label="درباره"> </q-input>
    </h1>
    <h1>
      <q-btn @click="Submite" icon="done" unelevated />
    </h1>
  </q-page>
</template>

<script>
import { onMounted, ref } from "vue";
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { reactive, toRefs } from "vue";
import { useRouter, useRoute } from "vue-router";
import EditPicture from "./EditPicture.vue";

export default {
  name: "profilePage",
  setup() {
    const router = useRouter();
    const route = useRoute();
    const profileData = ref("");
    const instagram = ref(null);
    const telegram = ref(null);
    const linkedin = ref(null);
    const $q = useQuasar();
    const props = reactive({
      name: null,
      birth_date: null,
      birth_country: null,
      address: null,
      status: 1,
      marrid: null,
      gender: null,
      khedmat: null,
      social_links: null,
      about: null,
      ProfileExist: false,
    });
    function fetchProfile() {
      api.get("api/user").then((r) => {
        if (r.data.profile) {
          profileData.value = r.data.profile;
          props.name = r.data.profile.full_name;
          props.birth_date = profileData.value.birth_date;
          props.birth_country = profileData.value.birth_country;
          props.address = profileData.value.address;
          props.status = profileData.value.status;
          props.marrid = profileData.value.marrid;
          props.gender = profileData.value.gender;
          props.khedmat = profileData.value.khedmat;
          //props.social_links = profileData.value.social_links;

          props.social_links = JSON.parse(profileData.value.social_links);

          props.about = profileData.value.about;
          if (props.social_links){
          instagram.value = props.social_links.instagram;
          telegram.value = props.social_links.telegram;
          linkedin.value = props.social_links.linkedin;
          }
          props.ProfileExist = true;
        }
      });
    }
    onMounted(() => {
      fetchProfile();
    });
    function edit() {
      props.social_links = JSON.stringify({
        instagram: instagram.value,
        telegram: telegram.value,
        linkedin: linkedin.value,
      });
      api
        .put("api/admin/profile/" + profileData.value.id, {
          full_name: props.name,
          contact_number: profileData.value.contact_number,
          birth_date: props.birth_date,
          birth_country: props.birth_country,
          address: props.address,
          status: props.status,
          marrid: props.marrid,
          gender: props.gender,
          khedmat: props.khedmat,
          social_links: props.social_links,
          about: props.about,
          whichPartUpdate: 1,
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
      props.social_links = JSON.stringify({
        instagram: instagram.value,
        telegram: telegram.value,
        linkedin: linkedin.value,
      });
      api
        .post("api/admin/profile", {
          full_name: props.name,
          birth_date: props.birth_date,
          birth_country: props.birth_country,
          address: props.address,
          status: props.status,
          marrid: props.marrid,
          gender: props.gender,
          khedmat: props.khedmat,
          social_links: props.social_links,
          about: props.about,
          whichPartUpdate: 1,
        })
        .then((r) => {
          console.log(r.data);
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
    function Submite() {
      if (profileData.value) {
        edit();
        props.ProfileExist = true;
      } else {
        create();
        props.ProfileExist = true;
      }
    }
    return {
      ...toRefs(props),
      instagram,
      telegram,
      linkedin,
      fetchProfile,
      profileData,
      edit,
      create,
      Submite,
    };
  },
};
</script>
