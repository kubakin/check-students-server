<?php
use yii\helpers\Html;
?>
        <?php

echo $model;
?>
!<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Document</title>
    <script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js'></script>
    <style>
        .hi {
            background: red;
            width: 100px;
            height: 100px;
            visibility: visible;
        }
        #block{
            display: grid;
            background: grey;
            width: 300px;
            height: 300px;
            margin: auto;
            justify-content: center;
            border: 2px solid green;
            
        }
        #block input {
            margin-top: 10px;
            margin-bottom: 10px;
            height: 30px;
        }
        #block div {
            display: block;
            margin-left: 15%;
            justify-content: center;
            grid-row-gap: 0px;
            
            
        }
        #block a {
            padding: 10px;
            display: block;
            margin: auto;
            background: green;
            color: black;
        }
       
    </style>
</head>
    <body>
        <div id='app'> 
            <div id='centerr'>
        <div id="block">
            <div>
                <p>predmet</p>
        <input v-model='predmetSelected' list="predmet-list">

            <datalist id="predmet-list">
        <option v-for='predmet in predmets'>{{predmet.name}}</option>
        </datalist>
        <p>
            group
        </p>
        <input v-model='groupSelected' list="group-list">

            <datalist id="group-list">
        <option v-for='group in groups'>{{group.num}}</option>


       
 </datalist>
 </div>
 <a v-bind:href="linkTo">Посмотреть посещаемость</a>
 </div>
        </div>
        </div>
    </body>
    <script>
        var app = new Vue({
            el:'#app',
            data:{
                predmets: '',
                groups: '',
                predmetSelected: '',
                groupSelected:''
            },
            created() { 
                var url = "<?php echo $model;?>";
            axios.get(url+`/predmet/`)
                .then(response => (this.predmets = response.data))
                    axios.get(url+`/group/`)
                .then(response => (this.groups = response.data))
              //  document.location.href='http://stackoverflow.com'
            },
            
            methods:{
            },
           
            
            computed:{
                
                linkTo: function() {
                    var url = "<?php echo $model;?>";
                    return url+'/site/test'+'/'+this.predmetSelected+'/'+this.groupSelected
                }
            }
            })
            
    </script>
    
</html>