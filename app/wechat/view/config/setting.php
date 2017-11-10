<extend file='resource/view/admin/wechat'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="javascript:;">微信配置</a></li>
    </ul>
    <form method="post">
<!--        (公众号名称webname，微信号account，appid，appsecret，token，encodingaeskey)，-->
        <div class="form-group">
            <label>公众号名称</label>
            <input type="text" class="form-control"  name="webname" value="{{$model['webname']}}" required>
        </div>
        <div class="form-group">
            <label>微信号</label>
            <input type="text" class="form-control"  name="account" value="{{$model['account']}}" required>
        </div>
        <div class="form-group">
            <label>appid</label>
            <input type="text" class="form-control"  name="appid" value="{{$model['appid']}}" required>
        </div>
        <div class="form-group">
            <label>appsecret</label>
            <input type="text" class="form-control"  name="appsecret" value="{{$model['appsecret']}}" required>
        </div>
        <div class="form-group">
            <label>token</label>
            <input type="text" class="form-control"  name="token" value="{{$model['token']}}" required>
        </div>
        <div class="form-group">
            <label>encodingaeskey</label>
            <input type="text" class="form-control"  name="encodingaeskey" value="{{$model['encodingaeskey']}}" required>
        </div>
        <button type="submit" class="btn btn-primary">保存修改</button>
    </form>
</block>
