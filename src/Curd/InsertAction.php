<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace Common4hiano\Curd;

trait InsertAction {

    /**
     * @return \Hitar\Table Description
     */
    abstract function getTable();

    abstract function getDataForInsert();

    function getFormDataForInsert() {
        return array();
    }

    function getReadyDataForInsert() {
        return array();
    }

    function insertAction() {
        if ($this->request->isPost()) {
            $data = $this->getDataForInsert();
            $this->getTable()->insert($data);
            \Hiano\App\App::redirectRequest('list');
        } else {
            $this->view->set('data', $this->getFormDataForInsert());
            $this->view->set($this->getReadyDataForInsert());
        }
    }

}
