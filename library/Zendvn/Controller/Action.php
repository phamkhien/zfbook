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
        $section = $sectionConfig;
        $config = new Zend_Config_Ini($filename, $section);
        $config = $config->toArray();

        $baseUrl = $this->_request->getBaseUrl();
        $templateUrl = $baseUrl . $config['url'];
        $cssUrl = $templateUrl . $config['dirCss'];
        $jsUrl = $templateUrl . $config['dirJs'];
        $imgUrl = $templateUrl . $config['dirImg'];

        //Nap title cho layout
        $this->view->headLink()
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/bootstrap/css/bootstrap.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/js/font-awesome.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/dist/css/AdminLTE.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/dist/css/skins/_all-skins.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/iCheck/flat/blue.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/morris/morris.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/jvectormap/jquery-jvectormap-1.2.2.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/datepicker/datepicker3.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/daterangepicker/daterangepicker-bs3.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/css/font-awesome.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/css/mystyle.css', 'screen');

        //Nap cac the meta vao layout
        if (count($config['metaHttp']) > 0) {
            foreach ($config['metaHttp'] as $key => $value) {
                $tmp = explode("|", $value);
                $this->view->headMeta()->appendHttpEquiv($tmp[0], $tmp[1]);
            }
        }

        if (count($config['metaName']) > 0) {
            foreach ($config['metaName'] as $key => $value) {
                $tmp = explode("|", $value);
                $this->view->headMeta()->appendName($tmp[0], $tmp[1]);
            }
        }


        $option = array('layoutPath' => $template_path, 'layout' => $config['layout']);
        Zend_Layout::startMvc($option);
    }

} 
