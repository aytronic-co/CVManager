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
import { defineComponent } from "vue";
import { ref } from "vue";
import { useRouter } from "vue-router";

export default defineComponent({
  name: "PageName",
  setup() {
    const mobile = ref("");
    const router = useRouter();
    function login(){
      if(mobile.value){
        api.post('api/send-vc' , {
          mobile: mobile.value ,
        })
        .then((r) =>{
          console.log(r.data);
          if (r.data.status){
             router.push('/confirm')
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
