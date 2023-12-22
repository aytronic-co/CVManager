<template>
  <div class="swiper-container text-center">
    <h3>نمونه کارها</h3>
    <swiper
    :slides-per-view="3"
    :space-between="50"
    @swiper="onSwiper"
    @slideChange="onSlideChange"
  >
    <swiper-slide class="swiper-slide">
        <img src="../assets/images/img-1.jpg" alt="">
    </swiper-slide>
     <swiper-slide class="swiper-slide">
        <img src="../assets/images/img-2.jpg" alt="">
    </swiper-slide>
      <swiper-slide class="swiper-slide">
        <img src="../assets/images/img-3.jpg" alt="">
    </swiper-slide>
      <swiper-slide class="swiper-slide">
        <img src="../assets/images/img-4.jpg" alt="">
    </swiper-slide>


  </swiper>
  </div>

</template>
<script>
  // Import Swiper Vue.js components
  import { Swiper, SwiperSlide } from 'swiper/vue';

  // Import Swiper styles
  import 'swiper/css';

  export default {
    components: {
      Swiper,
      SwiperSlide,
    },
    setup() {
      const onSwiper = (swiper) => {
        console.log(swiper);
      };
      const onSlideChange = () => {
        console.log('slide change');
      };
      return {
        onSwiper,
        onSlideChange,
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
