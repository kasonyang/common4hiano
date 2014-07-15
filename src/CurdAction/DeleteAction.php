<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */
namespace Common4hiano\CurdAction;

trait DeleteAction{
    abstract function getModel();
    abstract function onDeleteSuccess();
            
    function deleteAction(){
        if($this->request->isPost()){
            /* @var $model \Hitar\RecordBase */
            $model = $this->getModel();
            $model->delete();
            $this->onDeleteSuccess();
        }
        return false;
    }
}