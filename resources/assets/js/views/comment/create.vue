<template>
    <div class="create-article-wrap">
        <div class="common-wrap clearfix">
            <p>评论类型</p>
            <el-select v-model="type_value" placeholder="请选择" @change="typeChange">
                <el-option v-for="item in table_options"  :label="item.name" :value="item.value">
                </el-option>
            </el-select>
        </div>
        <div class="common-wrap clearfix">
            <p>标题</p>
            <el-select v-model="commentable" placeholder="请选择">
                <el-option v-for="item in commentable_options"  :label="item.title" :value="item.id">
                </el-option>
            </el-select>
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
    import {getAll,create,showMessage} from '../../api/index'
    export default{
        name:'create-comment',
        data(){
            return{
                type_value:'',
                table_options:[],
                status:true,
                commentable:'',
                commentable_options:[]
            }
        },
        mounted(){
            this.simplemde=new SimpleMDE({
                element: document.getElementById("editor"),
                placeholder: 'Please input the article content.',
                autoDownloadFontAwesome: true
            });
            getAll('/table-type').then((data)=>{
                this.table_options=data;
            })
        },
        methods:{
            submit(){
                let status=1;
                if(this.status==false){
                    status=0
                }
                let data={
                    able_id:this.commentable,
                    raw_content:this.simplemde.value(),
                    user_id:window.User.id,
                    status:status,
                };
                if(this.type_value=='articles'){
                    create('/ca-comment',data).then((data)=>{
                        showMessage(data,this.$message);
                    });
                }else{
                    create('/cd-comment',data).then((data)=>{
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
