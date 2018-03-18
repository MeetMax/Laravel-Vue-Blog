<template>
    <div class="input-wrap">
        <div class="common-w clearfix">
            <p>标签名称</p>
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
    import {create,showMessage} from '../../api/index'
    export default{
        name:'create-tag',
        data(){
            return{
                tag_name:''
            }
        },
        methods:{
            submit(){
                let data={
                    tag_name:this.tag_name
                };
                create('/tag',data).then((data)=>{
                    showMessage(data,this.$message);
                })
            }
        },

    }
</script>