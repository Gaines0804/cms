<extend file='resource/view/admin/article'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{u('lists')}}">栏目列表</a></li>
        <li><a href="{{u('post')}}">添加/编辑</a></li>
    </ul>

    <table class="table table-hover">
        <tr class="table-container">
            <th width="25%">ID</th>
            <th width="25%">栏目名称</th>
            <th style="text-align: center">封面栏目</th>
            <th width="25%">操作</th>
        </tr>
<!--        <foreach from='$data' value='$v'> </foreach>  -->
        <foreach from="$data" value="$v">
            <tr>
                <td>{{$v['cid']}}</td>
                <td>{{$v['_catname']}}</td>
                <td style="text-align: center">
                    <if value="$v['is_cover']">
                        <i class="glyphicon glyphicon-ok" style="font-size: 20px;color: #09b3e2;"></i>
                        <else/>
                        <i class="glyphicon glyphicon-remove" style="font-size: 20px;color: red;"></i>
                    </if>

                </td>
                <td>

                    <a href="{{__ROOT__}}/c_{{$v['cid']}}.html" class="btn btn-warning btn-sm">预览</a>
                    <a href="{{u('post',['cid'=>$v['cid']])}}" class="btn btn-info btn-sm">编辑</a>
                    <a href="javascript:if (confirm('确定要删除吗？')) location.href='{{u('remove',['cid'=>$v['cid']])}}'" class="btn btn-danger btn-sm">删除</a>
                </td>
            </tr>
        </foreach>
    </table>

</block>
