<extend file='resource/view/admin/wechat'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="javascript:;">回复信息设置</a></li>
    </ul>
    <form method="post">
<!--        (公众号名称webname，微信号account，appid，appsecret，token，encodingaeskey)，-->
        <div class="form-group">
            <label>关注回复信息</label>
            <input type="text" class="form-control"  name="reply" value="{{$model['reply']}}" required>
        </div>
        <div class="form-group">
            <label>默认推送信息</label>
            <input type="text" class="form-control"  name="default" value="{{$model['default']}}" required>
        </div>
        <button type="submit" class="btn btn-primary">保存修改</button>
    </form>
</block>
