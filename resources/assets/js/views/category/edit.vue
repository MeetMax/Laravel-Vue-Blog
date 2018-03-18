<template>
    <div class="input-wrap">
        <div class="common-w clearfix">
            <p>分类名称</p>
            <div class="common-r">
                <el-input v-model="category_name" placeholder="请输入内容"></el-input>
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
        name:'edit-category',
        data(){
            return{
                category_name:''
            }
        },
        mounted(){
            show('/category',this.$route.params.id).then(data=>{
                this.category_name=data.category_name
            })
        },
        methods:{
            submit(){
                let data={
                    category_name:this.category_name
                }
                update('/category',this.$route.params.id,data).then((data)=>{
                    showMessage(data,this.$message);
                })
            }
        },

    }
</script>
<style lang="scss">
    .input-wrap{
        width: 100%;
        padding: 20px;
    .common-w {
        width: 100%;
        margin-top:15px;
    p {
        float: left;
        width: 15%;
        text-align: right;
        line-height: 36px;
        height: 36px;
        padding-right: 20px;
    }

    .common-r {
        float: left;
        width: 50%;
    }
    }
    }
</style>