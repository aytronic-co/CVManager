<template>
  <q-page padding >
    <h4 class="text-center">  فرم تایید </h4>
    <!-- content -->
    <div class="row justify-center">
      <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
     <q-input
    rounded outlined
     class="q-mt-lg"
     type="text"
     v-model="password"
     ref="usernameRef"
     autocomplete="off"
     :rules="[val => !!val || 'Field is required' ,
     ]"
      />

    <q-btn outline
    class="full-width q-mt-md q-py-sm "
     color="light-blue-6" label="شروع کن"  rounded outlined
     @click="login"
     />
      </div>
    </div>

  </q-page>
</template>

<script>
// import { onMounted, ref } from 'vue';
// import { useQuasar } from 'quasar'
// import { api } from 'src/boot/axios';
// import {  useRoute , useRouter } from 'vue-router';
// import { useAppDataStore } from 'src/stores/appData';

// export default {
//   // name: 'PageName',
//   setup(){
//     const appData = useAppDataStore() ;
//     const  q = useQuasar() ;
//     const passwordRef = ref();
//     const password = ref(null);
//     const router = useRouter();
//     function login(){
//       usernameRef.value.validate();
//      passwordRef.value.validate();
//       if (usernameRef.value.hasError ) {
//         q.notify({
//             color: 'negative',
//             position : 'top' ,
//             message: 'please check your input!'
//           });
//         }else{
//           api.post('oauth/token' , {
//             grant_type : "password",
//             password : password.value ,
//           })
//           .then(r => {
//             console.log(r.data);
//             if(r.data.access_token){
//               q.cookies.set('access_token' , r.data.access_token , {expires: '365d'})
//               q.cookies.set('refresh_token' , r.data.refresh_token , {expires: '365d'})
//               q.cookies.set('expires_in' , r.data.expires_in , {expires: '365d'})
//             }
//             router.push('/');
//           });
//         }

//     }
//     onMounted(()=>{
//       console.log(appData.mobile);
//     })
//     return{
//         password ,
//         login ,
//         passwordRef ,
//       }
//   },
// };
</script>
