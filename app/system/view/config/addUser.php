<extend file='resource/view/admin/system'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="{{u('userLists')}}">用户列表</a></li>
        <li class="active"><a href="{{u('adddUser')}}">添加用户</a></li>
    </ul>
    <form action="" onsubmit="post(event)">
        <div class="panel panel-info">
            <div class="panel-body">
                <div class="form-group">
                    <label>用户名</label>
                    <input type="text" name="username" class="form-control" value="" required>
                </div>
                <div class="form-group"  >
                    <label>设置密码</label>
                    <input class="form-control" type="password" name="password" value="" required>
                </div>
                <div class="form-group"  >
                    <label>确认密码</label>
                    <input class="form-control" type="password" name="password1" value="" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">添加用户</button>
    </form>
    <script>
        function post(event) {
            //alert(1);
            event.preventDefault();
            require(['util'], function (util) {
                util.submit({
                    //url: '{{__URL__}}',
                    successUrl:"{{u('system.config.userLists')}}"
                });
            });
        }
    </script>
</block>
