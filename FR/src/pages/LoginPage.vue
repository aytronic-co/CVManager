<template>
  <q-page padding>
    <!-- content -->
    <h4 class="text-center">فرم ورود</h4>
    <div class="row justify-center">
      <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
        <q-input
          placeholder="9112746075"
          label="mobile"
          rounded
          outlined
          class="q-mt-lg"
          type="text"
          v-model="mobile"
          autocomplete="off"
        />

        <q-btn
          outline
          class="full-width q-mt-md q-py-sm"
          color="light-blue-6"
          label="ورود"
          icon="security"
          rounded
          outlined
          @click="login"
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
    const  { mobile} = storeToRefs(appData)
    const router = useRouter ;
    function login(){
      mobile.value.validate();
      if(mobile.value){
        api.post('api/login', {
          mobile: mobile.value ,
        })
        .then((r) =>{
          console.log(r.data);
          if (r.data.status){
             router.push('/verify')
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
      mobile,
      login
    };
  },
});
</script>
