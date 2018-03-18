<template>
    <div class="table-wrap">
        <div class="title-wrap clearfix">
            <p>用户列表</p>
            <router-link :to="{name:'create-user'}">
                <el-button type="primary" icon="edit" class="create-btn">创建用户</el-button>
            </router-link>
        </div>
        <el-table :data="data"
                  border
                  style="width: 100%"
                  v-loading="loading"
                  element-loading-text="拼命加载中">
            <el-table-column label="ID" width="100">
                <template scope="scope">
                    <span>{{scope.row.id}}</span>
                </template>
            </el-table-column>
            <el-table-column label="注册日期" width="200">
                <template scope="scope">
                    <span>{{scope.row.created_at}}</span>
                </template>
            </el-table-column>
            <el-table-column label="用户名" show-overflow-tooltip>
                <template scope="scope">
                    <span>{{scope.row.name}}</span>
                </template>
            </el-table-column>
            <el-table-column label="邮箱" show-overflow-tooltip>
                <template scope="scope">
                    <span>{{scope.row.email}}</span>
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
            <el-table-column label="管理员" width="120">
                <template scope="scope">
                    <el-switch
                            v-model="scope.row.is_admin"
                            on-color="#13ce66"
                            on-text="是"
                            off-text="否"
                            @change="switchAdmin(scope.row)">
                    </el-switch>
                </template>
            </el-table-column>
            <el-table-column label="操作" width="150">
                <template scope="scope">
                    <router-link :to="{'name':'edit-user',params:{id:scope.row.id}}">
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
        name:'user',
        data() {
            return {
                data:[],
                pageSize:20,
                currentPage:1,
                count:0,
                loading:true,
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
                getAll('/user',pageData).then((data)=>{
                    this.count=data.count;
                    for(var x of data.pageList){
                        if(x.is_admin){
                            x.is_admin=true;
                        }else {
                            x.is_admin=false;
                        }
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
            updateUser(updateData,id){
                update('/user',id,updateData).then(data=>{
                    showMessage(data,this.$message);
                })
            },
            handleDelete(row) {
                deleteById('/user',row.id).then(data=>{
                    showMessage(data,this.$message);
                });
            },
            switchChange(row){
                let data={
                    status:row.status
                };
                this.updateUser(data,row.id);
            },
            switchAdmin(row){
                let is_admin=0;
                if(row.is_admin){
                    is_admin=1
                }
                let data={
                    is_admin:is_admin
                };
                console.log(row.id);
                this.updateUser(data,row.id);
            },
            Page(currentPage){
                this.getList(currentPage);
            }
        }
    }
</script>
