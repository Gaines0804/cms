<?php namespace system\tag;

use houdunwang\request\Request;
use houdunwang\view\build\TagBase;
use system\model\Category;
use system\model\Modules;

class Common extends TagBase
{
    /**
     * 标签声明
     * @var array
     */
    public $tags = [
        'line' => ['block' => false],   //单标签
        'tag' => ['block' => true, 'level' => 4],    //快标签（对标签）
        'navigation' => ['block' => true, 'level' => 4],  //导航扩展标签
        'slide' => ['block' => true, 'level' => 4],  //轮播图扩展标签
        'category' => ['block' => true, 'level' => 4],   //栏目标签
        'arc' => ['block' => true, 'level' => 4],    //文章标签
        'hot_clicks' => ['block' => true, 'level' => 4],    //热门文章标签
        'newArc' => ['block' => true, 'level' => 4],    //最新文章标签
        'randoms' => ['block' => true, 'level' => 4],    //随机文章
        'next' => ['block' => false],    //下一篇标签
        'prev' => ['block' => false],     //上一篇标签
    ];

    public function _slide($attr, $content, &$view)
    {
        $str = <<<str
<?php
\$slideData = \system\model\Slide::get();
\$slideData = \$slideData ? \$slideData->toArray() : [];
foreach(\$slideData as \$field): 
\$field['thumb'] = __ROOT__ . '/' . \$field['thumb'];
?>
{$content}
<?php endforeach ?>
str;
        return $str;
    }

    /**
     * 导航条区域
     * @param $attr
     * @param $content
     * @param $view
     * @return string
     */
    public function _navigation($attr, $content, &$view)
    {
        $rows = isset($attr['rows']) ? $attr['rows'] : 1000;
        //组合php代码，执行循环体，在页面中只需要通过标签调用就能实现循环导航条
        $str = <<<str
<?php
\$cateData = \system\model\Category::where("pid",0)->limit($rows)->get();
\$cateData = \$cateData ? \$cateData->toArray() : [];
foreach(\$cateData as \$field): 
?>
{$content}
<?php endforeach ?>
str;
        return $str;
    }


    //栏目标签
    public function _category($attr, $content, &$view)
    {
        //获得对应id，有可能需要传入参数，来显示对应的栏目数据
        $cid = isset($attr['cid']) ? $attr['cid'] : null;
        $pid = isset($attr['pid']) ? $attr['pid'] : null;
//        dd($pid);
        //组合where条件：
        //1、同时传参cid和pid
        //2、只传cid或者pid
        //3、两者都不传
        $cidWhere = isset($cid) ? " and cid={$cid}" : '';
        $pidWhere = isset($pid) ? " and pid={$pid}" : '';
//        if ($cidWhere && $pidWhere) {
//            $where = $pidWhere . 'and' . $cidWhere;
//        } elseif ($cidWhere) {
//            $where = $cidWhere;
//        } elseif ($pidWhere) {
//            $where = $pidWhere;
//        } else {
//            $where = "1=1";
//        }

        $where =  '1=1';
//        dd($cid);
        if(!empty($cidWhere)){
            $where = $where . $cidWhere;
        }

        if (!empty($pidWhere)){
            $where = $where . $pidWhere;
        }


//        dd($where);
        //截取条数，如果存在用户传入数据条数，那么就优先使用（显示对应的数据条数），否则就显示10000（也就是全部显示）
        $rows = isset($attr['rows']) ? $attr['rows'] : 10000;
        $str = <<<str
<?php
\$cateData = \system\model\Category::where("$where")->limit($rows)->get();
\$cateData = \$cateData ? \$cateData->toArray() : [];
foreach(\$cateData as \$field):
\$field['url'] = __ROOT__ . '/c_' . \$field['cid'] . '.html';
?>
{$content}
<?php endforeach;?>
str;
        return $str;
    }

    //文章标签
    public function _arc($attr, $content, &$view)
    {
        $cid = isset($attr['cid']) ? $attr['cid'] : Request::get('cid');
        $where1 = $cid ? "category_cid={$cid} and isrecycle=0" : "isrecycle=0";
        //推荐是否存在
        $where = isset($attr['commend']) ? $where1 .' and iscommend='. $attr['commend'] : $where1;
        //echo $where;
        //从哪里开始截取
        $from = isset($attr['from']) ? $attr['from'] : 0;
        //截取条数
        $rows = isset($attr['rows']) ? $attr['rows'] : 10000;


        $str = <<<str
<?php
\$arcModel = \system\model\Article::where('$where')->limit($from,$rows)->get();
\$arcData = \$arcModel ? \$arcModel->toArray() : [];
\$num = 0;
foreach(\$arcData as \$field): 
\$num++;
\$field['num'] = \$num;
\$field['thumb'] = __ROOT__ . '/' . \$field['thumb'];
\$field['url'] = __ROOT__ . '/a_' . \$field['aid'] . '.html';
 ?>
{$content}
<?php endforeach;?>
str;
        return $str;

    }

    //上一篇
    public function _prev($attr, $content, &$view)
    {
        //获得当前文章的aid
        $aid = Request::get('aid');

        //组合php代码，在页面输出
        $str = <<<str
<?php
\$prev = \system\model\Article::where('aid<{$aid}')->orderby('aid','DESC')->first();
if(\$prev):
?>
<a href="<?php echo __ROOT__ . '/a_' . \$prev['aid'] . '.html' ?>"><?php echo \$prev['title'];?></a>
<?php else: ?>
这已经是第一篇了
<?php endif ?>
str;
        return $str;
    }


    //下一篇
    public function _next($attr, $content, &$view)
    {
        $aid = Request::get('aid');
        $str = <<<str
<?php
\$next = \system\model\Article::where('aid>{$aid}')->orderby('aid','ASC')->first();
if(\$next):
?>
<a href="<?php echo __ROOT__ . '/a_' . \$next['aid'] . '.html' ?>" ><?php echo \$next['title']; ?></a>
<?php else: ?>
这已经是最后一篇了
<?php endif ?>
str;

        return $str;

    }

    //热门标签
    public function _hot_clicks($attr, $content, &$view)
    {
        $rows = isset($attr['rows']) ? $attr['rows'] : 10000;
        //echo $rows;
        $str = <<<str
<?php
\$arcData = \system\model\Article::join('category','category_cid','=','cid')->field('*,article.created_at as arc_at')->orderBy('click','DESC')->limit($rows)->get();
\$arcData = \$arcData ? \$arcData->toArray() : [];
foreach(\$arcData as \$field): 
\$field['num'] = \$num;
\$field['thumb'] = __ROOT__ . '/' . \$field['thumb'];
\$field['a_url'] = __ROOT__ . '/a_' . \$field['aid'] . '.html';
\$field['c_url'] = __ROOT__ . '/c_' . \$field['cid'] . '.html';
 ?>
{$content}
<?php endforeach;?>
str;
    return $str;
    }

    //最新文章
    public function _newArc($attr, $content, &$view)
    {
        $rows = isset($attr['rows']) ? $attr['rows'] : 10000;
        //echo $rows;
        $str = <<<str
<?php
\$newData = \system\model\Article::orderBy('time','DESC')->paginate($rows);
\$arcData = \$newData ? \$newData->toArray() : [];
foreach(\$arcData as \$field): 
\$field['num'] = \$num;
\$field['thumb'] = __ROOT__ . '/' . \$field['thumb'];
\$field['a_url'] = __ROOT__ . '/a_' . \$field['aid'] . '.html';
\$field['c_url'] = __ROOT__ . '/c_' . \$field['cid'] . '.html';
 ?>
{$content}
<?php endforeach;?>
str;
        return $str;
    }


    //randoms 随机文章标签
    public function _randoms($attr, $content, &$view)
    {
        $str = <<<str
<?php
\$random = \system\model\Article::where('ishot',1)->limit(5)->get();
\$ranData = \$random ? \$random->toArray() : [];
foreach (\$ranData as \$field):
\$field['url'] = __ROOT__ . '/a_' . \$field['aid'] . '.html';
?>
{$content}
<?php endforeach;?>
str;
    return $str;
    }



    //line 标签
    public function _line($attr, $content, &$view)
    {
        return 'link标签 测试内容';
    }

    //调用插件的标签（获得插件数据）
    public function _tag($attr, $content, &$view)
    {
        static $obj = [];
        //p($attr['action']);
        //获得参数，转换为数组
        $arr = explode('.',$attr['action']);
        //p($info);exit;
        //组合类名
        //echo $arr[0];exit;
        //p($info);
        $className = (Modules::where('name', $arr[0])->pluck('is_system') ? 'modules' : 'addons') . '\\' . $arr[0] . '\system\Tag';
        //echo $className;exit;
        if(!isset($obj[$className])){
            $obj[$className] = new $className;
        }
//        dd($obj[$className]);exit;
        return call_user_func_array([$obj[$className], $arr[1]], [$attr, $content]);
        //exit;
//
    }
}