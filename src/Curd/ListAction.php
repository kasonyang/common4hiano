<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace Common4hiano\Curd;

trait ListAction {

    /**
     * @return \Hitar\Table Description
     */
    abstract function getTableForList();

    function listAction() {
        if ($this->request->isPost()) {
            \Hiano\App\App::redirectPostAsParameter();
        }
        $tb = $this->getTableForList();
        /* @var $tb \Hitar\Table */
        $this->view->set('list', $tb->select());
    }

}
