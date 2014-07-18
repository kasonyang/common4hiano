<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace Common4hiano\Curd;

trait InsertAction {

    abstract function getInitModelForInsert();

    abstract function completeModelForInsert($model);

    function getReadyDataForInsert() {
        return array();
    }

    function insertAction() {
        $model = $this->getInitModelForInsert();
        if ($this->request->isPost()) {
            $this->completeModelForInsert($model);
            $model->save();
            \Hiano\App\App::redirectRequest('list');
        } else {
            $this->view->set('model', $model);
            $this->view->set($this->getReadyDataForInsert());
        }
    }

}
