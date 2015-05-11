<?php

class Admin_Form_Addtinhthanhpho extends Zend_Form {

    public function init() {

        $this->setMethod('POST');
        $nameTinhThanhPho = new Zend_Form_Element_Text('ten_tinh_thanh_pho');
        $submit = new Zend_Form_Element_Submit('Submit');

        $nameTinhThanhPho->setLabel("Tên tỉnh thành phố")
                ->setRequired(true)
                ->addFilter('StringTrim')
                ->setAttrib('maxLength', 50)
                ->setAttrib("class", "form-control");

        $submit->setAttrib("class", "btn btn-primary");

        $this->addElement($nameTinhThanhPho);

        $this->addElement($submit);
    }

}
