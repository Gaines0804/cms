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
        <li class="list-group-item">版权信息</li>
        <li class="list-group-item active">环境检测</li>
        <li class="list-group-item">初始化数据</li>
        <li class="list-group-item">完成安装</li>
    </ul>

    <div class="panel panel-default col-sm-9" style="padding:0px">
        <div class="panel-heading">
            <h3 class="panel-title">系统环境</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td>php版本</td>
                    <td>{{$data['php_version']}}</td>
                </tr>
                <tr>
                    <td>服务器环境</td>
                    <td>{{$data['server_software']}}</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="panel panel-default col-sm-9" style="padding:0px">
        <div class="panel-heading">
            <h3 class="panel-title">环境监测</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>php版本</th>
                    <th>
                        <if value="$data['version']">
                            <i class="fa fa-check-circle alert-success"></i>
                            <else/>
                            <i class="fa fa-times-circle hd-error" ></i>
                        </if>
                    </th>
                </tr>
                <tr>
                    <td>gd</td>
                    <td>
                        <if value="$data['gd']">
                            <i class="fa fa-check-circle alert-success"></i>
                            <else/>
                            <i class="fa fa-times-circle hd-error" ></i>
                        </if>
                    </td>
                </tr>
                <tr>
                    <td>curl</td>
                    <td>
                        <if value="$data['curl']">
                            <i class="fa fa-check-circle alert-success"></i>
                            <else/>
                            <i class="fa fa-times-circle hd-error" ></i>
                        </if>
                    </td>
                </tr>
                <tr>
                    <td>pdo</td>
                    <td>
                        <if value="$data['pdo']">
                            <i class="fa fa-check-circle alert-success"></i>
                            <else/>
                            <i class="fa fa-times-circle hd-error"></i>
                        </if>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-center">
        <a class="btn btn-warning" href="{{u('system.install.copyright')}}">上一步</a>
        <a class="btn btn-info" href="{{u('system.install.database')}}">下一步</a>
    </div>
</body>