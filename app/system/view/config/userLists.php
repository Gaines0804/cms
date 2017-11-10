<extend file='resource/view/admin/system'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{u('userLists')}}">用户列表</a></li>
        <li><a href="{{u('addUser')}}">添加用户</a></li>
    </ul>

    <table class="table table-hover">
        <tr class="table-container">
            <th width="150">ID</th>
            <th>用户名</th>
            <th width="200">操作</th>
        </tr>
<!--        <foreach from='$data' value='$v'> </foreach>  -->
        <foreach from="$data" value="$v">
            <tr>
                <td>{{$v['uid']}}</td>
                <td>{{$v['username']}}</td>
                <td>
                        <a href="javascript:if (confirm('确定要卸载模块吗？')) location.href='{{u('removeUser',['uid'=>$v['uid']])}}'" class="btn btn-danger btn-sm">删除用户</a>
                </td>
            </tr>
        </foreach>
    </table>
</block>
