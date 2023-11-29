<template>
  <q-page padding>
    <!-- content -->
    <h4 class="text-center">  فرم ورود </h4>
    <div class="row justify-center">
      <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
     <q-input  placeholder="9112746075"
    label="mobile"
    rounded outlined
     class="q-mt-lg"
     type="text"
     v-model="mobile"
     ref="usernameRef"
     autocomplete="off"
     :rules="[val => !!val || 'Field is required' ,
     ]"
      />

    <q-btn outline
    class="full-width q-mt-md q-py-sm "
     color="light-blue-6" label="ورود" icon="security" rounded outlined
     @click="login"
     />
      </div>
    </div>

  </q-page>
</template>

<script>
// import { ref } from 'vue';
// import { useQuasar } from 'quasar'
// import { api } from 'src/boot/axios';
// import { useRouter } from 'vue-router';
// import { useAppDataStore } from 'src/stores/appData';
// import { storeToRefs } from 'pinia';

// export default {
//   // name: 'PageName',
//   setup(){
//     const appData = useAppDataStore() ;
//     const  { mobile} = storeToRefs(appData)
//     const q = useQuasar() ;
//     const usernameRef = ref();
//     const router = useRouter();
//     function login(){
//       usernameRef.value.validate();
//       // passwordRef.value.validate();
//       if (usernameRef.value.hasError ) {
//         q.notify({
//             color: 'negative',
//             position : 'top' ,
//             message: 'please check your input!'
//           })
//         }else{
//           api.post('api/verify' , {
//            username : mobile.value,

//           })
//           .then(r => {
//             router.push('/confirm')
//            if(r.data.access_token){
//             //   q.cookies.set('access_token' , r.data.access_token , {expires: '365d'})
//             //   q.cookies.set('refresh_token' , r.data.refresh_token , {expires: '365d'})
//             //   q.cookies.set('expires_in' , r.data.expires_in , {expires: '365d'})
//             // }  //
//             // router.push('/confirm');
//            }
//           });
//         }

//     }
//     return{
//         mobile ,
//         login ,
//         usernameRef ,

//       }
//   },
// };
</script>
