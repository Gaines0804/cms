<extend file='resource/view/admin/wechat'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="{{url('base.wechat.lists')}}">关键词列表</a></li>
        <li class="active"><a href="{{url('base.wechat.post')}}">编辑关键词</a></li>
    </ul>
    <form method="post">
        <div class="form-group">
            <label>关键词名称</label>
            <input type="text" class="form-control"  name="keywords" value="{{$keywords['content']}}">
        </div>
        <div class="form-group">
            <label>关键词回复内容</label>
            <textarea name="content" class="form-control" cols="30" rows="3">{{$model['content']}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">保存修改</button>
    </form>
</block>
