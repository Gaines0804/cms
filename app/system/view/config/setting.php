<extend file='resource/view/admin/system'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="javascript:;">站点设置</a></li>
<!--        网站名称，网站描述，网站关键字，icp备案号，客服电话，分页条数-->
    </ul>
    <form method="post">
        <div class="panel panel-info">
            <div class="panel-heading">网站配置</div>
            <div class="panel-body">
                <!--        网站名称-->
                <div class="form-group">
                    <label>网站名称</label>
                    <input type="text" name="webname" class="form-control" value="{{$model['webname']}}">
                </div>

                <!--        网站关键字-->
                <div class="form-group" >
                    <label>网站关键字</label>
                    <textarea class="form-control" name="keywords"  cols="10" rows="3">{{$model['keywords']}}</textarea>
                </div>
                <!--        网站描述-->
                <div class="form-group" >
                    <label>网站描述</label>
                    <textarea class="form-control" name="description"  cols="10" rows="3">{{$model['description']}}</textarea>
                </div>
                <!--        icp备案号-->
                <div class="form-group"  >
                    <label>icp备案号</label>
                    <input class="form-control" type="text" name="icp" value="{{$model['icp']}}">
                </div>
                <div class="form-group" >
                    <label>客服电话</label>
                    <input class="form-control" type="text" name="phone" value="{{$model['phone']}}">
                </div>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">文章配置</div>
            <div class="panel-body">

                <div class="form-group" >
                    <label>分页显示条数</label>
                    <input class="form-control" type="number" name="page" value="{{$model['page']}}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">保存修改</button>
    </form>
</block>
