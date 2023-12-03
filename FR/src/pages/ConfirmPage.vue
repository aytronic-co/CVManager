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
     @click="start"
     />
      </div>
    </div>

  </q-page>
</template>

<script>


</script>
