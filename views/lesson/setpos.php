<?php
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ;

$url = explode('?', $url);

$url = $url[0];

 echo $model;

//echo $url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Document</title>
    <script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js'></script>
    <style>
        .qwe {
            display: table-cell;
            border: 1px black solid;
            display: 500px;
        }
        .poscell {
            display: table-cell;
            border: 1px black solid;
            display: 500px;
            background: red;
        }
        .active {
            display: table-cell;
            border: 1px black solid;
            display: 500px;
            background: green;
        }
        .notpos {
            background: red;
        }
        .table{
            display: table;
        }
        .row {
            display: table-row;
        }
    </style>
</head>
    <body>
        <div id='app'> 
        <div class="table">
        <div class='row'><div class="qwe">Фамилия</div><div class="qwe">Посещение</div><div class="qwe">Заметка</div>
            
            </div>
            <div class='row' v-for='student in studsInLess' v-bind:key='student.id'>
                
               <div class='qwe'>{{student.name}}</div>
               <div @click='student.visit=="no" ? student.visit="yes" : student.visit="no"' v-bind:class='{active: student.visit=="yes"}' class='poscell'></div>
               <div class='qwe'><input v-model='student.itog' type="text" name="" id=""></div>
            </div>
        </div>
        <button @click='isvisit'>qwe</button>
        </div>
    </body>
    <script>
        var app = new Vue({
            el:'#app',
            data:{
                lesson:'',
                students:[],
                student:'',
                i: '',
                styles: {
                    backgroundColor: 'red'
                },
                studsInLess: []
            },
            created() { 
                var predmet = "Web";
                var group = "22304"
                var i;
            axios.get(`http://localhost/basic/web/predmet/visits/`+group+`/`+predmet)
                .then(response => (this.lesson = response.data))
                    axios.get(`http://localhost/basic/web/group/`+group)
                .then(response => (this.students = response.data.student))
              
              

            },
           
            filters: {
                
              isPos: function (i,student) {
                //console.log(i);
                  for (k of i.lesson.visit){
                      
                 
                try {
                  console.log(k);
                        if (student.id == k.stud_id && 'yes' == k.visit) {
                        this.isPos=true;
                    return 'active';
                }
            
                    
                   
                }
                catch{

                
                    return false;
                }
              
              }
                
}
            },
            watch: {
                students: function(val) {
                    this.students.forEach(i => {
                        obj = new Object()
                        obj={
                            stud_id : i.id,
                            name : i.name,
                            itog: '',
                            visit: 'no'
                        }
                        this.studsInLess.push(obj)
                    });
                    console.log(this.studsInLess)
                }

            },
            methods:{
                isPosed(e) {
                  //  console.log(this.students)
                    console.log(event);
                   // this.event.styles.backgroundColor='blue';
                    console.log('test');
                    this.styles.backgroundColor = 'green';
                },
                isvisit(val){
              //     console.log(this.studsInLess)
               
            }
            },
            
           
            })
    </script>
    
</html>