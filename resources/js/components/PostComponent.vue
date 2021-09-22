<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-left">
                        <b>Juan Dela Cruz</b>
                    </div>

                    <div class="card-body text-left">
                        Sample Post. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                    </div>

                    <div class="card-footer text-left">
                        <a href="#"><i class="far fa-thumbs-up"></i>Like</a>
                        <hr>
                        <!-- <a href="#">{{comment_list[0].text}}</a> -->
                        <!-- <ul>
                            <li v-for="(comment,id) in comment_list" :key="id">{{comment.text}}</li>
                        </ul> -->
                        <div class="comments-list" style="height:300px;overflow-y: scroll;">
                            <single-comment 
                                v-for="comment in comment_list"
                                :comment="comment"
                                :key="comment.id"
                                @clicked-show-detail="reply"
                            >                            
                            </single-comment>
                        </div>
                        

                        <div class="row">
                       
                            <div class="col-2 pr-1">
                            <input type="text" class="form-control" placeholder="Name" v-model="newCommentName">
                            </div>
                            <div class="col-8 pl-0">
                                <textarea ref="newComment" class="form-control" v-model="newComment" placeholder="Comment here" name="" id="" cols="30" rows="1"></textarea>
                                <input type="hidden" class="form-control" v-model="newParentId">
                                <input type="hidden" class="form-control" v-model="newCommentLevel">
                            </div>                                 
                            <div class="col-2">
                                <button type="button" class="btn btn-info" @click="addComment">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import singleComment from './SingleComment'
    export default {
        props: ['comments'],
         components: {
            singleComment
        },
        data(){
            return {
                newComment: '',
                newCommentName: '',
                newCommentLevel: 0,
                newParentId: 0,
                comment_list: JSON.parse(this.comments)
            }            
        },
        methods: {
            addComment(){
                // this.comment_list.push(this.newComment);
                // this.newComment = '';
                const vm = this;
                axios.post('/comments',{
                    commented_by: vm.newCommentName,
                    text: vm.newComment,
                    parent_id: vm.newParentId,
                    level: vm.newCommentLevel,
                })
                .then(function (response) {
                    vm.comment_list.push(response.data.data);
                    // vm.form.job_name = null
                    // vm.form.job_description = null
                    // vm.form.vacants = 0
                    vm.newCommentName = '';
                    vm.newComment = '';
                    vm.newParentId = '';
                    vm.newCommentLevel = 0;
                    vm.fetchComments();

                    this.newComment = '@'+ value.commented_by                
                })
                .catch(function (error) {
                    console.log(error)
                });
            },
            fetchComments(){
                axios.get('/comments/fetch')
                .then(response => {
                    // return response.data.data;
                    // console.log(response.data);
                    this.comment_list= response.data;
                    // console.log(response.data);
                    // return response.json();
                });
            },
            reply(value){
                this.newComment = '@'+ value.commented_by
                this.newParentId = value.id
                this.newCommentLevel = value.level + 1;
                // this.newComment.focus();
                this.$refs.newComment.focus()
            }
           
        },
        mounted() {
            console.log(this.comment_list)
        }
    }
</script>
