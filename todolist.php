<?php 
include "msql.inc.php";
date_default_timezone_set("Asia/Shanghai");
$updatatime = date('Y')."/".date('m')."/".date('d')."-".date("h:i:sa");
// 如果送出表單中有資料
if(!empty($_POST['todo'])){
    // 將代辦事項新增至 todolist 資料表
    $sql = "insert 代辦事項(代辦事項,進度,開始時間)
            values('{$_POST['todo']}','0','$updatatime')
            ";
    if(!mysqli_query($conn,$sql)) echo"送出失敗";
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <!-- 導入bs4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <!-- 導入Vue -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <title>todolist</title>
</head>
<body>
    <div id="app" class="container my-3">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">待辦事項</span>
            </div>
            <input type="text" class="form-control" placeholder="準備要做的任務" v-model="newtodo" @keyup.enter="add">
            <div class="input-group-append">
            <button class="btn btn-primary" type="button" @click="add">新增</button>
            </div>
        </div>
        <div class="card text-center">
            <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                <a class="nav-link" :class="{'active':type=='all'}" @click="type='all'" href="#">全部</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " :class="{'active':type=='active'}" @click="type='active'" href="#">進行中</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" :class="{'active':type=='done'}" @click="type='done'"  href="#">已完成</a>
                </li>
            </ul>
            </div>
            <ul class="list-group list-group-flush text-left">
            <li class="list-group-item" v-for="item in Filteredtodos"  @dblclick="change(item)">
                <div class="d-flex" v-if="item.id!==cachetodo.id">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" :id="item.id" v-model="item.completed">
                    <label class="form-check-label" :for="item.id" 
                        :class="{'completed':item.completed}">
                    {{item.title}}
                    </label>
                </div>
                <button type="button" class="close ml-auto" aria-label="Close" @click="del(item)">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <input type="text" class="form-control" v-model="cachetitle" v-if= "item.id === cachetodo.id" 
                        @keyup.esc="cancel" @keyup.enter="done(item)">
            </li>
        <!--       <li class="list-group-item">
                <input type="text" class="form-control">
            </li> -->
            </ul>
            <div class="card-footer d-flex justify-content-between">
            <span>還有 {{activetodos}} 筆任務未完成</span>
            <a href="#" @click="delall">清除所有任務</a>
            </div>
        </div>
        </div>
</body>
<script>
    var app = new Vue ({
        el:'#app',
        data:{
            newtodo:'',
            todos:[
            <?php
                $sql = "select * from 代辦事項 order by 開始時間 DESC ";
                $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    echo "{
                        id:'{$row['開始時間']}',
                        title:'{$row['代辦事項']}',
                        completed:{$row['進度']}
                        },";
                }
            };
            
            ?>
            ],

            // todos:[{
            // id:'test',
            // title:'test',
            // completed:false
            // },{
            // id:'test2',
            // title:'test2',
            // completed:false
            // },],

            type:'all',
            cachetitle:'',
            cachetodo:{}
        },
        methods:{
            add:function(){
            var val = this.newtodo.trim();
            var timestrap = Math.floor(Date.now());
            if(!val)return;
            this.todos.push({
                id:timestrap,
                title:val,
                completed:false
            })
            this.newtodo = ''
            },
            delall:function(){
            this.todos=[];
            },
            del:function(todos){
            var newindex = this.todos.findIndex(function(item){
                return item.id === todos.id
            })
            this.todos.splice(newindex,1)
            },
            change(item){
            this.cachetodo = item;
            this.cachetitle = item.title;
            },
            cancel(){
            this.cachetodo = {}
            },
            done(item){
            item.title = this.cachetitle;
            this.cachetodo = {};
            this.cachetitle = '';
            }
        },
        computed:{
            Filteredtodos:function(){
            if(this.type == 'all'){
                return this.todos;
            }else if(this.type == 'active'){
                var newtodos =[];
                this.todos.forEach(function(item){
                if(!item.completed){
                newtodos.push(item)
                }
                })
                return newtodos;
            }else if(this.type == 'done'){
                var newtodos =[];
                this.todos.forEach(function(item){
                if(item.completed){
                newtodos.push(item)
                }
                })
                return newtodos;
            }
            },
            activetodos:function(){
            var activetodos =[];
            this.todos.forEach(function(item){
                if(!item.completed){
                activetodos.push(item)
                }
            })
            return activetodos.length
            },
        },
    })
</script>
<style>
.completed {
    text-decoration: line-through
}
</style>
</html>