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
                lesid: 0,
                studsInLess: []
            },
            created() { 
                var predmet = "<?php echo $predmet ?>";
                var group = "?list[]="+"<?php echo $gr ?>"
                var i;
                  var url = "<?php echo $model1;?>";
                 
                    
                    axios.get(url+`/group`+group)
                .then(response => (this.students = response.data))
                this.lesid = parseInt("<?php  echo $model ?>")
             //   console.log(test);
              //  console.log(this.students)
              
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
                students: function() {
                    this.students.forEach(groups => {
                      //  console.log(groups)
                        groups.student.forEach(i => {
                        obj = new Object()
                        obj={
                            stud_id : i.id,
                            name : i.name,
                            itog: '',
                            visit: 'no',
                            les_id: this.lesid
                        }
                        this.studsInLess.push(obj)
                    });
                    })
                   
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
                isvisit(){
                    var url = "<?php echo $model1;?>";
                    axios.post(url+`/visit/create`, this.studsInLess)
                .then(response => (console.log(response)))
                document.location.href=url;
            }
            },
            
           
            })
    </script>
    
</html>