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
<form action="" method="POST" class="form-horizontal" onsubmit="return post(event)">
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
            <li class="list-group-item">版权信息</li>
            <li class="list-group-item">环境监测</li>
            <li class="list-group-item active">初始化数据</li>
            <li class="list-group-item">完成安装</li>
        </ul>

        <div class="panel panel-default col-sm-9" style="padding:0px">
            <div class="panel-heading">
                <h3 class="panel-title">初始数据</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">主机名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="host" value="127.0.0.1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">数据库名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="database" value="cms_yanglichao">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="user" value="cms_yanglichao">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" value="197345682">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">表前缀</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="prefix" value="cms_">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">后台登录账号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="admin_username" value="admin">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">后台登录密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="admin_password" value="admin888">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{u('system.install.environmental')}}" class="btn btn-warning">上一步</a>
            <button type="submit" class="btn btn-info">下一步</button>
        </div>
    </div>
</form>
<script>
    function post() {
        //阻止按钮默认的行为，我们需要通过异步检测数据库信息是否正确
        event.preventDefault();//阻止表单默认行文
        require(['util'], function (util) {
            util.submit({
                successUrl:"{{u('system.install.tables')}}"
            });
        });
    }
</script>
</body>