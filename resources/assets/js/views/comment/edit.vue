<template>
    <div class="create-article-wrap">
        <div class="common-wrap clearfix">
            <p>评论类型</p>
            <div class="common-r">
                <el-input
                        placeholder="请输入内容"
                        v-model="data.commentable_type"
                        :disabled="true">
                </el-input>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p>内容</p>
            <div class="common-r">
                <textarea id="editor"></textarea>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p>状态</p>
            <div class="common-r">
                <el-switch
                        v-model="status"
                        on-color="#13ce66"
                        on-text="正常"
                        off-text="禁用"
                        off-color="#ff4949" class="switch">
                </el-switch>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p></p>
            <div class="common-r">
                <el-button type="primary" @click="submit">发布</el-button>
            </div>
        </div>

    </div>
</template>
<script>
    import SimpleMDE from 'simplemde';
    import {update,showMessage,show} from '../../api/index'
    export default{
        name:'edit-comment',
        data(){
            return{
                data:'',
                status:true,
            }
        },
        mounted(){
            this.simplemde=new SimpleMDE({
                element: document.getElementById("editor"),
                placeholder: 'Please input the article content.',
                autoDownloadFontAwesome: true
            });
            show('/comment',this.$route.params.id).then(data=>{
                this.data=data;
                this.simplemde.value(data.raw_content)
                if(data.status===0){
                    this.status=false;
                }
            });
        },
        methods:{
            submit(){
                let status=1;
                if(this.status==false){
                    status=0
                }
                let data={
                    raw_content:this.simplemde.value(),
                    status:status,
                };
                if(this.data.commentable_type=='articles'){
                    update('/comment',this.$route.params.id,data).then((data)=>{
                        showMessage(data,this.$message);
                    });
                }else{
                    update('/comment',this.$route.params.id,data).then((data)=>{
                        showMessage(data,this.$message);
                    });
                }

            },
            typeChange(){
                this.commentable='';
                if(this.type_value=='articles'){
                    getAll('/all-article').then(data=>{
                        this.commentable_options=data;
                    })
                }else {
                    getAll('/all-discussion').then(data=>{
                        this.commentable_options=data;
                    })
                }
            }

        },

    }
</script>
