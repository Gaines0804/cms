<?php namespace app\system\controller;

use houdunwang\database\Schema;
use houdunwang\dir\Dir;
use houdunwang\route\Controller;
use houdunwang\validate\Validate;
use PHPUnit\Runner\Exception;
use system\model\User;

class Install extends Controller{

    public function __construct()
    {
        //我们需要在开始就检测是否已经安装
        $this->isInstalled();
    }

    /**
     * 检测是否已经安装过了
     * @return mixed
     */
    public function isInstalled(){
        //这里我们通过一个文件lock.php来作为安装的标识，如果安装了那么就会生成lock.php
        //如果文件存在，说明已经安装过了
        if(is_file('lock.php')){
            //这里需要传参，因为我们只要一执行copyright方法就会触发构造方法，执行这里的代码，但实际默认载入的模板是地址栏参数对应的copyright.php，所以需要指定模板
            return view('isInstalled');
        }
    }

    /**
     * 版权信息
     * @return mixed
     */
    public function copyright(){
        return view();
    }

    /**
     * 环境监测
     * @return mixed
     */
    public function environmental(){
        //p($_SERVER);exit;
        //获得php版本信息，需要在页面显示php版本，还需要判断是否符合我们的cms系统
        $data['php_version'] = PHP_VERSION;
        //检测php版本是否符合
        $data['version'] = version_compare($data['php_version'],'5.6','>');
        //获得服务器信息
        $data['server_software'] = $_SERVER['SERVER_SOFTWARE'];
        //检测pdo扩展是否安装，如果为真，返回1，否则返回0
        $data['pdo'] = extension_loaded('pdo');
        //检测curl扩展是否安装，如果为真，返回1，否则返回0
        $data['curl'] = extension_loaded('curl');
        //检测gd扩展是否安装，如果为真，返回1，否则返回0
        $data['gd'] = extension_loaded('gd');
        //p($data);

        return view('',compact('data'));
    }

    public function database(){
        if(IS_POST){
            //获得用户提交的数据
            $post = Request::post();
            //p($post);exit;
            //1、检测输入是否为空
            Validate::make( [
                [ 'host', 'required', '主机地址不能为空', Validate::MUST_VALIDATE ],
                [ 'user', 'required', '用户名不能为空', Validate::MUST_VALIDATE ],
                [ 'password', 'required', '密码不能为空', Validate::MUST_VALIDATE ],
                [ 'database', 'required', '数据库名称不能为空', Validate::MUST_VALIDATE ],
            ] );
            //2、如果验证通过，那么就执行连接数据库
            try{
                $dsn = "mysql:host={$post['host']};dbname={$post['database']}";
                $pdo = new \PDO($dsn,$post['user'],$post['password']);


                //创建一个data目录，我们需要将用户输入的信息保存到data目录下面的database.php文件中
                Dir::create('data');
                file_put_contents('data/database.php',"<?php\r\nreturn ".var_export($post,true).";\r\n?>");
            }catch (Exception $e){
                //接受异常错误，通过框架自带的方式输出
                return $this->error($e->getMessage());
            }
            return $this->success('连接成功');
        }
        return view();
    }

    public function tables(){
        //获得sql文件
        $sql = file_get_contents('./cms.sql');
        //p($sql);exit;
        //执行迁移，我们需要创建数据库表
        //cli('hd migrate:make');
        //给用户表填入数据，不然那用户无法登陆

        //我们之前已经将数据保存到文件中了，这可以直接获得数据
        $post = include "data/database.php";
        //填写默认数据
        $sql = str_replace(['CREATE TABLE `','INSERT INTO `'],['CREATE TABLE `'.$post['prefix'],'INSERT INTO `'.$post['prefix']],$sql);
        //p($sql);exit;
        //执行sql文件，创建数据表和填充默认数据
        Schema::sql($sql);


        $model = new User();
        //获得用户名
        $model['username'] = $post['admin_username'];
        //获得加密后的密码
        $model['password'] = password_hash($post['admin_password'],PASSWORD_DEFAULT);
        //($data);
        //保存到用户表中
        $model->save();
        go('system/install/finish');
    }

    public function finish(){
        //如果连接成功，说明已经生成database.php文件，那么存在database.php文件，我们就可以进行之后的操作了
        if(is_file('data/database.php')){
            //创建标识，表名已经安装成功
            file_put_contents('lock.php','');
        }
        //提示信息
        return view();
    }
}
