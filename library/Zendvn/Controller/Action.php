<?php

class Zendvn_Controller_Action extends Zend_Controller_Action {

    public function init() {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
    }

    protected function loadTemplate($template_path, $fileConfig = "template.ini", $sectionConfig = "template") {
        //Xoa nhung du cua layout truoc
        $this->view->headTitle()->set('');
        $this->view->headMeta()->getContainer()->exchangeArray(array());
        $this->view->headLink()->getContainer()->exchangeArray(array());
        $this->view->headScript()->getContainer()->exchangeArray(array());

        $filename = $template_path . "/" . $fileConfig;
        $section = $sectionConfig ;
        $config = new Zend_Config_Ini($filename, $section);
        $config = $config->toArray();

        $baseUrl = $this->_request->getBaseUrl();
        $templateUrl = $baseUrl . $config['url'];
        $cssUrl = $templateUrl . $config['dirCss'];
        $jsUrl = $templateUrl . $config['dirJs'];
        $imgUrl = $templateUrl . $config['dirImg'];

        //Nap title cho layout
        $this->view->headTitle($config['title']);

        //Nap cac the meta vao layout
        
        $this->view->templateUrl = $templateUrl;
        $this->view->cssUrl = $cssUrl;
        $this->view->jsUrl = $jsUrl;
        $this->view->imgUrl = $imgUrl;
        /* echo '<pre>';
          print_r($config);
          echo '</pre>'; */
        $option = array('layoutPath' => $template_path, 'layout' => $config['layout']);
        Zend_Layout::startMvc($option);
    }

}
