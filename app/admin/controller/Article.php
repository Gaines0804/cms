<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use houdunwang\view\View;
use modules\Wechat;
use system\model\Article as articleModel;
use system\model\Category;

class Article extends Common {
    use Wechat;
    /**
     * 文章列表
     * @return mixed
     */
    public function lists(){

        //p(v('config'));  //通过v函数我们可以的到全局的数组数据，可以任何地方使用

        //获得get参数，我们需要用到来标记是否为回收站
        //默认给定空字符串，因为我们点击左侧文章列表的时候，并没有get参数
        $recycle = Request::get('recycle','');
        //where条件，
        //我们在不同的状态下面显示不同的数据，即回收站显示已经在列表页删除过的数据，这里就需要通过recycle来标记是否为回收站数据
        //如果$resycle为真（即为1，也就是此时实在回收站页面），那么就将条设置为isrecycle=1，只显示对应的数据；如果为假，即没传参数或者位0（此时实在列表页），那么就显示条件isrecycle=0对应的数据
        $where = $recycle ? 'isrecycle=1' : 'isrecycle=0';
        //关联栏目表和文章表，我们需要在页面中显示文章和所属栏目
        $data = articleModel::field('*,article.orderby as ao')->orderBy('article.orderby','ASC')->where($where)->join('category','category_cid','=','cid')->paginate(v('config.page'));
        //p($data->toArray());
        return View::make()->with(compact('data'));
    }

    public function post(){


        $aid = Request::get('aid');
        $model = $aid ? articleModel::find($aid) : new articleModel();
        $data = $model->toArray();
        //$model = articleModel::find($aid) ?: new articleModel();
        //添加时间字段

        if(IS_POST){
            //获得用户提交的数据
            $post = Request::post();
            $time= $data ? strtotime($data['created_at']) : time();
            $post['time'] = $time;
            //将数据添加到article表中
            $model->save( $post );
            //p($model->toArray());
            //再将关键词对应的信息存入关键词表中
            $data = [
                'module'     => 'article',
                'content'    => $post['wechat_keywords'],
                'content_id' => $model['aid']
            ];
            $this->saveKeywords( $data );
            return $this->setRedirect('lists')->success('保存成功');
        }
        //获得栏目数据，我们需要在编辑和添加文章是选择所属栏目
        $catData = Category::getTreeData();
        //p($catData);
        return View::make()->with(compact('catData','model'));
    }

    /**
     * 删除到回收站，其实就是将数据库中的isrecycle的值改为1
     */
    public function remove(){
        $aid = Request::get('aid');
//        //echo $aid;
//        articleModel::find($aid)->save(['isrecycle'=>1]);
//        articleModel::find()->save(['isrecycle'=>1]);
        //查询aid对应的数据
        $model = articleModel::find($aid);
        //修改字段isresycle的值为1，标记为回收站数据
        $model->isrecycle = 1;
        $model->save();
        return $this->setRedirect('lists')->success('删除到回收站成功');

//        p(articleModel::find(Request::get('aid')));
    }

    /**
     * 还原回收站中的数据
     * @return array
     */
    public function recover(){
        $aid = Request::get('aid');
        $model = articleModel::find($aid);
        //p($model->toArray());
        //修改字段isresycle的值为0，代表不是回收站数据
        $model->isrecycle = 0;
        //执行修改，就数据保存到数据库中
        $model->save();
        return $this->setRedirect('lists')->success('还原成功');
    }
    /**
     * 真正的删除
     */
    public function realremove(){
        $aid = Request::get('aid');
        //查找到aid对应的数据，删除数据库中的数据
        articleModel::find($aid)->destory();

        //删除关键词，需要传参数指定删除哪一个关键词
        $this->removeKeywords($aid,'article');
        //跳转到回收站页面，提示删除成功
        return $this->setRedirect(u('lists'))->success('删除成功');
    }



}
