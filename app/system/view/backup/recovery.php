<extend file='resource/view/admin/system'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#">还原备份中...</a></li>
    </ul>
    <div class="alert alert-warning" role="alert">{{$res}}</div>

    <script>
        setTimeout(function () {
            location.href = '{{$_SERVER['REQUEST_URI']}}';
        }, 1000);
    </script>
</block>