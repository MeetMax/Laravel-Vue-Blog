<template>
    <div class="table-wrap">
        <div class="title-wrap clearfix">
            <p>评论列表</p>
            <router-link to="create-comment">
                <el-button type="primary" icon="edit" class="create-btn">创建评论</el-button>
            </router-link>
        </div>
        <el-table
                :data="data"
                border style="width: 100%"
                v-loading="loading"
                element-loading-text="拼命加载中">
            <el-table-column label="ID" width="80">
                <template scope="scope">
                    <span >{{scope.row.id}}</span>
                </template>
            </el-table-column>
            <el-table-column label="日期" width="200">
                <template scope="scope">
                    <span>{{scope.row.created_at}}</span>
                </template>
            </el-table-column>
            <el-table-column label="作者" width="100" show-overflow-tooltip>
                <template scope="scope">
                    <span>{{scope.row.user.name}}</span>
                </template>
            </el-table-column>
            <el-table-column label="内容" show-overflow-tooltip>
                <template scope="scope">
                    <span>{{scope.row.raw_content}}</span>
                </template>
            </el-table-column>
            <el-table-column label="分类" width="120">
                <template scope="scope">
                    <span >{{scope.row.commentable_type}}</span>
                </template>
            </el-table-column>
            <el-table-column label="状态" width="120">
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
            <el-table-column label="操作"  width="160">
                <template scope="scope">
                    <router-link :to="{'name':'edit-comment',params:{id:scope.row.id}}">
                        <el-button size="small">编辑</el-button>
                    </router-link>
                    <el-button size="small" type="danger" @click="handleDelete(scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="block">
            <el-pagination layout="prev, pager, next" :total="count" :page-size="20"  @current-change="Page"></el-pagination>
        </div>
    </div>
</template>
<script>
    import {deleteById,getAll,update,showMessage} from '../../api/index'
    export default {
        name:'comment',
        data() {
            return {
                data:[],
                pageSize:20,
                currentPage:1,
                count:0,
                loading:true
            }
        },
        mounted(){
            this.getList(this.currentPage);
        },
        methods: {
            getList(currentPage){
                let pageData={
                    pageSize:this.pageSize,
                    currentPage:currentPage
                };
                getAll('/comment',pageData).then((data)=>{
                    this.count=data.count;
                    for(var x of data.pageList){
                        if(x.status){
                            x.status=true;
                        }else {
                            x.status=false;
                        }
                    }
                    this.data=data.pageList;
                    this.loading=false;
                });
            },
            updateComment(updateData,id){
                update('/comment',id,updateData).then(data=>{
                    showMessage(data,this.$message);
                })
            },
            handleDelete(row) {
                deleteById('/comment',row.id).then(data=>{
                    showMessage(data,this.$message);
                });
            },
            switchChange(row){
                let data={
                    status:row.status
                };
                this.updateComment(data,row.id);

            },
            Page(currentPage){
                this.getList(currentPage);
            }
        }
    }
</script>
