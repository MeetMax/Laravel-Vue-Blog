<template>
    <div class="create-article-wrap">
        <div class="common-wrap clearfix">
            <p>分类</p>
            <el-select v-model="category_value" placeholder="请选择">
                <el-option v-for="item in category_options" :label="item.category_name" :value="item.id">

                </el-option>
            </el-select>
        </div>
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
                <el-input v-model="description" placeholder="请输入文章描述"></el-input>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p>内容</p>
            <div class="common-r">
                <textarea id="editor"></textarea>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p>是否原创</p>
            <div class="common-r">
                <el-switch v-model="is_original" on-text="" off-text="" class="switch">
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
    import {show,getAll,update,showMessage} from '../../api/index'
    export default{
        name:'edit-article',
        data(){
            return{
                category_options: [],
                category_value: '',
                tag_options:[],
                tag_value:[],
                title:'',
                description:'',
                is_original:''
            }
        },
        components:{
            getAll,show,update
        },
        mounted(){
            this.simplemde=new SimpleMDE({
                element: document.getElementById("editor"),
                placeholder: 'Please input the article content.',
                autoDownloadFontAwesome: true
            })
            let id= this.$route.params.id;
            show('/article',id).then((data)=>{
                this.is_original=true;
                if(data.is_original==0)
                {
                    this.is_original=false
                }
                this.title=data.title;
                this.category_value=data.category_id;
                this.description=data.description;
                this.simplemde.value(data.raw_content);
                this.tag_value=data.tags_id;
            });
            getAll('/category').then((data)=>{
                this.category_options=data
            });
            getAll('/tag').then((data)=>{
                this.tag_options=data
            });
        },
        methods:{
            submit(){
                let is_original=1;
                if(this.is_original==false)
                    is_original=0
                let data={
                    title:this.title,
                    description:this.description,
                    raw_content:this.simplemde.value(),
                    tags:this.tag_value,
                    category_id:this.category_value,
                    user_id:window.User.id,
                    is_original:is_original,

                };
                update('/article',this.$route.params.id,data).then((data)=>{
                    showMessage(data,this.$message);

                })
            },
        },

    }
</script>
<style lang="scss">
    @import "../../simplemde/simplemde.min.css";
    .create-article-wrap{
        width:90%;
        margin:0 auto;
        padding-bottom:30px;
    .common-wrap{
        margin-top:20px;
    p{
        float: left;
        width: 10%;
        text-align: right;
        line-height: 36px;
        padding-right: 20px;
        height: 36px;
    }
    .common-r{
        float: left;
        width: 70%;
    .switch{
        margin-top: 7px;
    }
    }
    }
    }
    .CodeMirror-fullscreen{
        z-index: 1000;
    }
</style>