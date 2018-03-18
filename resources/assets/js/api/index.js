const host='/api'
export function deleteById(url,id) {
    return new Promise((resolve,result)=>{
        axios({
            method: 'delete',
            url: host+url+`/${id}`,
        }).then(function (response) {
            resolve(response.data)
        })
    })
}
export function getAll(url,data=null) {
    return new Promise((resolve,result)=>{
        axios({
            method: 'get',
            url: host+url,
            params:data
        }).then(function (response) {
            resolve(response.data)
        })
    })
}
export function create(url,data) {
    return new Promise((resolve,result)=>{
        axios({
            method: 'post',
            url: host+url,
            data:data
        }).then(function (response) {
            resolve(response.data)
        })
    })
}
export function show(url,id) {
    return new Promise((resolve,result)=>{
        axios({
            method: 'get',
            url: host+url+`/${id}`,
        }).then(function (response) {
            resolve(response.data)
        })
    })
}
export function update(url,id,data) {
    return new Promise((resolve,result)=>{
        axios({
            method: 'put',
            url: host+url+`/${id}`,
            data:data
        }).then(function (response) {
            resolve(response.data)
        })
    })
}
export function showMessage(data,msgObj) {
    if(data.code===0)
    {
        msgObj({
            showClose: true,
            message: data.msg,
            type:'success'
        });
    }else {
        msgObj({
            showClose: true,
            message: data.msg,
            type: 'error'
        });
    }
}