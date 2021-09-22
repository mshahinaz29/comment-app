<template>
<div>
    <div class="comment" v-if="comment.level==0">
        <div class="avatar">
            <!-- <img :src="comment.avatar" alt=""> -->
        </div>
        <div class="text">
            <a class="username" href="#">{{ comment.commented_by}}</a> 
            <br>
            <span>{{ comment.text }}</span>
            <br>
            <a href="javascript:void(0)" class="text-info" @click="reply(comment)">Reply</a>

        </div>
        
    </div>
<!-- 2nd level comments -->
    <div class="comment ml-5" v-else-if="comment.level==1">
        <div class="avatar">
            <!-- <img :src="comment.avatar" alt=""> -->
        </div>
        <div class="text">
            <a class="username" href="#">{{comment.level}}{{ comment.commented_by}}</a> 
            <br>
            <span>{{ comment.text }}</span>
            <br>
            <a href="javascript:void(0)" class="text-info" @click="reply(comment)">Reply</a>

        </div>
        
    </div>
<!-- 3rd level comments -->
    <div class="comment ml-10" v-else-if="comment.level==2">
        <div class="avatar">
            <!-- <img :src="comment.avatar" alt=""> -->
        </div>
        <div class="text">
            <a class="username" href="#">{{ comment.commented_by}}</a> 
            <br>
            <span>{{ comment.text }}</span>
            <br>
            <!-- <a href="javascript:void(0)" class="text-info" @click="reply(comment)">Reply</a> -->

        </div>
        
    </div>

        
</div>
    
</template>

<script>
    export default {
        name: 'singleComment',
        props: ['comment'],
        methods: {
            reply(value){
                this.$parent.reply(value);
                // alert('test');
            }
        },
         
    }
</script>

<style scoped>
/* Single-comment component */
.ml-10, .mx-10 {
    margin-left: 6rem !important;
}
.comment {
    display: flex;
    padding: 10px;
    margin-bottom: 10px;
    align-items: center;
    color: #333;
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
}
.comment .avatar {
    align-self: flex-start;
}
.comment .avatar > img {
    width: 40px;
    height: 40px;
    border-radius: 100%;
    align-self: start;
}
.comment .text {
    text-align: left;
    margin-left: 5px;
}
.comment .text span {
    margin-left: 5px;
}
.comment .text .username {
    font-weight: bold;
    color: #333;
}
</style>