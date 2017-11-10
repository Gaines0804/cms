<extend file='resource/view/admin/modules'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="{{u('lists')}}">模块列表</a></li>
        <li class="active"><a href="{{u('design')}}">模块设计</a></li>
    </ul>
    <form method="post">
<!--        name(模块英文标识),title（模块名称）,resume(模块介绍),author(模块作者),preview(模块预览),is_system(是否为系统模块),is_wechat(是否为微信模块)-->

        <!--name(模块英文标识)-->
        <div class="form-group">
            <label>标识</label>
            <input type="text" class="form-control"  name="name" value="" required>
            <span class="help-block">模块标识由字母、数字、下划线组成（但只能以字母开头）</span>
        </div>

        <!--title（模块名称）-->
        <div class="form-group">
            <label>名称</label>
            <input type="text" class="form-control"  name="title" value="">
        </div>

        <!--resume（模块介绍）-->
        <div class="form-group">
            <label>介绍</label>
            <textarea class="form-control" name="resume" cols="30" rows="3"></textarea>
        </div>

        <!--创建表的sql（模块介绍）-->
        <div class="form-group">
            <label>创建数据表（sql语句）</label>
            <textarea class="form-control" name="sql" cols="30" rows="3"></textarea>
        </div>

        <!--author（模块作者）-->
        <div class="form-group">
            <label>作者</label>
            <input type="text" class="form-control"  name="author" value="">
        </div>

        <!--preview（模块预览）-->
        <div class="form-group">
            <label for="">缩略图</label>
            <div>
                <div class="input-group">
                    <input type="text" class="form-control" name="preview" readonly="" value="">
                    <div class="input-group-btn">
                        <button onclick="upImage(this)" class="btn btn-default" type="button">选择图片</button>
                    </div>
                </div>
                <div class="input-group" style="margin-top:5px;">
<!--                    给定默认图片-->
                    <img src="{{default_pic($model['thumb'])}}" class="img-responsive img-thumbnail" width="150">
                    <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="removeImg(this)">×</em>
                </div>
            </div>
            <script>
                //上传图片
                function upImage(obj) {
                    require(['util'], function (util) {
                        options = {
                            multiple: false,//是否允许多图上传
                            //data是向后台服务器提交的POST数据
                            data:{name:'后盾人',year:2099},
                        };
                        util.image(function (images) {          //上传成功的图片，数组类型
                            $("[name='preview']").val(images[0]);
                            $(".img-thumbnail").attr('src', images[0]);
                        }, options)
                    });
                }

                //移除图片
                function removeImg(obj) {
                    $(obj).prev('img').attr('src', 'resource/images/nopic.jpg');
                    $(obj).parent().prev().find('input').val('');
                }
            </script>
        </div>

        <!--is_wechat(是否为微信模块)-->
        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" name="is_wechat" value="1"> 是否为微信模块
            </label>
        </div>
        <button type="submit" class="btn btn-primary">保存模块</button>
    </form>
</block>
