<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace Common4hiano\Curd;

trait InsertAction {

    abstract function getInitModelForInsert();

    abstract function completeModelForInsert($model);
    
    function afterInsert($model){
        \Hiano\App\App::redirectRequest('list');
    }

    function getReadyDataForInsert() {
        return array();
    }

    function insertAction() {
        $model = $this->getInitModelForInsert();
        $this->view->set('model', $model);
        if ($this->request->isPost()) {
            try{
                $this->completeModelForInsert($model);
            } catch (InputException $ex) {
                $this->view->set($this->getReadyDataForInsert());
                $this->error($ex->getMessage());
            }
            $model->save();
            $this->afterInsert($model);
        } else {
            $this->view->set($this->getReadyDataForInsert());
        }
    }

}
