<?php

class Admin_Form_Addquanhuyen extends Zend_Form {

    public function init() {

        $this->setMethod('POST');
        $nameQuanHuyen = new Zend_Form_Element_Text('ten_quan_huyen');
        $selectTinhThanhPho = new Zend_Form_Element_Select('tinh_thanh_pho_id');
        $submit = new Zend_Form_Element_Submit('Submit');

        $nameQuanHuyen->setLabel("Tên quận huyện")
                ->setRequired(true)
                ->setAttrib("class", "form-control")
                ->addFilter('StringTrim')
                ->setAttrib('maxLength', 50);


        $selectTinhThanhPho->setLabel("Tỉnh thành phố")
                ->setAttrib("class", "form-control");
        
        $arrayParent = array("0" => "Default");
        $selectTinhThanhPho->setMultiOptions($this->getArrayTinhThanhPho());

        $submit->setAttrib("class", "btn btn-primary");

        $this->addElement($nameQuanHuyen);
        $this->addElement($selectTinhThanhPho);
        $this->addElement($submit);
    }

    protected function getArrayTinhThanhPho() {
        $tinhThanhPhoTable = new Admin_Model_Tinhthanhpho;
        $select = $tinhThanhPhoTable->select()->order('ten_tinh_thanh_pho ASC');
        $listTinhThanhPho = $tinhThanhPhoTable->fetchAll($select);
                
        foreach ($listTinhThanhPho as $tinhThanhPho) {
            $arrayTinhThanhPho[$tinhThanhPho['idtinh_thanh_pho']] = $tinhThanhPho['ten_tinh_thanh_pho'];
        }
        return $arrayTinhThanhPho;
    }

 

}
