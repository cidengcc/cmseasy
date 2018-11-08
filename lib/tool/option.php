<?php

class option extends table {
    function getcols($act) {
        switch($act) {
            case  'list':
                return 'id,name,num,`order`,bid'.$this->mycols();
            case 'modify':
                return 'id,name,num,bid'.$this->mycols();
            case 'manage':
                return 'id,name,num,`order`,bid';
            default: return '1';
        }
    }
    function get_form() {
    }
    static function url($id) {
        return url::create('option/show/id/'.$id);
    }
}