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
    abstract function getTable();
    
    /**
     * 
     * @param \Hitar\Table $table
     */
    function filterTableForList(&$table){
        //do nothing
    }
            
    function listAction(){
        if($this->request->isPost()){
            \Hiano\App\App::redirectPostAsParameter();
        }
        $tb = $this->getTable();
        $this->filterTableForList($tb);
        /* @var $tb \Hitar\Table */
        $this->view->set('list', $tb->select());
    }
    
}