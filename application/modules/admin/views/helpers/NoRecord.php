<?php

class Admin_View_Helper_NoRecord extends Zend_View_Helper_Abstract {

    /**
     * Using view partial to separeted logic get data from db and repesent data on html mockup
     * 
     * @author TienVm
     * @link http://framework.zend.com/manual/1.12/en/zend.view.helpers.html#zend.view.helpers.initial.partial
     * 
     * @return string
     */
    public function noRecord($noRecord) {
        if ($noRecord == true) {
            $html = "<div class='info-box bg-yellow'>";
            $html .= "<span class='info-box-icon'><i class='fa fa-exclamation-triangle'></i></span>";
            $html .= "<div class='info-box-content'>";
            $html .= "<p> Hiện tại chưa tồn tại bản ghi nào!</p>";
            $html .= "</div>";
            $html .= "</div>";
            return $html;
        }
    }

}
