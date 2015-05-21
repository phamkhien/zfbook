<?php

class Admin_Form_Addnhaphang extends Zend_Form {

    public function init() {
        $this->setMethod('POST');
        $mauSac = new Zend_Form_Element_Select('mau_sac_id');
        $kichThuoc = new Zend_Form_Element_MultiCheckbox('kich_thuoc_id');
        $soLuong = new Zend_Form_Element_Text('so_luong');
        $submit = new Zend_Form_Element_Submit('submit');
        $submitDonHang = new Zend_Form_Element_Submit('submit_donhang');

        $soLuong->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Số lượng");

        $mauSac->setAttrib("class", "form-control")
                ->setMultiOptions($this->getMauSac());

        $kichThuoc->setAttrib("class", "form-control")
                ->setMultiOptions($this->getKichThuoc());

        $submit->setAttrib("class", "btn btn-primary")
                ->setAttrib("value ", "Submit")
                ->setAttrib("id ", "submit");
        $submitDonHang -> setAttrib("class", "btn btn-primary")
                        ->setAttrib("value ", "Submit_donhang");
        $this->addElement($mauSac);
        $this->addElement($kichThuoc);
        $this->addElement($soLuong);
        $this->addElement($submit);
        $this->addElement($submitDonHang);



        foreach ($this->getElements() as $element) {
            $element->removeDecorator('Label');
        }
    }

    protected function getKichThuoc() {
        $mauSacTable = new Admin_Model_Kichthuoc;
        $select = $mauSacTable->select();
        $list = $mauSacTable->fetchAll($select);

        foreach ($list as $item) {
            $array[$item['idkich_thuoc']] = $item['size'];
        }
        return $array;
    }

    protected function getMauSac() {
        $mauSacTable = new Admin_Model_Mausac;
        $select = $mauSacTable->select();
        $list = $mauSacTable->fetchAll($select);

        foreach ($list as $item) {
            $array[$item['idmau_sac']] = $item['ten_mau_sac'];
        }
        return $array;
    }

}
