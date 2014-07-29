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
    
    function afterSelectOfList($list){
        
    }

    function listAction() {
        if ($this->request->isPost()) {
            \Hiano\App\App::redirectPostAsParameter();
        }
        $tb = $this->getTableForList();
        /* @var $tb \Hitar\Table */
        $list =  $tb->select();
        $this->view->set('list',$list);
        $this->afterSelectOfList($list);
    }

}
