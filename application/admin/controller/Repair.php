<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 11:34
 */

namespace app\admin\controller;


use think\Db;
use think\Request;
use think\Validate;

class Repair extends Admin{

    //添加报修
    public function add()
    {


        if(request()->isPost()){


            $Repair = model('Repair');

            $post_data=\think\Request::instance()->post();
            //自动验证
            $validate = validate('repair');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }
            $data = $Repair->create($post_data);

            if($data){
                $this->success('新增成功', url('index'));
                //记录行为
                action_log('update_repair', 'repair', $data->id, UID);
            } else {
                $this->error($Repair->getError());
            }
            //dump($post_data);die;
           // dump(1);die;
        } /*else {
            $pid = input('pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = \think\Db::name('Repair')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }*/

            //$this->assign('pid', $pid);
            //$this->assign('info',null);
            $this->assign('meta_title', '新增报修');
            return $this->fetch('edit');

    }

    //添加报修
    public function index()
    {
        /* 获取频道列表 */
       // $map  = array('status' => array('gt', -1));
        $list = Db::name('Repair')->order('id asc')->select();
        $this->assign('list', $list);
        $this->assign('meta_title' , '保修管理');
        return $this->fetch();

    }
    //修改
    public function edit($id = 0)
    {
        if($this->request->isPost()){
            $postdata = Request::instance()->post();

            //自动验证
            $validate = validate('repair');
            if(!$validate->check($postdata)){
                return $this->error($validate->getError());
            }

            $Repair = Db::name("repair");
            $data = $Repair->update($postdata);
            if($data !== false){
                $this->success('编辑成功', url('index'));
            } else {
                $this->error('编辑失败');
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = Db::name('Repair')->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }


            /*//获取父导航
            if(!empty($pid)){
                $parent = \think\Db::name('Channel')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }*/

            //$this->assign('pid', $pid);
            $this->assign('info', $info);
            $this->meta_title = '编辑导航';
            return $this->fetch();
        }


    }
    //删除
    public function del()
    {
        $id = array_unique((array)input('id/a',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(Db::name('repair')->where($map)->delete()){
            //记录行为
            action_log('update_repair', 'repair', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }

    }

}