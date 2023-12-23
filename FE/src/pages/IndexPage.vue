<template>
  <div class="swiper-container text-center">
    <h4>نمونه کارها</h4>
    <swiper
    :slides-per-view="3"
    :space-between="50"
  >
    <swiper-slide class="slide">
      <q-card flat class="roundCard" >
        <q-img class="recipeIMG" src="../assets/images/img-1.jpg">
            <div dir="rtl" class="enNumSancs absolute-bottom  text-subtitle2">
              <q-icon name="favorite" color="white"/>
               2k
            </div>
        </q-img>

      </q-card>
    </swiper-slide>
     <swiper-slide class="slide">
       <q-card flat class="roundCard">
        <q-img class="recipeIMG" src="../assets/images/img-2.jpg">
   <div dir="rtl" class="enNumSancs absolute-bottom  text-subtitle2">
              <q-icon name="favorite" color="white"/>
               2k
            </div>
        </q-img>
    </q-card>
    </swiper-slide>
      <swiper-slide class="slide">
        <q-card flat class="roundCard">

          <q-img class="recipeIMG" src="../assets/images/img-3.jpg">
   <div dir="rtl" class="enNumSancs absolute-bottom  text-subtitle2">
              <q-icon name="favorite" color="white"/>
               2k
            </div>
          </q-img>
        <img  class="recipeIMG"  src="../assets/images/img-3.jpg" alt="">
        <q-img class="recipeIMG" src="../assets/images/img-4.jpg">
   <div dir="rtl" class="enNumSancs absolute-bottom  text-subtitle2">
              <q-icon name="favorite" color="white"/>
               2k
            </div>
        </q-img>
        </q-card>
    </swiper-slide>
      <swiper-slide class="slide">
        <q-card flat class="roundCard">
          <q-img class="recipeIMG" src="../assets/images/img-5.jpg">
   <div dir="rtl" class="enNumSancs absolute-bottom  text-subtitle2">
              <q-icon name="favorite" color="white"/>
               2k
            </div>
          </q-img>

        </q-card>
    </swiper-slide>
  </swiper>
  </div>
</template>
<script>
  import { Swiper, SwiperSlide } from 'swiper/vue';
  import 'swiper/css';
  export default {
    components: {
      Swiper,
      SwiperSlide,
    },
    setup() {
      return {

      };
    },
  };
</script>

<style>
.swiper-container{
  width: 600px;
  height: 300px;
}
.swiper-slide{
  background-size: cover;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 60px;
}
</style>
