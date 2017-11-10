<?php
namespace addons\search\system;
class Tag{
    public function keywords($attr,$content){
        $rows = isset($attr['rows']) ? $attr['rows'] : 10000;
        $str = <<<str
<?php
\$keywordsData = Db::table('search_keywords')->orderBy('times','desc')->limit($rows)->get();
foreach(\$keywordsData as \$field):
?>
{$content}
<?php endforeach ?>
str;
        return $str;
    }
}