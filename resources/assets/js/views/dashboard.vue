<template>
    <div id="wrapper" class="clearfix" :class="show">
        <div class="side-bar-wrap">
            <div class="side-bar-wrap">
                <div class="head-img">
                    <img src="https://blog.meetmax.xyz/storage/3HpKtfHJ9Uv9LDSGrWqI2EowYvuqq0iljWZkrlaH.jpeg">
                </div>
                <p class="user-name">{{user.name}}</p>
                <p class="user-email">{{user.email}}</p>
                <p class="home"><a href="/"><i class="ion-home"></i>首页</a></p>
                <div class="el-bar-wrap clearfix">
                    <el-col :span="24">
                        <el-menu class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" theme="dark">
                            <router-link :to="{name:'home'}">
                                <el-menu-item index="1">
                                    <i class="ion-android-home"></i>面板
                                </el-menu-item>
                            </router-link>
                            <router-link :to="{name:'article'}">
                                <el-menu-item index="2"><i class="ion-document-text"></i>文章管理</el-menu-item>
                            </router-link>
                            <router-link :to="{name:'comment'}">
                                <el-menu-item index="3"><i class="ion-ios-chatbubble"></i>评论管理</el-menu-item>
                            </router-link>
                            <router-link :to="{name:'user'}">
                                <el-menu-item index="4"><i class="ion-person-stalker"></i>用户管理</el-menu-item>
                            </router-link>
                            <router-link :to="{name:'discussion'}">
                                <el-menu-item index="5"><i class="ion-chatbubbles"></i>讨论管理</el-menu-item>
                            </router-link>
                            <router-link :to="{name:'category'}">
                                <el-menu-item index="6"><i class="ion-grid"></i>分类管理</el-menu-item>
                            </router-link>
                            <router-link :to="{name:'tag'}">
                                <el-menu-item index="7"><i class="ion-ios-pricetags"></i>标签管理</el-menu-item>
                            </router-link>
                            <router-link :to="{name:'image'}">
                                <el-menu-item index="8"><i class="ion-image"></i>图片管理</el-menu-item>
                            </router-link>
                        </el-menu>
                    </el-col>
                </div>
            </div>
        </div>
        <div class="nav-bar-wrap">
            <nav><i class="ion-navicon" @click="showBar"></i></nav>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                user:window.User,
                show:'show',
            }
        },
        methods:{
            handleOpen(key, keyPath) {
                console.log(key, keyPath);
            },
            handleClose(key, keyPath) {
                console.log(key, keyPath);
            },
            showBar(){
                if(this.show=='show'){
                    this.show='hide';
                }else {
                    this.show='show';
                }
            }
        }
    }
</script>
<style lang="scss">
    $transition:all 0.3s ease-in-out;
    #app{
        height:100%;
        #wrapper{
            padding-left: 250px;
            height:100%;
            transition: all 0.3s ease;
            .nav-bar-wrap{
                position: relative;
                min-height: 100%;
                width: 100%;
                background:#fff;
                z-index:100;
                nav{
                    height: 50px;
                    width: 100%;
                    background: #EFF2F7;
                    i{
                        font-size: 2.5rem;
                        line-height: 50px;
                        margin-left: 15px;
                        color: #555555;
                        cursor: pointer;
                    }
                }
            }
            .side-bar-wrap{
                position: fixed;
                left: 0px;
                min-height: 100%;
                background: #324057;
                z-index: 10;
                width: 250px;
                .el-bar-wrap{
                    overflow: auto;
                }
                .head-img{
                    width: 70px;
                    height: 70px;
                    background: #fff;
                    border-radius: 50%;
                    margin: 0 auto;
                    margin-top: 30px;
                    overflow:hidden;
                    img{
                        width: 100%;
                    }
                }
                .user-name{
                    text-align: center;
                    color: #EEEEEE;
                    margin-top: 5px;
                }
                .home{
                    text-align: center;
                    margin-top:10px;
                    a{
                        color: #ffffff;
                        i{
                            font-size: 1.2rem;
                        }
                    }
                    a:hover{
                        color: #20a0ff;;
                    }

                }
                .user-email{
                    text-align: center;
                    color: #EEEEEE;
                    margin-top: 5px;
                }
                .el-bar-wrap{
                    margin-top: 30px;
                    li i{
                        font-size: 1.4rem;
                        margin-right: 8px;
                    }
                }
            }
        }
        #wrapper.show{
            padding-left: 250px;
        }
        #wrapper.hide{
            padding-left: 0px;
        }
        @media (max-width: 768px) {
            #wrapper.show{
                padding-left: 40%;
                .side-bar-wrap{
                    z-index: 0;
                    width: 40%;
                    overflow: auto;
                    .el-bar-wrap{
                        margin-top: 0;
                        .el-menu-item{
                            height: 40px;
                            line-height: 40px;
                        }
                    }

                }
            }
            #wrapper.hide{
                padding-left: 0px;
            }
        }
    }
    a.router-link-active .el-menu-item{
        color: #20a0ff;
    }

</style>