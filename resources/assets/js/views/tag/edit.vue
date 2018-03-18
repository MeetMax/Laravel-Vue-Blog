<template>
    <div class="input-wrap">
        <div class="common-w clearfix">
            <p>分类名称</p>
            <div class="common-r">
                <el-input v-model="tag_name" placeholder="请输入内容"></el-input>
            </div>
        </div>
        <div class="common-w clearfix">
            <p></p>
            <div class="common-r">
                <el-button type="primary" @click="submit">提交</el-button>
            </div>
        </div>
    </div>
</template>
<script>
    import {update,show,showMessage} from '../../api/index'
    export default{
        name:'edit-tag',
        data(){
            return{
                tag_name:''
            }
        },
        mounted(){
            show('/tag',this.$route.params.id).then(data=>{
                this.tag_name=data.tag_name
            })
        },
        methods:{
            submit(){
                let data={
                    tag_name:this.tag_name
                }
                update('/tag',this.$route.params.id,data).then((data)=>{
                    showMessage(data,this.$message);
                });
            }
        },

    }
</script>