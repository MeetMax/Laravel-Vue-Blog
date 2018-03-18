<template>
    <div class="create-article-wrap">
        <div class="common-wrap clearfix">
            <p>标签</p>
            <el-select v-model="tag_value" multiple placeholder="请选择">
                <el-option v-for="item in tag_options" :label="item.tag_name" :value="item.id">
                </el-option>
            </el-select>
        </div>
        <div class="common-wrap clearfix">
            <p>标题</p>
            <div class="common-r">
                <el-input v-model="title" placeholder="请输入标题"></el-input>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p>描述</p>
            <div class="common-r">
                <el-input v-model="description" placeholder="请输入描述"></el-input>
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
    import {getAll,create,showMessage} from '../../api/index'
    export default{
        name:'create-discussion',
        data(){
            return{
                tag_options:[],
                tag_value:[],
                title:'',
                description:'',
                status:true
            }
        },
        mounted(){
            this.simplemde=new SimpleMDE({
                element: document.getElementById("editor"),
                placeholder: 'Please input the article content.',
                autoDownloadFontAwesome: true
            });
            getAll('/tag').then((data)=>{
                this.tag_options=data
            })
        },
        methods:{
            submit(){
                let status=1;
                if(this.status==false){
                    status=0
                }
                let data={
                    title:this.title,
                    description:this.description,
                    raw_content:this.simplemde.value(),
                    tags:this.tag_value,
                    user_id:window.User.id,
                    status:status,

                };
                create('/discussion',data).then((data)=>{
                    showMessage(data,this.$message);
                });
            }

        },

    }
</script>
