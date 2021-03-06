<?php
/**
 * Created by PhpStorm.
 * User: vaniot
 * Date: 18-3-26
 * Time: 下午3:14
 */
namespace core;

use core\View;    //使用视图类
use core\traits\Jump;    //新增语句
/**
 * 控制器基类
 */
class Controller
{
    use Jump;
    protected $vars = [];    //模板变量
    protected $tpl;        //视图模板

    //变量赋值
    final protected function assign($name,$value = '')
    {
        if (is_array($name)) {
            $this->vars = array_merge($this->vars,$name);
            return $this;
        } else {
            $this->vars[$name] = $value;
        }
    }
    //设置模板
    final public function setTpl($tpl='')
    {
        $this->tpl = $tpl;
    }
    //模板展示
    final protected function display()
    {
        $view = new View($this->vars);    //调用视图类
        $view->display($this->tpl);    //视图类展示方法
    }
}