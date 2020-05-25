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

<!-- <!DOCTYPE html><html lang=ru style="height: 100%"><head><meta charset=utf-8><meta http-equiv=X-UA-Compatible content="IE=edge"><meta name=viewport content="width=device-width,initial-scale=1">[if IE]><link rel="icon" href="./img/icons/Uchp_icon.png"><![endif]<title>UchetPos</title><link href=/css/chunk-4a310dca.159eebb8.css rel=prefetch><link href=/css/chunk-71481603.9d6a78d5.css rel=prefetch><link href=/css/chunk-7c40e030.e1668593.css rel=prefetch><link href=/css/chunk-7c9db726.753e60c3.css rel=prefetch><link href=/css/chunk-987ab598.9a34476d.css rel=prefetch><link href=/js/chunk-4a310dca.a4f22f3e.js rel=prefetch><link href=/js/chunk-71481603.11bb3ccd.js rel=prefetch><link href=/js/chunk-7c40e030.fd5abd37.js rel=prefetch><link href=/js/chunk-7c9db726.fa749e1b.js rel=prefetch><link href=/js/chunk-987ab598.c2e52165.js rel=prefetch><link href=/css/app.b07a558c.css rel=preload as=style><link href=/js/app.2d4e4340.js rel=preload as=script><link href=/js/chunk-vendors.e9618f63.js rel=preload as=script><link href=/css/app.b07a558c.css rel=stylesheet><link rel=icon type=image/png sizes=32x32 href=/img/icons/favicon-32x32.png><link rel=icon type=image/png sizes=16x16 href=/img/icons/favicon-16x16.png><link rel=manifest href=/manifest.json><meta name=theme-color content=#4DBA87><meta name=apple-mobile-web-app-capable content=no><meta name=apple-mobile-web-app-status-bar-style content=default><meta name=apple-mobile-web-app-title content=UchetPos><link rel=apple-touch-icon href=/img/icons/apple-touch-icon-152x152.png><link rel=mask-icon href=/img/icons/safari-pinned-tab.svg color=#4DBA87><meta name=msapplication-TileImage content=/img/icons/msapplication-icon-144x144.png><meta name=msapplication-TileColor content=#000000></head><body style="margin: 0;height: 100%"><noscript><strong>We're sorry but uchetpos doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript><div id=app></div><script src=/js/chunk-vendors.e9618f63.js></script><script src=/js/app.2d4e4340.js></script></body></html> -->