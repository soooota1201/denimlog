<template>
    <div>
        <a @click="unfollow" href="" class="btn btn-success btn-sm" v-if="result">following<span class="badge"></span></a>
        <a @click="follow" href="" class="btn btn-outline-dark btn-sm" v-else>follow<span class="badge"></span></a>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
          return {
            result: "false"
          }
        },
        mounted() {
          this.hasFollow();
        },
        methods: {
            follow() {
                axios.get('/users/' + this.user.id + '/follow')
                .then(res => {
                  this.count = res.data.count;
                })  
                .catch(function(error) {
                    console.log(error);
                });
            },
            unfollow() {
                axios.get('/users/' + this.user.id + '/unfollow')
                .then(res => {
                  this.count = res.data.count;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            hasFollow() { 
                axios.get('/users/' + this.user.id + '/hasfollow')
                .then(res => {
                  console.log(res.data);
                    this.result = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>