<?php namespace app\system\controller;

use houdunwang\route\Controller;
use houdunwang\session\Session;
use houdunwang\view\View;
use system\model\Config as configModel;
use system\model\User as userModel;

class Config extends Controller{
    //站点设置
    public function setting(){
        //如果能够查询到数据（获得的是对象），那么就将数据存入变量中，我们需要在设置页面显示已有的旧数据
        //如果没有数据，那么需要实例化一个对象，之后需要通过对象调用save方法
        $model = configModel::find(1) ?: new configModel();
        //p($model);
        if(IS_POST){
            //获得用户提交的数据，我们需要将数据存入数据库中
            $post = Request::post();
//            p($post);
//            Array
//            (
//                [csrf_token] =>
//                [webname] => 后盾网cms
//                [keywords] => 后盾网cms
//                [description] => 后盾网cms
//                [icp] => 231231511541
//                [phone] => 010-25473135
//                [page] => 2
//            )
            //将数据转换为json对象，之后不管我们再添加多少项，我们都不需要再往数据库中添加字段,让数据不进行编码
            //给对象添加字段存储数据
            $model->content = json_encode($post,JSON_UNESCAPED_UNICODE);
            //对象调用save方法，完成数据的存储
            $model->save();
            return $this->setRedirect('refresh')->success('保存成功');
        }

        //获得数据库中的内容，获得的是一个json对象，需要转换为数组
        //p($model->toArray());
        //p($model['content']);
        //如果没有数据，那么就给一个空数组，这样我们在前端页面中就不出现内容索引不到而报错了
        $model = $model ? json_decode($model['content'],true) : [];//传true返回的不是对象，而是数组
        //p($model);
        //载入模板，我们需要通过页面填写配置内容
        return View::make()->with(compact('model'));
    }


    public function userLists(){
        $data = userModel::get();
        return View::make()->with(compact('data'));
    }

    public function addUser(){
        $username = Session::get('user.username');
        //echo $username;
        if(IS_POST){
            echo 123;
            $post = Request::post();
            //1、检测用户是否已经存在
            $model = userModel::where('username',$post['username'])->first();
            if($model){
                return [ 'valid' => false, 'message' => '用户名已存在' ];
            }
            //2、检测密码是否是否少于6位
            if(strlen($post['password']) < 6){
                return [ 'valid' => false, 'message' => '密码过于简单，不得少于6位' ];
            }
            //3、检测两次密码是否一致
            if($post['password']!=$post['password1']){
                return [ 'valid' => false, 'message' => '两次密码不一致' ];
            }

            //3、添加用户到数据库

        }
        return View::make();
    }

    public function removeUser(){

    }

    public function changePassword(){
        if (IS_POST){
            //获得用户输入的数据
            $data = Request::post();
            //echo strlen($data['password']);
            //p($data);
            //1、判断新密码是否为空，密码不少于6位
            if(strlen($data['password1']) < 6){
                return [ 'valid' => false, 'message' => '密码长度不得少于6位' ];
            }
            //2、判断两次密码是否一致
            if($data['password1']!=$data['password2']){
                return [ 'valid' => false, 'message' => '两次密码不一致' ];
            }
            //3、判断旧密码是否输入正确
            //获得数据库数据(获得一个对象)，这里分成两步来查询数据，因为下面我们需要用到对象来调用save方法，完成密码的修改
            $model = userModel::find(Session::get('user.uid'));
            $userData = $model->first();
            //p($userData['password']);
            //判断旧密码是否正确，如果不正确，就提示用户密码错误
            if(!password_verify($data['password'],$userData['password'])){
                return ['valid' => false,'message' => '旧密码输出有误，重新输入'];
            }
            //4、修改密码，通过验证之后，需要将修改后的密码存入数据库中
            $model -> password = password_hash($data['password1'],PASSWORD_DEFAULT);
            //调用save方法，完成数据的修改
            $model -> save();
            //修改密码退出登录
            Session::flush();
            return [ 'valid' => true, 'message' => '修改成功，您需要重新登录' ];

        }
        return View::make();
    }




}
