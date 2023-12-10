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
    @click="verify"
     color="light-blue-6" label="شروع کن"  rounded outlined
     />
      </div>
    </div>

  </q-page>
</template>


<script>
import { api } from "src/boot/axios";
import { defineComponent, ref } from "vue"
import { useRouter } from "vue-router";
import { useAppDataStore } from 'src/stores/appData';

export default defineComponent({
  name: "PageName",
  setup() {
    const appData = useAppDataStore() ;
    const router = useRouter;
    const password = ref(null);
    function verify(){
      if(password.value){
        api.post('api/auth', {
          username : appData.userMobile,
          password : password.value
        })
        .then((r) =>{
          console.log(r.data);
          if (r.data.access_token) {
             router.push('/dashboard')
          }
          else {
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

