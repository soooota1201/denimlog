<template>
    <div>
        test
        <div id="map"></div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        map: '',
      }
    },
    mounted() {
      console.log(window.google)
      setTimeout(() => {
        if(!window.google){
          console.log('ロードに時間がかかっています。')
        }else{
          console.log(window.google)
        }
      },3000)
    }
  }
</script>
