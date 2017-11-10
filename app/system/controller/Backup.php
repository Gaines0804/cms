<?php namespace app\system\controller;

use houdunwang\route\Controller;
use houdunwang\backup\Backup as BackupService;

class Backup extends Controller{
    /**
     * 备份列表
     */
    public function lists(){
        $dirs = BackupService::getBackupDir('backup');
        //p($dirs);
        return view('',compact('dirs'));
    }

    /**
     * 开始备份
     */
    public function start(){
        $config = [
            'size' => 2,//分卷大小单位KB
            'dir'  => 'backup/' . date( "Ymdhis" ),//备份目录
        ];
        $status = BackupService::backup( $config, function ( $result ) {
            if ( $result['status'] == 'run' ) {
                //备份进行中
                $res = $result['message'];
                //在页面显示备份过程
                echo view('',compact('res'));
                //刷新当前页面继续下次
                echo "<script>setTimeout(function(){location.href='{$_SERVER['REQUEST_URI']}'},100);</script>";
            } else {
                //备份执行完毕
                return $this->setRedirect(u('lists'))->success($result['message']);
            }
        } );
        if($status===false){
            //备份过程出现错误
            echo  BackupService::getError();
        }

        return view('');
    }

    /**
     * 删除备份
     */
    public function remove(){
        //删除指定路径的备份目录，通过get参数控制
        Dir::del(Request::get('path'));
        return $this->setRedirect(u('lists'))->success('删除成功');
    }

    /**
     * 还原备份
     */
    public function recovery() {
        //要还原的备份目录
        $config = [ 'dir' => Request::get('path') ];
        $status = BackupService::recovery( $config, function ( $result ) {
            if ( $result['status'] == 'run' ) {
                //还原进行中
                $res = $result['message'];
                //刷新当前页面继续下次
                echo view('',compact('res'));
                exit;
            } else {
                //还原执行完毕
                echo $this->setRedirect( 'lists' )->success( $result['message'] );
                //因为在闭包中，所以要用exit代替return
                exit;
            }
        } );
        if ( $status === false ) {
            //还原过程出现错误
            echo BackupService::getError();
        }
    }
}
