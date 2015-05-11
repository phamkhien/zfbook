<?php

class Admin_BaivietController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
        $controllerNameInBreadcrumb = "Bàiviết";
        $this->view->controllerNameInBreadcrumb = $controllerNameInBreadcrumb;
    }

    public function indexAction()
    {
     
    }

    public function addAction(){
    	
    }


}

