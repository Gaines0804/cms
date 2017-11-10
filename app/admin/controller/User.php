<?php namespace app\admin\controller;

use houdunwang\session\Session;
use houdunwang\view\View;
use system\model\User as userModel;

class User extends Common{
    //登录方法
    public function login(){
        //echo password_hash('admin',PASSWORD_DEFAULT);
        if(IS_POST) {

            //获得post提交过来的数据
            $data = Request::post();
            //获得用户输入的用户名，并去除两边的空白字符
            $username = trim($data['username']);
            //获得用户输入的密码，并去除两边的空白字符
            $password = trim($data['password']);
            //p($data);



            //1、判断用户名和密码是否为空
            if(empty($username) || empty($password)){
                //array('valid'=>true,'message'=>"ok")
                return ['valid'=>false,'message'=>"用户名或密码不能为空"];
            }


            //Db::table('user')->where('username','向军')->first();
            $userData = userModel::where('username',$username)->first();
            //p($userData['username']);
            //2、检测用户名是否正确
            //获得数据，如果能够查询到对用用户名的数据，那么说明用户名正确，反之，如果查询不到，就说明用户名不存在
            if(!$userData){
                return [ 'valid' => false, 'message' => '用户名不存在' ];
            }
            //3、检测密码是否正确，如果用户输入的密码和加密后的密码不一致
            if (!password_verify($password,$userData['password'])){
                return [ 'valid' => false, 'message' => '密码输入有误' ];
            }
            //4、登录成功之后，将用户信息存入session。之后我们需要使用session来判断是否登录
            Session::set('user',['username'=>$username,'uid'=>$userData['uid']]);
            //5、提示登陆成功
            return [ 'valid' => true, 'message' => '登陆成功' ];
        }
        //载入模板
        return View::make();
    }

    public function logout(){
        //清除session，并跳转到登录页面
        Session::flush();
        return $this->setRedirect(__ROOT__.'/login')->success('退出成功');
    }
}
