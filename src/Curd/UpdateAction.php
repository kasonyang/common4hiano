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

    function updateAction() {
        $record = $this->getRequestModel();
        if ($this->request->isPost()) {
            $this->completeModelForUpdate($record);
            $record->save();
            \Hiano\App\App::redirectRequest();
        }
        $this->view->set('model', $record);
        $this->view->set($this->getReadyDataForUpdate());
    }

}
