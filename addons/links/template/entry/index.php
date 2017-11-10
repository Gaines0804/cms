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
        <li class="active"><a href="{{url('links.entry.index')}}">友情链接列表</a></li>
        <li><a href="{{url('links.entry.post')}}">添加/编辑</a></li>
    </ul>

    <table class="table table-hover">
        <tr class="table-container">
            <th>ID</th>
            <th>链接名称</th>
            <th>链接地址</th>
            <th>排序</th>
            <th width="200">操作</th>
        </tr>
<!--        <foreach from='$data' value='$v'> </foreach>  -->
        <foreach from="$data" value="$v">
            <tr>
                <td>{{$v['lid']}}</td>
                <td><a href="{{$v['url']}}">{{$v['lname']}}</a></td>
                <td>{{$v['url']}}</td>
                <td>{{$v['orderby']}}</td>
                <td>
                    <a href="{{url('links.entry.post',['lid'=>$v['lid']])}}" class="btn btn-primary btn-xs">编辑</a>
                    <a href="javascript:if(confirm('确定删除吗？')) location.href='{{url('links.entry.remove',['lid'=>$v['lid']])}}';"
                       class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
        </foreach>
    </table>
</block>
