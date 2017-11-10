<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>后盾网 - HDCMS开源免费内容管理系统</title>
    <meta name="csrf-token" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="{{__ROOT__}}/node_modules/hdjs/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{__ROOT__}}/node_modules/hdjs/css/font-awesome.min.css" rel="stylesheet">

    <script>
        //模块配置项
        var hdjs = {
            //框架目录
            'base': '{{__ROOT__}}/node_modules/hdjs',
            //上传文件后台地址
            'uploader': '?s=component/upload/uploader',
            //获取文件列表的后台地址
            'filesLists': '?s=component/upload/filesLists',
        };
    </script>
    <script src="{{__ROOT__}}/node_modules/hdjs/app/util.js"></script>
    <script src="{{__ROOT__}}/node_modules/hdjs/require.js"></script>
    <script src="{{__ROOT__}}/node_modules/hdjs/config.js"></script>

    <link href="{{__ROOT__}}/resource/css/hdcms.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Gaines’hdcms，基于HDPHP开发的cms管理系统，适用范围广</a>
        </div>
    </nav>

    <ul class="list-group col-sm-3">
        <li class="list-group-item active">版权信息</li>
        <li class="list-group-item">环境监测</li>
        <li class="list-group-item">初始化数据</li>
        <li class="list-group-item">完成安装</li>
    </ul>

    <div class="panel panel-default col-sm-9" style="padding:0px">
        <div class="panel-heading">
            <h3 class="panel-title">版权信息</h3>
        </div>
        <div class="panel-body">
            <p>名称：基于HDPHP开发的cms管理系统</p>
            <p>版权：Copyright &copy; 2017 Gaines 京ICP备17035391号</p>
            <p>当使用本站时，代表您已接受了本站的使用条款和隐私条款。版权所有，保留一切权利。</p>
        </div>
    </div>
    <div class="text-center">
        <a class="btn btn-info" href="{{u('system.install.environmental')}}">下一步</a>
    </div>

</div>
</body>