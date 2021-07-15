<template>
    <div>
        <a @click="like" href="" class="btn btn-success btn-sm">いいね<span class="badge"></span></a>
        <a @click="unlike" href="" class="btn btn-secondary btn-sm">いいね<span class="badge"></span></a>
    </div>
</template>

<script>
    export default {
        props: ['record'],
        mounted() {
            console.log(this.record)
        },
        methods: {
            like() {
                axios.get('/reply/like' + this.record.id)
                .catch(function(error) {
                    console.log(error);
                });
            },
            unlike() {
                axios.get('/reply/unlike' + this.record.id)
                .catch(function(error){
                    console.log(error);
                });
            },
        }
    }
</script>