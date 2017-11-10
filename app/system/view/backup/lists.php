<extend file='resource/view/admin/system'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="javascript:;">备份列表</a></li>
    </ul>

    <table class="table table-hover">
        <tr class="table-container">
            <th width="150">ID</th>
            <th>备份目录</th>
            <th>备份时间</th>
            <th width="200">操作</th>
        </tr>
<!--        <foreach from='$data' value='$v'> </foreach>  -->
        <?php $mun=0 ?>
        <foreach from="$dirs" value="$d">
            <?php $mun++ ?>
            <tr>
                <td>{{$mun}}</td>
                <td>{{$d['path']}}</td>
                <td>{{date('Y-m-d H:i:s',$d['fileatime'])}}</td>
                <td>
                    <a href="{{u('recovery',['path'=>$d['path']])}}" class="btn btn-info btn-sm">还原</a>
                    <a href="javascript:if (confirm('确定要删除吗？')) location.href='{{u('remove',['path'=>$d['path']])}}'" class="btn btn-danger btn-sm">删除</a>
                </td>
            </tr>
        </foreach>
    </table>
</block>
