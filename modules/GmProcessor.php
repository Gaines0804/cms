<?php
/**
 * Created by PhpStorm.
 * User: Adminstrator
 * Date: 2017/7/13
 * Time: 21:31
 */

namespace modules;


class GmProcessor
{
    public function __call( $name, $arguments ) {
        $instance = WeChat::instance( 'message' );
        call_user_func_array([$instance,$name],$arguments);
    }
}