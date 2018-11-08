<?php

class tree {
    public $parent;
    public $parents=array();
    public function __construct($parent) {
        $this->parent=$parent;
    }
    public function get_son($id,$down=false) {
        $res=array();
        foreach($this->parent as $key=>$p) {
            if($p==$id) {
                if($down &&$this->has_son($key)) $res[$key]=$this->get_son($key,true);
                else $res[$key]=$key;
            }
        }
        return $res;
    }
    public function get_sons($id,&$sons) {
        foreach($this->parent as $key=>$p) {
            if($p==$id) {
                if(!in_array($key,$sons)) $sons[]=$key;
                if($this->has_son($key)) $this->get_sons($key,$sons);
            }
        }
    }
    public function has_son($id) {
        if(array_search($id,$this->parent)) return true;
        else return false;
    }
    public function get_parent($id) {
        if(isset($this->parent[$id]) &&$this->parent[$id])
            return $this->parent[$id];
        else return false;
    }
    private function _get_parents($id,&$parent) {
        if(isset($this->parent[$id]) &&$this->parent[$id]) {
            $_id=$this->parent[$id];
            $parent[]=$_id;
            if(isset($this->parent[$_id]))
                $this->_get_parents($_id,$parent);
        }
    }
    private function _get_parents1($id,&$parent) {
        if(isset($this->parent[$id])) {
            foreach ($this->parent as $k =>$v) {
                if($v == $this->parent[$id] &&$k != $id &&$k != 1) {
                    $parent[]=$k;
                }
            }
        }
    }
    public function get_parents($id,$incmyself=true) {
        $parent=array();
        if($incmyself) $parent=array($id);
        $this->_get_parents($id,$parent);
        krsort($parent);
        return $parent;
    }
    public function get_parents1($id,$incmyself=true) {
        $parent=array();
        if($incmyself) $parent=array($id);
        $this->_get_parents1($id,$parent);
        sort($parent);
        return $parent;
    }
}