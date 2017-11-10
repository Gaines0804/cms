<?php namespace app\modules\controller;

use houdunwang\database\Schema;
use houdunwang\dir\Dir;
use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Modules as modulesModel;
use houdunwang\validate\Validate;
use system\model\Keywords;

class Modules extends Controller{

    public function getModules(){
        /**
         * 分配第三方模块数据
         */
        $modules = modulesModel::where('is_system',0)->get();
        View::with( compact( 'modules' ) );
    }

    /**
     * 模块列表
     * @return mixed
     */
    public function lists(){
        //获得模块目录结构信息
        $data = Dir::tree('addons');
        //p($data);
        //获得第三方已经安装过的插件的英文标识（name值）
        $model = modulesModel::where('is_system',0)->lists('name'); //pluck只能获得第一条，而lists可以获得所有name值
        //p($model);
        //循环设计好的插件信息，我们需要获得对应的json文件里面的内容
        foreach ($data as $k => $v){
            $fileName = "addons/" . $v['filename'] .'/package.json';
            //p($file);
            $arr = json_decode(file_get_contents($fileName),true);
            //判断是否已经安装，如果安装过，那么就添加一个标识
            $arr['installed'] = in_array($v['filename'],$model) ? 1:0;
            //p($arr);
            //将标记过后的值替换原来的数据
            $data[$k] = $arr;
        }
        //p($data);
        //获得数据库中模块信息
        $this->getModules();
        return view('',compact('data'));
    }

    /**
     * 设计模块
     * 将数据添加到数据中，同时创建模块目录
     * @return mixed
     */
    public function design(){
        if(IS_POST){
            //获得post提交过来的值
            $post = Request::post();
            //p($post);
            //1、判断模块标识是否符合规范，即模块标识只能以字母开头
            //这里需要先验证，如果我们将验证放在最后的话，那么就会先创建目录，然后才验证，要是验证不通过，其实已经创建了目录，数据库中并没有数据，就会导致目录与数据库不统一
            $res = Validate::make( [
                [ 'name', 'regexp:/^[a-zA-Z]\w+$/ ', '模块标识由字母、数字、下划线组成（但只能以字母开头）', Validate::MUST_VALIDATE ]
            ] ,$post);
            if($res===false){
                print_r(Validate::getError());
            }

            //模块标识
            $name = $post['name'];
            //2、检测是否存在模块目录，如果存在，那么就不需要创建
            if(is_dir("addons/{$name}")){
                return $this->error('该模块目录已经存在');
            }

            //3、检测数据库中是否存在模块，如果能从数据库中查询到对应name值的数据，说明数据库中已经存在数据
            $data = modulesModel::where("name",$name)->first();
            if($data){
                return $this->error('该模块已经存在');
            }



            //4、创建模块目录，调用createDir方法创建对应的模块目录
            $this->createDir($name);

            //5、保存模块信息，
            file_put_contents("addons/".$name . '/package.json',json_encode($post,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

            //提示跳转
            return $this->setRedirect(u('lists'))->success('设计模块成功');
        }
        //获得数据库中模块信息
        $this->getModules();
        return View::make();
    }

    public function install(){
        //获得json文件内容，我们需要将json文件里面的内容存入数据库中
        $jsonFile = "addons/".Request::get('name')."/package.json";
        //echo $jsonFile;
        $post = json_decode(file_get_contents($jsonFile,true),true);
        //p($post);
        //将数据填入数库中
        $model = new modulesModel();
//        //p($model);
        $model->save($post);
        //创建插件表
        if($post['sql']) Schema::sql($post['sql']);
        return $this->setRedirect(u('lists'))->success('安装成功');
    }

    /**
     * 创建文件目录和文件
     * @param $name
     */
    public function createDir($name){
        //echo $name;
        //列出我们需要创建的文件目录
        $dir = [
            'controller',
            'model',
            'system',
            'template'
        ];
        //循环创建目录
        foreach ($dir as $d){
            //判断目录是否已经存在，如果存在就不创建，否则就创建目录
            is_dir($name) || mkdir("addons/{$name}/$d",0777,true);
        }

        //获得文件的路径（包含文件名）
        $fileName = "addons/".$name."/system/Processor.php";
        //echo $fileName;

        //组合文件内容
        $str = <<<str
<?php
namespace addons\\{$name}\system;
use modules\GmController;
class Processor extends GmController {

}
str;
        //创建Processor.php文件，并将内容写入文件中
        file_put_contents($fileName, $str);


        //组合文件内容
        $str = <<<str
<?php
namespace addons\\{$name}\controller;
use modules\GmController;
class Entry extends GmController{
    public function index(){
        
    }
}
str;
        //创建Entry.php文件，并将内容写入文件中
        file_put_contents("addons/".$name."/controller/Entry.php", $str);



    }


    /**
     * 删除（卸载）模块
     */
    public function uninstall(){

        //获得目录名
        $name = Request::get('name');
        //1、删除数据库中的数据
        modulesModel::where('name',$name)->delete();

        //2.删除关键词表的数据（我们添加关键词的时候会选择所属模块，如果模块都没有了，那么关键词就没有了对应模块，关键词也就没意义了）
        Keywords::where( "module", $name )->delete();

        //3、删除指定的目录
        //Dir::del('addons/'.$name);

        return $this->setRedirect('lists')->success('卸载成功');
    }
}
