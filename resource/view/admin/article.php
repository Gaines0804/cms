<include file="resource/view/admin/header" />
<!--主体-->
<div class="container-fluid admin_menu">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-lg-2 left-menu">

            <!--扩展模块动作 start-->
            <div class="panel panel-default">
                <!--系统菜单-->
                <div class="panel-heading">
                    <h4 class="panel-title">栏目管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus">
                    <li class="list-group-item" id="3">
                        <a href="{{u('category/lists')}}"
                           class="quickMenuLink">
                            栏目列表 </a>
                    </li>
                    <li class="list-group-item" id="30">

                        <a href="{{u('category/post')}}"
                           class="quickMenuLink">
                            添加栏目 </a>
                    </li>
                </ul>
                <div class="panel-heading">
                    <h4 class="panel-title">文章管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus">
                    <li class="list-group-item" id="3">
                        <a href="{{u('article/lists')}}"
                           class="quickMenuLink">
                            文章列表 </a>
                    </li>
                    <li class="list-group-item" id="30">

                        <a href="{{u('article/post')}}"
                           class="quickMenuLink">
                            添加文章 </a>
                    </li>
                </Ul>

                <div class="panel-heading">
                    <h4 class="panel-title">轮播图管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus">
                    <li class="list-group-item" id="3">
                        <a href="{{u('slide/lists')}}"
                           class="quickMenuLink">
                            录轮播图列表 </a>
                    </li>
                    <li class="list-group-item" id="30">

                        <a href="{{u('slide/post')}}"
                           class="quickMenuLink">
                            添加轮播图 </a>
                    </li>
                </Ul>


                <!----------返回模块列表 start------------>
                <!--模块列表-->
                <!--模块列表 end-->
            </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-lg-10">
            <!--有模块管理时显示的面包屑导航-->
            <blade name="content"/>
        </div>
    </div>
</div>
<div class="master-footer text-center">
    <a href="{{__ROOT__}}">猎人训练</a>
    <a href="http://www.hdphp.com">开源框架</a>
    <a href="http://bbs.houdunwang.com">后盾论坛</a>
    <br>
    Powered by hdcms v2.0 © 2014-2019 www.hdcms.com runtime: 0.08
</div>

<script>
    require(['bootstrap']);
</script>
<!--右键菜单添加到快捷导航-->
<div id="context-menu">
    <ul class="dropdown-menu" role="menu">
        <li><a tabindex="-1" href="#">添加到快捷菜单</a></li>
    </ul>
</div>
<!--右键菜单删除快捷导航-->
<div id="context-menu-del">
    <ul class="dropdown-menu" role="menu">
        <li><a tabindex="-1" href="#">删除菜单</a></li>
    </ul>
</div>
<!--底部快捷菜单导航-->
<script src="{{__ROOT__}}/resource/js/menu.js"></script>
<script src="{{__ROOT__}}/resource/js/quick_navigate.js"></script>

</body>
</html>

<style>
    table {
        table-layout: fixed;
    }
</style>