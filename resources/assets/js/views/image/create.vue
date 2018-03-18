<template>
    <div class="upload-wrap">
        <el-upload
                class="upload-demo"
                action="/api/image"
                name="image"
                :headers="headers"
                :on-preview="handlePreview"
                :on-remove="handleRemove"
                :file-list="fileList"
                list-type="picture">
            <el-button size="small" type="primary">点击上传</el-button>
            <div slot="tip" class="el-upload__tip">只能上传jpg/png文件</div>
        </el-upload>
    </div>
</template>
<script>
    export default{
        name:'create-image',
        data(){
            return{
                fileList:[],
                csrfToken:window.Laravel.csrfToken,
                headers:{'X-CSRF-TOKEN':window.Laravel.csrfToken}
            }
        },
        mounted(){

        },
        methods:{
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePreview(file) {
                console.log(file);
            }
        }
    }
</script>
<style lang="scss">
    .upload-wrap{
        width: 66.667%;
        margin: 0 auto;
        margin-top: 20px;
    }
</style>
