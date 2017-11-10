<extend file='resource/view/admin/wechat'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{url('base.wechat.lists')}}">关键词列表</a></li>
        <li><a href="{{url('base.wechat.post')}}">编辑关键词</a></li>
    </ul>

    <table class="table table-hover">
        <tr class="table-container">
            <th width="150">ID</th>
            <th>关键词名</th>
            <th>关键词内容</th>
            <th width="200">操作</th>
        </tr>
<!--        <foreach from='$data' value='$v'> </foreach>  -->
        <foreach from="$data" value="$v">
            <tr>
                <td>{{$v['id']}}</td>
                <td>{{$v->keywords->content}}</td>
                <td>{{$v['content']}}</td>
                <td>
                    <a href="{{url('base.wechat.post',['bid'=>$v['id']])}}" class="btn btn-info btn-sm">编辑</a>
                    <a href="javascript:if (confirm('确定要删除吗？')) location.href='{{url('base.wechat.remove',['bid'=>$v['id']])}}'" class="btn btn-danger btn-sm">删除</a>
                </td>
            </tr>
        </foreach>
    </table>
</block>
