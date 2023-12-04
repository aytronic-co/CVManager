<template>
  <q-page padding >
    <h4 class="text-center">  فرم تایید </h4>
    <!-- content -->
    <div class="row justify-center">
      <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
     <q-input
     placeholder="enter password"
     label="password"
     rounded outlined
     class="q-mt-lg"
     type="password"
     v-model="password"
     autocomplete="off"
      />

    <q-btn outline
    class="full-width q-mt-md q-py-sm "
     color="light-blue-6" label="شروع کن"  rounded outlined
     @click="verify"
     />
      </div>
    </div>

  </q-page>
</template>


<script>
import { api } from "src/boot/axios";
import { defineComponent } from "vue"
import { useRouter } from "vue-router";
import { useAppDataStore } from 'src/stores/appData';
import { storeToRefs } from 'pinia';

export default defineComponent({
  name: "PageName",
  setup() {
    const appData = useAppDataStore() ;
    const  { password } = storeToRefs(appData)
    const router = useRouter ;
    function verify(){
      if(password.value){
        password.value.validate();
        api.post('api/verify', {
          mobile : appData.mobile;
          password : password.value
        })
        .then((r) =>{
          console.log(r.data);
          if (r.data.status){
             router.push('/dashboard')
          }
          else{
            alert('مشکلی پیش آمده')
          }
        })
      }
     else{
        alert('enter data')
      }
    }
    return {
      password,
      verify
    };
  },
});
</script>

