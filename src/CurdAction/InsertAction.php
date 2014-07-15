<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */
namespace Common4hiano\CurdAction;

trait InsertAction {
    
    /**
     * @return \Hitar\Table Description
     */
    abstract function getInsertTable();
    
    function getFormDataForInsert(){
        return array();
    }
    
    function getReadyDataForInsert(){
        return array();
    }
    
    abstract function getDataForInsert();
    function insertAction(){
        if($this->request->isPost()){
            $data = $this->getDataForInsert();
            $this->getInsertTable()->insert($data);
            \Hiano\App\App::redirectRequest('list');
        }else{
            $this->view->set('data',$this->getFormDataForInsert());
            $this->view->set($this->getReadyDataForInsert());
        }
    }
}