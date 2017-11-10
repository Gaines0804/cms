<extend file='resource/view/admin/system'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="javascript:;">修改密码</a></li>
<!--        网站名称，网站描述，网站关键字，icp备案号，客服电话，分页条数-->
    </ul>
    <form onsubmit="post(event)">
        <div class="panel panel-info">
<!--            <div class="panel-heading">用户名</div>-->
            <div class="panel-body">
                <!--        网站名称-->
                <div class="form-group">
                    <label>用户名</label>
                    <input type="text" name="username" class="form-control" value="{{Session::get('user.username')}}" disabled>
                </div>

                <div class="form-group"  >
                    <label>旧密码</label>
                    <input class="form-control" type="password" name="password" value="" required>
                </div>
                <div class="form-group"  >
                    <label>新密码</label>
                    <input class="form-control" type="password" name="password1" value="" required>
                </div>
                <div class="form-group"  >
                    <label>确认密码</label>
                    <input class="form-control" type="password" name="password2" value="" required>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">保存修改</button>
    </form>
    <script>
        function post(event) {
            event.preventDefault();
            require(['util'], function (util) {
                util.submit({
                    url: '{{__URL__}}',
                    successUrl:"{{u('admin.category.lists')}}"
                });
            });
        }
    </script>
</block>
