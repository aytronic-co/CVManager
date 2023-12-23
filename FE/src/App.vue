<template>
  <router-view />
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'App'
})
</script>

<style>

.roundCard {
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
  overflow: hidden !important;
}
.slide .roundCard,
.roundCard .recipeIMG {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: 100%;
}
.enNumSans {
  font-family: IranSans !important;
}


</style>
