<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */
namespace Common4hiano\Curd;

trait UpdateAction{
    
    /**
     * @return \Hitar\RecordBase Description
     */
    abstract function getModel();
    
    abstract function getDataForUpdate();
    
    abstract function getFormDataFromRecord($record);
    
    function getReadyDataForUpdate(){
        return array();
    }
    
    function updateAction(){
        $record = $this->getModel();
        if($this->request->isPost()){
            $data = $this->getDataForUpdate();
            $record->assign($data);
            $record->save();
            \Hiano\App\App::redirectRequest();
        }else{
            $data = $this->getFormDataFromRecord($record);
        }
        $this->view->set('data',$data);
        $this->view->set($this->getReadyDataForUpdate());
    }
    
}