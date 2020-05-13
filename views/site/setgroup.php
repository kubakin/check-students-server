<?php
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] ;

$url = explode('?', $url);

$url = $url[0];

use yii\helpers\Html;
$array = [];
//echo $url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Document</title>
    <?= Html::csrfMetaTags() ?>
    <script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js'></script>
    <style>
     
        #block1{
            display: grid;
            background: grey;
            width: 300px;
            height: 300px;
            margin: auto;
            justify-content: center;
            border: 4px solid green;
            
        }
      input {
          display: block;
          margin: auto;
          margin-top: 10px;
            margin-bottom: 10px;
            width: 200px;
      }
      .flex {
          display: flex;
          
          align-items: center;
          
      }
      .flex input {
          color: white;
          background: green;
      }
      .sender {
          margin-top: 100px;
          background: green;
          color: black;
          width: 200px;
      }
    </style>
</head>
    <body>
     
        <div id='app'> 
         
            <div id="block1">
        <?= Html::beginForm(['create'], 'post') ?>
        <div class='flex'>
            <p>Groups</p>
        <input type="text" name="groups" id="">
        </div>
        <input list="predmet-list" name='predmet'>
        <datalist id="predmet-list">
        <option v-for='predmet in predmets'>{{predmet.name}}</option>
       
        </datalist>
        
        
        <div id="data">
        <input type="date" name="data" id="">
        </div>
        
        <input class='sender' type="submit" value="Отметить посещение">
       
<?= Html::endForm() ?>
       </form>
        
        </div>
        </div>
       
    </body>
    <script>
        var app = new Vue({
            el:'#app',
            data:{
                lesson:'',
                predmets:'',
            },
           created() {
            var url = "<?php echo $model;?>";
            axios.get(url+`/predmet/`)
                 .then(response => (this.predmets = response.data))
           },
           
            }
           
            )
    </script>
    
</html>