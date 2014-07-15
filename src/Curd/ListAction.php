<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */
namespace Common4hiano\Curd;

trait ListAction{
    
    /**
     * @return \Hitar\Table Description
     */
    abstract function getListTable();
            
    function listAction(){
        /* @var $this \Hiano\Controller\Controller */
        if($this->request->isPost()){
            \Hiano\App\App::redirectPostAsParameter();
        }
        $tb = $this->getListTable();
        /* @var $tb \Hitar\Table */
        $this->view->set('list', $tb->select());
    }
    
}