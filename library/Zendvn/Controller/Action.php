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

//        $baseUrl = $this->_request->getBaseUrl();
//        $templateUrl = $baseUrl . $config['url'];
//        $cssUrl = $templateUrl . $config['dirCss'];
//        $jsUrl = $templateUrl . $config['dirJs'];
//        $imgUrl = $templateUrl . $config['dirImg'];

        //Nap title cho layout
        $this->view->headLink()
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/bootstrap/css/bootstrap.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/css/font-awesome.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/dist/css/AdminLTE.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/dist/css/skins/_all-skins.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/iCheck/flat/blue.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/morris/morris.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/jvectormap/jquery-jvectormap-1.2.2.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/datepicker/datepicker3.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/daterangepicker/daterangepicker-bs3.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/css/font-awesome.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css', 'screen')
                ->appendStylesheet(TEMPLATE_URL . '/admin/system/css/jquery-ui.css', 'screen')
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

    public function nv_EncString($text) {
        $text = html_entity_decode($text);
        //thay thế chữ thuong
        $text = preg_replace("/(å|ä|ā|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|ä|ą)/", 'a', $text);
        $text = preg_replace("/(ß|ḃ)/", "b", $text);
        $text = preg_replace("/(ç|ć|č|ĉ|ċ|¢|©)/", 'c', $text);
        $text = preg_replace("/(đ|ď|ḋ|đ)/", 'd', $text);
        $text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|ę|ë|ě|ė)/", 'e', $text);
        $text = preg_replace("/(ḟ|ƒ)/", "f", $text);
        $text = str_replace("ķ", "k", $text);
        $text = preg_replace("/(ħ|ĥ)/", "h", $text);
        $text = preg_replace("/(ì|í|î|ị|ỉ|ĩ|ï|î|ī|¡|į)/", 'i', $text);
        $text = str_replace("ĵ", "j", $text);
        $text = str_replace("ṁ", "m", $text);

        $text = preg_replace("/(ö|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|ö|ø|ō)/", 'o', $text);
        $text = str_replace("ṗ", "p", $text);
        $text = preg_replace("/(ġ|ģ|ğ|ĝ)/", "g", $text);
        $text = preg_replace("/(ü|ù|ú|ū|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|ü|ų|ů)/", 'u', $text);
        $text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ|ÿ)/", 'y', $text);
        $text = preg_replace("/(ń|ñ|ň|ņ)/", 'n', $text);
        $text = preg_replace("/(ŝ|š|ś|ṡ|ș|ş|³)/", 's', $text);
        $text = preg_replace("/(ř|ŗ|ŕ)/", "r", $text);
        $text = preg_replace("/(ṫ|ť|ț|ŧ|ţ)/", 't', $text);

        $text = preg_replace("/(ź|ż|ž)/", 'z', $text);
        $text = preg_replace("/(ł|ĺ|ļ|ľ)/", "l", $text);

        $text = preg_replace("/(ẃ|ẅ)/", "w", $text);

        $text = str_replace("æ", "ae", $text);
        $text = str_replace("þ", "th", $text);
        $text = str_replace("ð", "dh", $text);
        $text = str_replace("£", "pound", $text);
        $text = str_replace("¥", "yen", $text);

        $text = str_replace("ª", "2", $text);
        $text = str_replace("º", "0", $text);
        $text = str_replace("¿", "?", $text);

        $text = str_replace("µ", "mu", $text);
        $text = str_replace("®", "r", $text);

        //thay thế chữ hoa
        $text = preg_replace("/(Ä|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|Ą|Å|Ā)/", 'A', $text);
        $text = preg_replace("/(Ḃ|B)/", 'B', $text);
        $text = preg_replace("/(Ç|Ć|Ċ|Ĉ|Č)/", 'C', $text);
        $text = preg_replace("/(Đ|Ď|Ḋ)/", 'D', $text);
        $text = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|Ę|Ë|Ě|Ė|Ē)/", 'E', $text);
        $text = preg_replace("/(Ḟ|Ƒ)/", "F", $text);
        $text = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ|Ï|Į)/", 'I', $text);
        $text = preg_replace("/(Ĵ|J)/", "J", $text);

        $text = preg_replace("/(Ö|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ø)/", 'O', $text);
        $text = preg_replace("/(Ü|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|Ū|Ų|Ů)/", 'U', $text);
        $text = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ|Ÿ)/", 'Y', $text);
        $text = str_replace("Ł", "L", $text);
        $text = str_replace("Þ", "Th", $text);
        $text = str_replace("Ṁ", "M", $text);

        $text = preg_replace("/(Ń|Ñ|Ň|Ņ)/", "N", $text);
        $text = preg_replace("/(Ś|Š|Ŝ|Ṡ|Ș|Ş)/", "S", $text);
        $text = str_replace("Æ", "AE", $text);
        $text = preg_replace("/(Ź|Ż|Ž)/", 'Z', $text);

        $text = preg_replace("/(Ř|R|Ŗ)/", 'R', $text);
        $text = preg_replace("/(Ț|Ţ|T|Ť)/", 'T', $text);
        $text = preg_replace("/(Ķ|K)/", 'K', $text);
        $text = preg_replace("/(Ĺ|Ł|Ļ|Ľ)/", 'L', $text);

        $text = preg_replace("/(Ħ|Ĥ)/", 'H', $text);
        $text = preg_replace("/(Ṗ|P)/", 'P', $text);
        $text = preg_replace("/(Ẁ|Ŵ|Ẃ|Ẅ)/", 'W', $text);
        $text = preg_replace("/(Ģ|G|Ğ|Ĝ|Ġ)/", 'G', $text);
        $text = preg_replace("/(Ŧ|Ṫ)/", 'T', $text);

        return $text;
    }

    public function change_alias($alias) {
        $alias = $this->nv_EncString($alias);

        //thêm trường hợp các kí tự đặc biệt
        $alias = preg_replace("/(!|\"|#|$|%|'|̣)/", '', $alias);
        $alias = preg_replace("/(̀|́|̉|$|>)/", '', $alias);
        $alias = preg_replace("'<[\/\!]*?[^<>]*?>'si", "", $alias);

        $alias = str_replace("----", " ", $alias);
        $alias = str_replace("---", " ", $alias);
        $alias = str_replace("--", " ", $alias);

        $alias = preg_replace('/(\W+)/i', '-', $alias);
        $alias = str_replace(array(
            '-8220-', '-8221-', '-7776-'
                ), '-', $alias);
        $alias = preg_replace('/[^a-zA-Z0-9\-]+/e', '', $alias);
        $alias = str_replace(array(
            'dAg', 'DAg', 'uA', 'iA', 'yA', 'dA', '--', '-8230'
                ), array(
            'dong', 'Dong', 'uon', 'ien', 'yen', 'don', '-', ''
                ), $alias);
        $alias = preg_replace('/(\-)$/', '', $alias);
        $alias = preg_replace('/^(\-)/', '', $alias);

        return $alias;
    }
    public function changeFileName($nameElement, $form) {
        $upload = new Zend_File_Transfer();
        if (!$upload->getFileName("$nameElement")) {
            return;
        }
        $pathInfo = pathinfo($upload->getFileName("$nameElement"));

        $fileName = $pathInfo['filename'];
        $extension = $pathInfo['extension'];

        $fileNameAlias = $this->change_alias($fileName);
        $fileNameFull = $fileNameAlias . time() . ".$extension";

        $getElementAvatar = $form->getElement($nameElement);
        /* @var $front Zend_Form_Element_File */
        $getFileTransfer = $getElementAvatar->getTransferAdapter();
        /* @var $tfa Zend_File_Transfer_Adapter_Abstract */
        $getFileTransfer->addFilter('Rename', $fileNameFull);
        return $fileNameFull;
    }
}
