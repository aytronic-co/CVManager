<template>
  <q-page class="flex flex-center">
    <h1 v-if="profileData">
      <q-item
        @click="$router.push(`/profile/editpic/${profileData.id}`)"
        clickable
      >
        <q-item-section>
          <q-icon size="12px" name="edit" />
          <q-avatar size="80px">
            <q-img
              v-if="profileData"
              :src="'http://localhost:8000/storage/' + profileData.image.url"
            />
            <q-skeleton v-else type="circle" />
          </q-avatar>
        </q-item-section>
      </q-item>
    </h1>
    <h1 v-if="profileData">
      <q-input v-model="name" label="اسم"> </q-input>
      <q-input v-model="birth_date" label="تاریخ تولد"> </q-input>
      <q-input v-model="birth_country" label="محل تولد"> </q-input>
      <q-input v-model="address" label="آدرس"> </q-input>
    </h1>
    <h1 v-if="profileData">
      <q-input v-model="status" label=" وضعیت کاری"> </q-input>
      <q-input v-model="khedmat" label="وضعیت خدمت"> </q-input>
      <q-input v-model="marrid" label="وضعیت تاهل"> </q-input>
      <q-input v-model="gender" label=" جنیست "> </q-input>
    </h1>
    <h1 v-if="profileData">
      <q-input v-model="instagram" label="لینک اینستاگرام"> </q-input>
      <q-input v-model="telegram" label="لینک تلگرام"> </q-input>
      <q-input v-model="linkedin" label="لینک لینکدین"> </q-input>
      <q-input v-model="about" label="درباره"> </q-input>
    </h1>
    <h1 v-if="profileData">
      <q-btn @click="edit" icon="done" unelevated />
    </h1>
  </q-page>
</template>

<script>
import { onMounted, ref } from "vue";
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { reactive, toRefs } from "vue";
import { useRouter, useRoute } from "vue-router";

export default {
  name: "profilePage",
  setup() {
    const router = useRouter();
    const route = useRoute();
    const profileData = ref("");
    const instagram = ref("");
    const telegram = ref("");
    const linkedin = ref("");
    const $q = useQuasar();
    const props = reactive({
      name: "",
      birth_date: "",
      birth_country: "",
      address: "",
      status: "",
      marrid: "",
      gender: "",
      khedmat: "",
      social_links: "",
      about: "",
    });
    function fetchProfile() {
      api.get("api/user").then((r) => {
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
        instagram.value = props.social_links.instagram;
        telegram.value = props.social_links.telegram;
        linkedin.value = props.social_links.linkedin;
      });
    }
    onMounted(() => {
      fetchProfile();
    });
    function edit() {
      props.social_links.instagram = instagram;
      props.social_links.telegram = telegram;
      props.social_links.linkedin = linkedin;
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
      instagram,
      telegram,
      linkedin,
      fetchProfile,
      profileData,
      edit,
    };
  },
};
</script>
