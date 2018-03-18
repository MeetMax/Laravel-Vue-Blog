<template>
    <div class="dashboard-wrap">
        <div class="common-component">
            <div class="component">
                <p class="title ion-person-stalker">用户数</p>
                <div class="count">{{data.userCount}}</div>
            </div>
        </div>
        <div class="common-component">
            <div class="component">
                <p class="title ion-eye">评论数</p>
                <div class="count">{{data.commentCount}}</div>
            </div>
        </div>
        <div class="common-component">
            <div class="component">
                <p class="title ion-ios-paper">文章数</p>
                <div class="count">{{data.articleCount}}</div>
            </div>
        </div>
        <div class="common-component">
            <div class="component">
                <p class="title ion-chatbubbles">讨论数</p>
                <div class="count">{{data.discussionCount}}</div>
            </div>
        </div>

    </div>
</template>

<script>
    import {getAll} from '../../api/index'
    export default{
        name:'home',
        data () {
            return {
                data: ''
            }
        },
        mounted(){
            getAll('/dashboard').then(data=>{
                this.data=data;
            });
        },
        methods:{

        }
    }
</script>
<style lang="scss">
   .dashboard-wrap{
       padding: 20px;
       .common-component{
           width: 25%;
            float:left;
           .component{
               width: 76.6667%;
               margin:  0 auto;
               border: 1px solid #cccccc;
               .title{
                   padding: 5px 10px;
                   font-size: 1.4rem;
               }
                .title:before{
                    margin-right: 8px;
                }
               .count{
                   padding: 20px 10px;
                   background: #EFF2F7;
                   text-align: center;
                   font-size: 1.4rem;
                   color: #505050;
               }
           }
       }
   }
   @media (max-width: 768px) {
       .dashboard-wrap{
        padding:10px;
        .common-component{
            width: 100%;
            float: none;
            .component{
                width: 100%;
                margin-bottom: 10px;
            }
        }
       }
   }
</style>
