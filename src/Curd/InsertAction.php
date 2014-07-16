<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace Common4hiano\Curd;

trait InsertAction {

    abstract function getInitModelForInsert();

    abstract function insertModel();

    function getReadyDataForInsert() {
        return array();
    }

    function insertAction() {
        if ($this->request->isPost()) {
            $this->insertModel();
            \Hiano\App\App::redirectRequest('list');
        } else {
            $this->view->set('model', $this->getInitModelForInsert());
            $this->view->set($this->getReadyDataForInsert());
        }
    }

}
