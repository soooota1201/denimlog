<template>
    <swiper :options="swiperOption" ref="mySwiper1">
    <swiper-slide v-for="record in records" :key="record.cloud_record_image_path">
        <img :src="record.cloud_record_image_path" class="">
    </swiper-slide>
    <div class="swiper-button-prev" slot="button-prev"></div>
    <div class="swiper-button-next" slot="button-next"></div>
     </swiper>
</template>

<style scoped>
.swiper-container {
  width: 100%;
}

.swiper-slide {
  
}

.swiper-slide img {
  width: 100%;
  height: 700px;
  object-fit: contain;
}

</style>

<script>
export default {
    props: ["records"],
    data() {
      return {
      swiperOption: {
          slidesPerView: 1,
          loop: true,
          navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
          },
      },
    }
  }
}
</script>