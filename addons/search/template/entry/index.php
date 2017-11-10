<extend file='resource/view/admin/modules'/>
<block name="business">
    <ul class="list-group menus">
        <li class="list-group-item" id="3">
            <a href="?m=search&a=controller/entry/index">热门关键词</a>
        </li>

    </ul>
</block>
<block name="content">

    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#">热门关键词</a></li>
    </ul>
    <!-- TAB CONTENT -->
    <div class="tab-content">
        <div class="active tab-pane fade in" id="tab1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="30">ID</th>
                    <th>关键词</th>
                    <th>搜索次数</th>
                    <th width="120">操作</th>
                </tr>
                </thead>
                <tbody>
                <foreach from="$keywords" value="$v">
                    <tr>
                        <td>{{$v['kid']}}</td>
                        <td>{{$v['keywords']}}</td>
                        <td>{{$v['times']}}</td>
                        <td>
                            <a href="javascript:if(confirm('确定删除吗？')) location.href='{{url('search.entry.remove',['kid'=>$v['kid']])}}';"
                               class="btn btn-danger btn-xs">删除</a>
                        </td>
                    </tr>
                </foreach>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="tab2">
            <h2>Tab2</h2>
            <p>Lorem ipsum.</p>
        </div>

    </div>

</block>

