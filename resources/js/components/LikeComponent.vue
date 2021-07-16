<template>
    <div>
        <a @click="unlike" href="" class="btn btn-success btn-sm" v-if="result"><i class="far fa-thumbs-up"></i>{{ count }}<span class="badge"></span></a>
        <a @click="like" href="" class="btn btn-secondary btn-sm" v-else><i class="far fa-thumbs-up"></i>{{ count }}<span class="badge"></span></a>
    </div>
</template>

<script>
    export default {
        props: ['record'],
        data() {
          return {
            count: "",
            result: "false"
          }
        },
        mounted() {
            this.countlikes();
            this.hasLikes();
        },
        methods: {
            like() {
                axios.get('/users/' + this.record.user_id + '/denims/' + this.record.denim_id +'/records/' + this.record.id + '/like')
                .then(res => {
                  this.count = res.data.count;
                })  
                .catch(function(error) {
                    console.log(error);
                });
            },
            unlike() {
                axios.get('/users/' + this.record.user_id + '/denims/' + this.record.denim_id +'/records/' + this.record.id + '/unlike')
                .then(res => {
                  this.count = res.data.count;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            countlikes() {
              axios.get('/users/' + this.record.user_id +'/denims/' + this.record.denim_id +'/records/' + this.record.id + '/count')
              .then(res => {
                console.log(res.data)
                this.count = res.data;
              })
              .catch(function(error){
                  console.log(error);
              });
            },
            hasLikes() { 
                axios.get('/users/' + this.record.user_id + '/denims/' + this.record.denim_id +'/records/' + this.record.id + '/haslikes')
                .then(res => {
                    this.result = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>