<extend file='resource/view/admin/article'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{u('lists')}}">轮播图列表</a></li>
        <li><a href="{{u('post')}}">轮播图编辑</a></li>
    </ul>

    <table class="table table-hover">
        <tr class="table-container">
            <th>标题</th>
            <th>缩略图</th>
            <th>跳转地址</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
<!--        <foreach from='$data' value='$v'> </foreach>  -->
        <foreach from="$data" value="$v">
            <tr>
                <td>{{$v['title']}}</td>
                <td><img src="{{$v['thumb']}}" width="80"></td>
                <td>{{$v['url']}}</td>
                <td>{{$v['displayorder']}}</td>
                <td>
                    <a href="{{u('post',['sid'=>$v['sid']])}}" class="btn btn-info btn-sm">编辑</a>
                    <a href="javascript:if (confirm('确定要删除吗？')) location.href='{{u('remove',['sid'=>$v['sid']])}}'" class="btn btn-danger btn-sm">删除</a>
                </td>
            </tr>
        </foreach>
    </table>
</block>
