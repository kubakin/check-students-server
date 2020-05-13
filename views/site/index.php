<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .app{
        display: grid;
        justify-content: center;
        width: 300px;
        height: 300px;
        background: grey;
        border: 4px solid green;
        margin: auto
    }
    .app a{
        height: 30px;
        padding-bottom: 10px;
        padding-top: 5px;
        background: green;
        margin: auto;
        color: white;
        border: 1px solid black;
    }
</style>
<body>
    <div class=app>
    <a href="<?php echo $model;?>/site/lesson">Просмотр посещаемости</a>
    <a href="<?php echo $model;?>/site/setgroup">Отметить посещаемость</a>
    </div>
</body>
</html>