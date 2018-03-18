<template>
    <div class="create-article-wrap">
        <div class="common-wrap clearfix">
            <p>用户名</p>
            <div class="common-r">
                <el-input v-model="username" placeholder="请输入用户名" maxlength="16"></el-input>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p>邮箱</p>
            <div class="common-r">
                <el-input v-model="email" placeholder="请输入邮箱"></el-input>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p>密码</p>
            <div class="common-r">
                <el-input v-model="password" placeholder="密码长度必须大于6位" type="password"></el-input>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p>确认密码</p>
            <div class="common-r">
                <el-input v-model="password_confirmation" placeholder="请再次输入密码" type="password" ></el-input>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p>管理员</p>
            <div class="common-r">
                <el-switch
                        v-model="is_admin"
                        on-color="#13ce66"
                        off-color="#ff4949"
                        on-text="是"
                        off-text="否"
                        class="switch">
                </el-switch>
            </div>
        </div>
        <div class="common-wrap clearfix">
            <p>状态</p>
            <div class="common-r">
                <el-switch
                        v-model="status"
                        on-color="#13ce66"
                        off-color="#ff4949"
                        on-text="正常"
                        off-text="禁用"
                        class="switch">
                </el-switch>
            </div>
        </div>
        <div class="common-wrap clearfix">
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
        name:'create-user',
        data(){
            return{
                email:'',
                category_value: '',
                username:'',
                title:'',
                password:'',
                password_confirmation:'',
                is_admin:false,
                status:true
            }
        },

        methods:{
            submit(){
                let is_admin=0;
                if(this.is_admin==true){
                    is_admin=1
                }
                let status=1;
                if(this.status==false){
                    status=0;
                }
                let data={
                    name:this.username,
                    email:this.email,
                    password:this.password,
                    password_confirmation:this.password_confirmation,
                    is_admin:this.is_admin,
                    status:this.status,
                };
                if(this.password==this.password_confirmation)
                {
                    create('/user',data).then(data=>{
                        showMessage(data,this.$message)
                    });
                }else {
                    this.$message({
                        showClose: true,
                        message: '两次密码不一致',
                        type: 'error'
                    });
                }

            },
        },

    }
</script>