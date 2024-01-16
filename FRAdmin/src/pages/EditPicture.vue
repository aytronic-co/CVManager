use console;
<template>
  <q-page padding class="row">
    <!-- content -->
    <q-form class="col-12 row" @submit="updatePicture">
      <div class="col-12 q-gutter-y-md">
        <!-- <q-uploader
          style="width: 100%"
          url="http://localhost:4444/upload"
          label="Restricted to images"
          accept=".jpg, image/*"
          v-model="image_url"
        /> -->

        <q-file
          name="image_url"
          v-model="file"
          filled
          label="Select new profile image"
        />
        <q-btn
          type="submit"
          label="update"
          icon-right="send"
          outline
          :loading="loading"
          :disable="loading"
          rounded
          class="full-width"
          size="lg"
        />
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { reactive, toRefs } from "vue";
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";
import { useRouter, useRoute } from "vue-router";

export default {
  // name: 'PageName',
  setup() {
    const q = useQuasar();
    const router = useRouter();
    const route = useRoute();
    const props = reactive({
      profile: null,
      loading: false,
      image_url: "",
    });
    function fetchProfile(){
      api.get("api/user").then((r) => {
        props.profile=r.data.profile;
      });
    }
    fetchProfile();
    function updatePicture(event) {
      const formData = new FormData(event.target);
      props.loading = true;
          api
            .post("api/admin/profile/" + props.profile.id, formData, {
              method: put,
              headers: { "Content-Type": "multipart/form-data" },
            })
            .then((r) => {
              props.loading = false;
              console.log(r.data);
              if (r.data.status) {
                q.notify({
                  color: "light-blue-6",
                  position: "top",
                  message: "photo updated successfully!",
                  icon: "done_all",
                });
                router.push("/profile");
              } else {
                q.notify({
                  color: "orange-6",
                  position: "top",
                  message: "can not update the photo!",
                  //icon: "done_all",
                });
              }
            })
            .catch((e) => {
              props.loading = false;
              console.log(e);
            });
        
    }
    return {
      ...toRefs(props),
      updatePicture,
      fetchProfile,
    };
  },
};
</script>
