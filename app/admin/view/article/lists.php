<extend file='resource/view/admin/article'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li <if value="Request::get('recycle')==0"> class="active"</if> ><a href="{{u('lists',['recycle'=>0])}}">文章列表</a></li>
        <li <if value="Request::get('recycle')==1"> class="active"</if> ><a href="{{u('lists',['recycle'=>1])}}">回收站</a></li>
        <li><a href="{{u('post')}}">添加/编辑</a></li>
    </ul>

    <table class="table table-hover">
        <tr class="table-container">
            <th width="80">ID</th>
            <th width="300">文章标题</th>
            <th>查看次数</th>
            <th>所属栏目</th>
            <th width="80">排序</th>
            <th>微信关键词</th>
            <th width="200">操作</th>
        </tr>
<!--        <foreach from='$data' value='$v'> </foreach>  -->
        <foreach from="$data" value="$v">
            <tr>
                <td>{{$v['aid']}}</td>
                <td width="34%">{{mb_substr($v['title'],0,20)}}......</td>
                <td>{{$v['click']}}</td>
                <td>{{$v['catname']}}</td>
                <td>{{$v['ao']}}</td>
                <td>{{$v['wechat_keywords']}}</td>
                <td>
                    <if value="Request::get('recycle')==0">
                        <a href="{{__ROOT__}}/a_{{$v['aid']}}.html" class="btn btn-warning btn-sm" target="_blank">预览</a>
                        <a href="{{u('post',['aid'=>$v['aid']])}}" class="btn btn-info btn-sm">编辑</a>
                        <a href="{{u('remove',['aid'=>$v['aid']])}}" class="btn btn-danger btn-sm">删除</a>
                        <else/>
                        <a href="{{u('recover',['aid'=>$v['aid']])}}" class="btn btn-info btn-sm">还原</a>
                        <a href="javascript:if (confirm('确定要删除吗？')) location.href='{{u('realremove',['aid'=>$v['aid']])}}'" class="btn btn-danger btn-sm">删除</a>
                    </if>

                </td>
            </tr>
        </foreach>
    </table>
    <div class="text-center">
        {{$data->links()}}
    </div>

</block>
