<?php

class Admin_View_Helper_Breadcrumb extends Zend_View_Helper_Abstract {

    /**
     * Using view partial to separeted logic get data from db and repesent data on html mockup
     * 
     * @author TienVm
     * @link http://framework.zend.com/manual/1.12/en/zend.view.helpers.html#zend.view.helpers.initial.partial
     * 
     * @return string
     */
    public function breadcrumb() {
        $controllerName = Zend_Controller_Front::getInstance()
                ->getRequest()
                ->getControllerName();

        return $controllerName;
    }

}
