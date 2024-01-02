<template>
  <q-page>
    <div class="flex flex-center">
      <q-input v-model="school" label="School"> </q-input><br />
      <q-input v-model="degree" label="Degree"> </q-input>
      <q-input v-model="field" label="field"> </q-input>
      <q-btn @click="Add" icon="add" unelevated />
    </div>
    <div>
      <div v-for="(edu, index) in EduData" :key="'AdminEdu' + index + 1">
        <q-card
          ><q-card-section>
            <h6 class="q-ma-none">
              دانشگاه: {{ edu.school }} - مقطع: {{ edu.degree }} - رشته:
              {{ edu.field }}
              <q-btn @click="edit(index)" icon="edit" unelevated />
              <q-btn
                @click="deleteEdu(edu.id, index)"
                icon="delete"
                unelevated
              />
            </h6> </q-card-section
        ></q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import { onMounted, ref } from "vue";
import { api } from "src/boot/axios";
import { useQuasar } from "quasar";

export default {
  name: "EducationPage",
  setup() {
    const $q = useQuasar();
    const school = ref("");
    const degree = ref("");
    const field = ref("");
    const selectedEdu = ref("");
    const EduData = ref([]);
    function fetchUserEdu() {
      api.get("api/user").then((r) => {
        EduData.value = r.data.educations;
      });
    }
    onMounted(() => {
      fetchUserEdu();
    });
    function edit(index) {
      degree.value = EduData.value[index].degree;
      school.value = EduData.value[index].school;
      field.value = EduData.value[index].field;
    }
    function deleteEdu(id, index) {
      api.delete("api/admin/education/" + id).then((r) => {
        if (r.data.status) {
          EduData.value.splice(index, 1);
          $q.notify({
            message: "با موفقیت حذف شد",
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
    function Add() {
      api
        .post("api/admin/education/", {
          degree: degree.value,
          school: school.value,
          field: field.value,
        })
        .then((r) => {
          if (r.data.status) {
            EduData.value.push({
              school: school.value,
              degree: degree.value,
              field: field.value,
            });
            (school.value = null),
              (degree.value = null),
              (field.value = null),
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
      fetchUserEdu,
      EduData,
      Add,
      school,
      field,
      degree,
      edit,
      deleteEdu,
      selectedEdu,
    };
  },
};
</script>
