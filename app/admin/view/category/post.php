<extend file='resource/view/admin/article'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class=""><a href="{{u('lists')}}">栏目列表</a></li>
        <li class="active"><a href="{{u('post')}}">添加/编辑</a></li>
    </ul>
    <form method="post">
<!--        所属栏目-->
        <div class="form-group">
            <label>所属栏目</label>
            <select name="pid" class="form-control" >
                <option value="">顶级栏目</option>
                <foreach from="$catData" value="$v">
<!--                    如果存在有子集栏目的父级pid和栏目中的cid相等，那么就选中该栏目（父级栏目）-->
                    <option value="{{$v['cid']}}" {{$v['_disabled']}} <if value="$model['pid']==$v['cid']">selected</if> >{{$v['_catname']}}</option>
                </foreach>
            </select>
        </div>

        <div class="form-group">
            <label>栏目名称</label>
            <input type="text" class="form-control"  name="catname" value="{{$model['catname']}}">
        </div>
        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" name="is_cover" value="1" <if value="$model['is_cover']">checked</if> > 是否为封面栏目
            </label>
        </div>
<!--        上传图片-->
        <div class="form-group">
            <label for="">缩略图</label>
            <div>
                <div class="input-group">
                    <input type="text" class="form-control" name="thumb" readonly="" value="{{$model['thumb']}}">
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

                            $("[name='thumb']").val(images[0]);
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
<!--        栏目描述-->
        <div class="form-group" >
            <label>栏目描述</label>
            <textarea class="form-control" name="description"  cols="10" rows="6">{{$model['description']}}</textarea>
            <p class="help-block">栏目描述主要用于对栏目页面进行简单的说明描述</p>
        </div>
<!--        栏目跳转地址-->
        <div class="form-group"  >
            <label>栏目跳转地址</label>
            <input class="form-control" type="text" name="linkurl" value="{{$model['linkurl']}}">
        </div>

        <div class="form-group" >
            <label>栏目排序</label>
            <input class="form-control" type="number" name="orderby" value="{{$model['orderby']}}">
        </div>
        <button type="submit" class="btn btn-primary">保存修改</button>
    </form>
</block>
