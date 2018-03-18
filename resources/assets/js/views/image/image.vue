<template>
    <div class="table-wrap">
        <div class="title-wrap clearfix">
            <p>图片列表</p>
            <router-link to="create-image">
                <el-button type="primary" class="create-btn">上传<i class="el-icon-upload el-icon--right"></i></el-button>
            </router-link>
        </div>
        <el-table
                :data="data"
                border style="width: 100%"
                v-loading="loading"
                element-loading-text="拼命加载中">
            <el-table-column label="ID" width="100">
                <template scope="scope">
                    <span>{{scope.row.id}}</span>
                </template>
            </el-table-column>
            <el-table-column label="上传日期" width="200">
                <template scope="scope">
                    <span>{{scope.row.created_at}}</span>
                </template>
            </el-table-column>
            <el-table-column label="图片url"  width="350">
                <template scope="scope">
                    <span>http://{{host}}/storage/{{scope.row.raw_image_name}}</span>
                </template>
            </el-table-column>
            <el-table-column label="图片名字"  width="300">
                <template scope="scope">
                    <span>{{scope.row.original_name}}</span>
                </template>
            </el-table-column>
            <el-table-column label="操作">
                <template scope="scope">
                    <el-button size="small" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                    <a :href="'http://'+host+'/storage/'+scope.row.raw_image_name" target="_blank">
                        <el-button type="primary"  size="small">查看</el-button>
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
    import {deleteById,getAll,showMessage} from '../../api/index'
    export default{
        name:'image',
        data(){
            return{
                data: [],
                count:0,
                pageSize:20,
                currentPage:1,
                loading:true,
                host:window.location.host,
            }
        },
        mounted(){
            let data={
                pageSize:this.pageSize,
                currentPage:this.currentPage,
            }
            getAll('/image',data).then((data)=>{
                this.data=data.pageList;
                this.count=data.count;
                this.loading=false;
            });
        },
        methods:{
            handleDelete(index, row) {
                deleteById('/image',row.id).then(data=>{
                    showMessage(data,this.$message);
                });
            },
            Page(currentPage){
                this.loading=true;
                let data={
                    pageSize:this.pageSize,
                    currentPage:currentPage,
                };
                getAll('/image',data).then((data)=>{
                    this.data=data.pageList;
                    this.count=data.count;
                    this.loading=false;
                });
            }
        }
    }
</script>