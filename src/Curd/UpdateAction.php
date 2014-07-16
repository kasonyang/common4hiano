<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace Common4hiano\Curd;

trait UpdateAction {

    abstract function getRequestModel();

    abstract function updateModel($model);

    function getReadyDataForUpdate() {
        return array();
    }

    function updateAction() {
        $record = $this->getRequestModel();
        if ($this->request->isPost()) {
            $this->updateModel($record);
            \Hiano\App\App::redirectRequest();
        }
        $this->view->set('model', $record);
        $this->view->set($this->getReadyDataForUpdate());
    }

}
