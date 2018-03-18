<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        {{msg}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name:'example',
    data () {
        return {
            msg: '哈哈'
        }
    },
    mounted(){
        axios.get('/api/test').then(response => {
            this.msg=response.data[0].tag_name;
        })
    },
    methods:{
        bb(){
           this.msg='hehe';
        }
    }
}
</script>
