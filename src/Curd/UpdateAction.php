<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace Common4hiano\Curd;

trait UpdateAction {

    abstract function getRequestModel();

    abstract function completeModelForUpdate($model);

    function getReadyDataForUpdate() {
        return array();
    }
    
    function afterUpdate($model){
        \Hiano\App\App::redirectRequest('list');
    }
    
    function updateAction() {
        $record = $this->getRequestModel();
        $this->view->set('model', $record);
        if ($this->request->isPost()) {
            try{
                $this->completeModelForUpdate($record);
            }  catch (\Common4hiano\Curd\InputException $e){
                $this->view->set($this->getReadyDataForUpdate());
                $this->error($e->getMessage());
            }
            $record->save();
            $this->afterUpdate($record);
        }
        $this->view->set($this->getReadyDataForUpdate());
    }

}
