<template>
   <div class="table-wrap">
       <div class="title-wrap clearfix">
           <p>文章列表</p>
           <router-link to="create-article">
               <el-button type="primary" icon="edit" class="create-btn">创建文章</el-button>
           </router-link>
       </div>
        <el-table
                :data="data"
                border style="width: 100%"
                v-loading="loading"
                element-loading-text="拼命加载中">
            <el-table-column label="#ID" width="100">
                <template scope="scope">
                    <span>{{scope.row.id}}</span>
                </template>
            </el-table-column>
            <el-table-column label="发布日期" width="200">
                <template scope="scope">
                    <span>{{scope.row.created_at}}</span>
                </template>
            </el-table-column>
            <el-table-column label="标题" width="250">
                <template scope="scope">
                    <span>{{scope.row.title}}</span>
                </template>
            </el-table-column>
            <el-table-column label="描述" show-overflow-tooltip>
                <template scope="scope">
                    <span>{{scope.row.description}}</span>
                </template>
            </el-table-column>
            <el-table-column label="状态" width="120" show-overflow-tooltip>
                <template scope="scope">
                    <el-switch
                            v-model="scope.row.status"
                            on-color="#13ce66"
                            on-text="正常"
                            off-text="禁用"
                            off-color="#ff4949"
                            @change="switchChange(scope.row)">
                    </el-switch>
                </template>
            </el-table-column>
            <el-table-column label="操作" width="200">
                <template scope="scope">
                    <router-link :to="{'name':'edit-article',params:{id:scope.row.id}}">
                        <el-button size="small">编辑</el-button>
                    </router-link>
                    <el-button size="small" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                    <a :href="'http://'+host+'/article/'+scope.row.id" target="_blank">
                        <el-button size="small" type="primary" >查看</el-button>
                    </a>
                </template>
            </el-table-column>
        </el-table>
       <div class="block">
           <el-pagination layout="prev, pager, next" :total="count" :page-size="pageSize"  @current-change="Page"></el-pagination>
       </div>
   </div>
</template>
<script>
    import {deleteById,getAll,showMessage,update} from '../../api/index'
    export default {
        name:'article',
        data() {
            return {
                data: [],
                count:0,
                pageSize:20,
                currentPage:1,
                loading:true,
                host:window.location.host
            }
        },
        components:{
            deleteById,getAll
        },
        mounted(){
            let data={
                pageSize:this.pageSize,
                currentPage:this.currentPage,
            }
            getAll('/article',data).then((data)=>{
              this.data=data.pageList;
              this.count=data.count;
                for(var x of data.pageList){
                    if(x.status){
                        x.status=true;
                    }else {
                        x.status=false;
                    }
                }
              this.loading=false;
          });
        },
        methods: {
            handleDelete(index, row) {

                deleteById('/article',row.id).then(data=>{
                    showMessage(data,this.$message);
                });
            },
            Page(currentPage){
                this.loading=true;
                let data={
                    pageSize:this.pageSize,
                    currentPage:currentPage,
                };
                getAll('/article',data).then((data)=>{
                    this.data=data.pageList;
                    this.count=data.count;
                    this.loading=false;
                });
            },
            switchChange(row){
                let status=0;
                if(row.status){
                    status=1;
                }
                let data={
                    category_id:row.category_id,
                    description:row.description,
                    is_original:row.is_original,
                    raw_content:row.raw_content,
                    title:row.title,
                    user_id:row.user_id,
                    status:status
                };
                update('/article',row.id,data).then(data=>{
                    showMessage(data,this.$message);
                })
            },
        }
    }
</script>
<style lang="scss">
.table-wrap{
    .title-wrap{
        margin-right: 10px;
        padding:5px 10px;
        .create-btn{
            float: right;
        }
        p{
            float: left;
            font-size: 1.4rem;
            color: #555555;
            line-height: 36px;
        }
    }
    .el-pagination{
        text-align: center;
    }
    .block{
        padding: 20px 0;
    }
}
</style>