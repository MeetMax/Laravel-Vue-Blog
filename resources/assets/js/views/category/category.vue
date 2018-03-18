<template>
    <div class="table-wrap">
        <div class="title-wrap clearfix">
            <p>分类列表</p>
            <router-link :to="{name:'create-category'}">
                <el-button type="primary" icon="edit" class="create-btn">创建分类</el-button>
            </router-link>
        </div>
        <el-table
                :data="data"
                border style="width: 100%"
                v-loading="loading"
                element-loading-text="拼命加载中">
            <el-table-column label="#ID" width="100">
                <template scope="scope">
                    <span style="margin-left: 10px">{{scope.row.id}}</span>
                </template>
            </el-table-column>
            <el-table-column label="更新日期" width="200">
                <template scope="scope">
                    <span style="margin-left: 10px">{{scope.row.updated_at}}</span>
                </template>
            </el-table-column>
            <el-table-column label="分类名称" width="200">
                <template scope="scope">
                    <span style="margin-left: 10px">{{scope.row.category_name}}</span>
                </template>
            </el-table-column>
            <el-table-column label="操作">
                <template scope="scope">
                    <router-link :to="{'name':'edit-category',params:{id:scope.row.id}}">
                        <el-button size="small" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                    </router-link>
                    <el-button size="small" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>
<script>
    import {deleteById,getAll,showMessage} from '../../api/index'
    export default {
        name:'category',
        data() {
            return {
                data: [],
                count:0,
                loading:true,
            }
        },
        mounted(){
           getAll('/category').then((data)=>{
               this.data=data;
               this.loading=false;
           })

        },
        methods: {
            handleDelete(index, row) {
                console.log(index, row);
                deleteById('/category',row.id).then(data=>{
                    showMessage(data,this.$message);
                });
            },
        }
    }
</script>
