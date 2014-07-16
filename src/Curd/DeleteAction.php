<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace Common4hiano\Curd;

trait DeleteAction {

    abstract function getRequestModel();

    abstract function onDeleteSuccess();

    function deleteAction() {
        if ($this->request->isPost()) {
            /* @var $model \Hitar\RecordBase */
            $model = $this->getRequestModel();
            $model->delete();
            $this->onDeleteSuccess();
        }
        return false;
    }

}
