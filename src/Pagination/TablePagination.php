<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace Common4hiano\Pagination;

class TablePagination{

    private $_name, $_page, $_total, $_size = 20, $_max_button_count = 5;
    private $buttons;

    /**
     *
     * @var \Hitar\Table
     */
    private $table;

    private function getPageLink($page) {
        $arr = \Hiano\App\App::getRequest()->getParameter();
        $arr[$this->_name] = $page;
        return \Hiano\App\App::getRouter()->format($arr);
    }

    function getButtons() {
        $btn = $this->buttons;
        $page_count = $this->getPageCount();
        $bt_count = min($page_count, $this->getMaxButtonCount());
        $page = $this->_page;

        if ($page <= ceil($bt_count / 2)) {
            $first = 1;
            $last = $bt_count;
        } elseif ($page_count - $page <= ceil($bt_count / 2)) {
            $first = $page_count - $bt_count + 1;
            $last = $page_count;
        } else {
            $first = $page - ceil($bt_count / 2) + 1;
            $last = $first + $bt_count - 1;
        }
        $params = \Hiano\App\App::getRequest()->getParameter();
        if ($page < 2) {
            $btn['first']['href'] = '';
            $btn['prev']['href'] = '';
        } else {
            $params[$this->_name] = 1;
            $btn['first']['href'] = $this->getPageLink(1);
            $btn['prev']['href'] = $this->getPageLink($page - 1);
        }
        for ($i = $first; $i <= $last; $i++) {
            $btn['num'][] = array(
                'caption' => $i,
                'href' => $page == $i ? '' : $this->getPageLink($i)
            );
        }

        if ($page >= $page_count) {
            $btn['next']['href'] = '';
            $btn['last']['href'] = '';
        } else {
            $btn['next']['href'] = $this->getPageLink($page + 1);
            $btn['last']['href'] = $this->getPageLink($page_count);
        }
        return $btn;
    }

    /**
     * 
     * @param \Hitar\Table $table
     * @param string $name
     */
    function __construct($table, $name = 'page') {
        $this->table = $table;
        $this->_name = $name;
        $this->_page = intval(\Hiano\App\App::getRequest()->getParameter($name));
        if ($this->_page < 1)
            $this->_page = 1;
        $this->buttons = array(
            'first' => array('href' => '', 'caption' => '首页'),
            'prev' => array('href' => '', 'caption' => '上页'),
            'next' => array('href' => '', 'caption' => '下页'),
            'last' => array('href' => '', 'caption' => '末页'),
        );
    }

    function getOffset() {
        return ($this->_page - 1) * $this->_size;
    }

    function getPageCount() {
        return ceil($this->getTotal() / $this->_size);
    }

    function getPage() {
        return $this->_page;
    }

    function getSize() {
        return $this->_size;
    }

    function setSize($size) {
        $this->_size = $size;
    }

    function getTotal() {
        if (!isset($this->_total)) {
            $this->_total = $this->table->count();
        }
        return $this->_total;
    }

    function selectData() {
        return $this->table->selectData($this->_size, $this->getOffset());
    }

    function select() {
        return $this->table->select($this->_size, $this->getOffset());
    }

    function getMaxButtonCount() {
        return $this->_max_button_count;
    }

    function setMaxButtonCount($count) {
        $this->_max_button_count = $count;
        return $this;
    }

}
