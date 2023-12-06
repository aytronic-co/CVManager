<template>
    <q-page class="flex flex-center" >
  
      <q-form class="col-12 row" @submit="createPvrofile">
        <div class="col-12 q-gutter-y-md">
          <q-input
            name="title"
            label="نام و نام خانوادگی"
            autofocus
            rounded
            outlined
            v-model="title"
          />
          <q-file
          autofocus
            rounded
            outlined
            name="picture"
            v-model="file"
          
            label="عکس خود را انتخواب کنید"
          />
          <q-input
            name="caption"
            label="بیوگرافی"
            type="textarea"
            rounded
            outlined
            v-model="caption"
          />
          <div></div>
          <q-btn
            type="submit"
            label="Create"
            icon-right="send"
            outline
            :loading="loading"
            :disable="loading"
            rounded
            class="full-width"
            size="md"
          /></div
      ></q-form>
    </q-page>
  </template>
  
  <script>
  import { computed, reactive, ref, toRefs } from "vue";
  import { api } from "src/boot/axios";
  import { useQuasar } from "quasar";
  import { useRouter } from "vue-router";
  export default {
    // name: 'PageName',
    setup() {
      const q = useQuasar();
      const router = useRouter();
      const caption = ref('');
      const props = reactive({
        title: null,
        loading: false,
        file: null,
      });
      function handleFile(e) {
        props.file = e.target.files[0];
        console.log(props.file);
      }
      function createProfile(event) {
        const formData = new FormData(event.target);
        props.loading = true;
        api
           .post("api/admin/profile", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((r) => {
            props.loading = false;
            if (r.data.status) {
              q.notify({
                color: "light-blue-6",
                position: "top",
                message: "Post added successfully!",
                icon: "done_all",
              });
              router.push("/");
            } else {
              q.notify({
                color: "orange-6",
                position: "top",
                message: "Error!",
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
        createProfile,
        handleFile,
        caption,
        captionLimitMessage: computed(() => {
          return caption.value.length> 50 ? 'کمترش کن':'هنوز جا داری'
        })
      };
    },
  };
  </script>
  