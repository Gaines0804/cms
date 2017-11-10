<extend file='resource/view/admin/article'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class=""><a href="{{u('lists')}}">文章列表</a></li>
        <li class="active"><a href="{{u('post')}}">添加/编辑</a></li>
    </ul>
    <form method="post">
<!--        所属栏目-->
        <div class="form-group">
            <label>所属栏目</label>
            <select name="category_cid" class="form-control" required="required">
                <option value="">请选择栏目</option>
                <foreach from="$catData" value="$v">
<!--                    如果存在有子集栏目的父级pid和栏目中的cid相等，那么就选中该栏目（父级栏目）-->
                    <option value="{{$v['cid']}}" <if value="$model['category_cid']==$v['cid']">selected</if> >{{$v['_catname']}}</option>
                </foreach>
            </select>
        </div>

        <div class="form-group">
            <label>标题</label>
            <input type="text" class="form-control"  name="title" value="{{$model['title']}}" required>
        </div>
        <div class="form-group">
            <label>作者</label>
            <input type="text" class="form-control"  name="author" value="{{$model['author']}}">
        </div>
        <div class="form-group">
            <label>关键词</label>
            <textarea name="keywords" class="form-control" cols="30" rows="3" required>{{$model['keywords']}}</textarea>
        </div>
<!--        栏目描述-->
        <div class="form-group" >
            <label>文章描述</label>
            <textarea class="form-control" name="description"  cols="10" rows="5">{{$model['description']}}</textarea>
        </div>
        <div class="form-group" >
            <label>文章内容</label>
            <textarea name="content" id="container" style="height:300px;width:100%;" required>{{$model['content']}}</textarea>
            <script>
                util.ueditor('container', {hash:2,data:'hd'}, function (editor) {
                    //这是回调函数 editor是百度编辑器实例
                });
            </script>
        </div>

        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" name="iscommend" value="1" <if value="$model['iscommend']">checked</if>  > 推荐
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="ishot" value="1"  <if value="$model['ishot']">checked</if> > 热门
            </label>
        </div>

        <div class="form-group"  >
            <label>文章来源</label>
            <input class="form-control" type="text" name="source" value="{{$model['source']}}">
        </div>
<!--        文章地址-->
        <div class="form-group"  >
            <label>文章跳转地址</label>
            <input class="form-control" type="text" name="linkurl" value="{{$model['linkurl']}}">
        </div>

<!--        点击次数-->
        <div class="form-group"  >
            <label>点击次数</label>
            <input class="form-control" type="number" name="click" value="{{$model['click']}}" required>
        </div>
        <div class="form-group" >
            <label>栏目排序</label>
            <input class="form-control" type="number" name="orderby" value="{{$model['orderby']}}" required>
        </div>
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
                    <!--                    default_pic是自定义函数，在哪里呢？自己找！-->
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

        <div class="form-group"  >
            <label>微信关键词</label>
            <input class="form-control" type="text" name="wechat_keywords" value="{{$model['wechat_keywords']}}">
        </div>
        <button type="submit" class="btn btn-primary">保存修改</button>
    </form>
</block>
