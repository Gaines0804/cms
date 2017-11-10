<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{v('config.webname')}}</title>
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
    <script>
        require(['jquery'], function ($) {
            //为异步请求设置CSRF令牌
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
    <style>

    </style>
</head>
<body class="site">
<div class="container-fluid admin-top">
    <!--导航-->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <ul class="nav navbar-nav">

                    <li>
                        <a href="{{__ROOT__}}">
                            <i class="fa fa-home"></i> 返回系统
                        </a>
                    </li>

                    <!--这里使用了helper里面定义的常量来判断get参数与模块对应关系-->
                    <li class="top_menu <?php if(APP=='admin'): ?> active <?php endif; ?>">
                        <a href="{{u('admin/category/lists')}}" class="quickMenuLink">
                            <i class="fa-w fa fa-file-word-o"></i> 文章管理 </a>
                    </li>
                    <li class="top_menu <?php if(APP=='wechat'): ?> active <?php endif; ?>">
                        <a href="{{u('wechat/config/setting')}}" class="quickMenuLink">
                            <i class="fa-w fa fa-weixin"></i> 微信功能 </a>
                    </li>
                    <li class="top_menu <?php if(APP=='system'): ?> active <?php endif; ?>">
                        <a href="{{u('system/config/setting')}}" class="quickMenuLink">
                            <i class="fa-w fa fa-cog"></i> 系统管理 </a>
                    </li>
                    <li class="top_menu <?php if(APP=='modules'): ?> active <?php endif; ?>">
                        <a href="{{u('modules/modules/lists')}}" class="quickMenuLink">
                            <i class=" fa fa-cubes"></i> 模块管理 </a>
                    </li>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                           style="display:block; max-width:150px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "
                           aria-expanded="false">
                            <i class="fa fa-group"></i> 后盾网 <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="?s=system/site/edit&siteid=11"><i class="fa fa-weixin fa-fw"></i>
                                    编辑当前账号资料
                                </a>
                            </li>
                            <li><a href="?s=system/site/lists"><i class="fa fa-cogs fa-fw"></i> 管理其它公众号</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="fa fa-w fa-user"></i>
                            {{Session::get('user.username')}} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="?s=system/config/changePassword">修改密码</a></li>

                            <!--                            <li><a href="?s=system/manage/menu">系统选项</a></li>-->

                            <li role="separator" class="divider"></li>
                            <li><a href="{{u('admin.user.logout')}}">退出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--导航end-->
</div>