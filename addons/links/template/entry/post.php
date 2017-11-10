<extend file='resource/view/admin/modules'/>
<block name="business">
    <ul class="list-group menus">
        <li class="list-group-item" id="3">
            <a href="?m=links&a=controller/entry/index"
               class="quickMenuLink">
                链接列表 </a>
        </li>
    </ul>
    <ul class="list-group menus">
        <li class="list-group-item" id="3">
            <a href="?m=links&a=controller/entry/post"
               class="quickMenuLink">
                添加链接 </a>
        </li>
    </ul>
</block>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="{{url('links.entry.index')}}">友情链接列表</a></li>
        <li class="active"><a href="{{url('links.entry.post')}}">添加/编辑</a></li>
    </ul>
    <form method="post">

        <div class="form-group">
            <label>友情链接名称</label>
            <input type="text" class="form-control"  name="lname" value="{{$model['lname']}}" required>
        </div>

        <!--title（链接地址）-->
        <div class="form-group">
            <label>链接地址</label>
            <input type="text" class="form-control"  name="url" value="{{$model['url']}}">
        </div>

        <!--resume（链接排序）-->
        <div class="form-group">
            <label>链接排序</label>
            <input type="text" class="form-control"  name="orderby" value="{{$model['orderby']}}">
        </div>
        <button type="submit" class="btn btn-primary">保存修改</button>
    </form>
</block>
