<?php
namespace addons\links\system;

class Tag{
    public function lists($attr,$content){
        $rows = isset($attr['rows']) ? $attr['rows'] : 10000;
        $str = <<<str
<?php
\$linksData = \addons\links\model\Links::orderBy('orderby','ASC')->limit($rows)->get();
\$links = \$linksData ? \$linksData->toArray() : [];
foreach(\$linksData as \$field):
?>
{$content}
<?php endforeach ?>
str;


        return $str;
    }

//    public function index(){
//        return 'index';
//    }
}