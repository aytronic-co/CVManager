<template>
  <q-page>
    <div class="flex flex-center">
      <q-input
        v-model="school"
        label="School"
        :rules="[(val) => val.length > 0 || 'Field is required']"
      >
      </q-input>
      <q-input
        v-model="degree"
        label="Degree"
        :rules="[(val) => val.length > 0 || 'Field is required']"
      >
      </q-input>
      <q-input
        v-model="field"
        label="field"
        :rules="[(val) => val.length > 0 || 'Field is required']"
      >
      </q-input>
      <q-input v-model="startDate" label="start date"> </q-input>
      <q-input v-model="endDate" label="end date"> </q-input>

      <q-btn @click="AddOrUpdate" icon="add" unelevated />
    </div>
    <div>
      <div v-for="(edu, index) in EduData" :key="'AdminEdu' + index + 1">
        <q-card
          ><q-card-section>
            <h6 class="q-ma-none">
              دانشگاه: {{ edu.school }} - مقطع: {{ edu.degree }} - رشته:
              {{ edu.field }} - شروع : {{ edu.start_date }} - پایان:
              {{ edu.end_date }}
              <q-btn @click="edit(edu.id, index)" icon="edit" unelevated />
              <q-btn
                @click="showDeleteBox(edu.id, index)"
                icon="delete"
                unelevated
              />
            </h6>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
  <q-page>
    <div>
      <q-dialog style="min-width: 450px" v-model="deleteMode">
        <q-card flat class="full-width r35">
          <q-card-section
            class="text-center bg-light-blue-3 text-light-blue-10 text-weight-bold text-h6"
          >
            تاییده حذف
          </q-card-section>
          <q-card-section>
            آیا از حذف "{{ EduData[selectedEduIndex].degree }}:
            {{ EduData[selectedEduIndex].school }}" مطمئن هستید؟
          </q-card-section>
          <q-card-actions align="around">
            <q-btn
              class="q-px-xl"
              rounded
              unelevated
              color="light-green-6"
              label="بله"
              @click="deleteEdu"
            />
            <q-btn
              class="q-px-xl"
              rounded
              unelevated
              color="pink-7"
              label="لغو"
              v-close-popup
            />
          </q-card-actions>
        </q-card>
      </q-dialog>
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
    const EditMode = ref(false);
    const school = ref("");
    const degree = ref("");
    const field = ref("");
    const startDate = ref("");
    const endDate = ref("");
    const selectedEduID = ref("");
    const selectedEduIndex = ref("");
    const deleteMode = ref(false);
    const EduData = ref([]);
    function fetchUserEdu() {
      api.get("api/user").then((r) => {
        EduData.value = r.data.educations;
      });
    }
    onMounted(() => {
      fetchUserEdu();
    });

    function reset() {
      myForm.value.resetValidation();
    }

    function edit(id, index) {
      degree.value = EduData.value[index].degree;
      school.value = EduData.value[index].school;
      field.value = EduData.value[index].field;
      startDate.value = EduData.value[index].start_date;
      endDate.value = EduData.value[index].end_date;
      EditMode.value = true;
      selectedEduID.value = id;
      selectedEduIndex.value = index;
    }
    function showDeleteBox(id, index) {
      selectedEduID.value = id;
      selectedEduIndex.value = index;
      deleteMode.value = true;
    }

    function deleteEdu() {
      const id = selectedEduID.value;
      const index = selectedEduIndex.value;
      deleteMode.value = false;
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
    function AddOrUpdate() {
      if (EditMode.value) {
        api
          .put("api/admin/education/" + selectedEduID.value, {
            degree: degree.value,
            school: school.value,
            field: field.value,
            start_date: startDate.value,
            end_date: endDate.value,
          })
          .then((r) => {
            if (r.data.status) {
              (EduData.value[selectedEduIndex.value].school = school.value),
                (EduData.value[selectedEduIndex.value].degree = degree.value),
                (EduData.value[selectedEduIndex.value].field = field.value),
                (EduData.value[selectedEduIndex.value].start_date =
                  startDate.value),
                (EduData.value[selectedEduIndex.value].end_date =
                  endDate.value),
                (school.value = null),
                (degree.value = null),
                (field.value = null),
                (startDate.value = null),
                (endDate.value = null),
                (EditMode.value = false),
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
      } else {
        api
          .post("api/admin/education/", {
            degree: degree.value,
            school: school.value,
            field: field.value,
            start_date: startDate.value,
            end_date: endDate.value,
          })
          .then((r) => {
            if (r.data.status) {
              EduData.value.push({
                school: school.value,
                degree: degree.value,
                field: field.value,
                start_date: startDate.value,
                end_date: endDate.value,
                id: r.data.education.id,
              });
              (school.value = " "),
                (degree.value = " "),
                (field.value = " "),
                (startDate.value = null),
                (endDate.value = null),
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
    }

    return {
      fetchUserEdu,
      EduData,
      school,
      field,
      degree,
      edit,
      deleteEdu,
      selectedEduID,
      selectedEduIndex,
      startDate,
      endDate,
      AddOrUpdate,
      EditMode,
      deleteMode,
      showDeleteBox,
    };
  },
};
</script>
