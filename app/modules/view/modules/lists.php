<extend file='resource/view/admin/modules'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{u('lists')}}">模块列表</a></li>
        <li><a href="{{u('design')}}">设计模块</a></li>
    </ul>

    <table class="table table-hover">
        <tr class="table-container">
            <th>缩略图</th>
            <th>模块标识</th>
            <th>模块名称</th>
            <th>模块介绍</th>
            <th width="200">操作</th>
        </tr>
<!--        <foreach from='$data' value='$v'> </foreach>  -->
        <foreach from="$data" value="$v">
            <tr>
                <td><img src="{{__ROOT__.'/'.$v['preview']}}" width="80"></td>
                <td>{{$v['name']}}</td>
                <td>{{$v['title']}}</td>
                <td>{{$v['resume']}}</td>
                <td>
                    <if value="$v['installed']">
                        <a href="javascript:if (confirm('确定要卸载模块吗？')) location.href='{{u('uninstall',['name'=>$v['name']])}}'" class="btn btn-danger btn-sm">卸载</a>
                        <else/>
                        <a href="{{u('install',['name'=>$v['name']])}}" class="btn btn-info btn-sm">安装</a>
                    </if>


                </td>
            </tr>
        </foreach>
    </table>
</block>
