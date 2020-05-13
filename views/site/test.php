<?php
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ;

$url = explode('?', $url);

$url = $url[0];

 

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
            <div class='row'><div class=qwe></div><div class='qwe' v-for='i in lesson'>{{i.lesson.data}}</div>
            
            </div>
            <div class='row' v-for='student in students'>
               <div class='qwe'>{{student.name}}</div>
               <div class='poscell' v-for='i in lesson' v-bind:class="i | isPos(student)"></div>
            </div>
        </div>
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
            },
            created() { 
                var predmet = "<?php echo $predmet?>";
                var group = "<?php echo $group?>"
                var url = "<?php echo $model;?>";

            axios.get(url+`/predmet/visits/`+group+`/`+predmet)
                .then(response => (this.lesson = response.data))
                    axios.get(url+`/group/`+group)
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
            methods:{
            },
           
            })
    </script>
    
</html>