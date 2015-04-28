<?php

class Admin_Form_Addnhombaiviet extends Zend_Form {

    public function init() {

        $this->setMethod('POST');
        $nameNhomBaiViet = new Zend_Form_Element_Text('ten_nhom_bai_viet');
        $parent = new Zend_Form_Element_Select('parent');
        $submit = new Zend_Form_Element_Submit('Submit');

        $nameNhomBaiViet->setLabel("Tên nhóm bài viết");
        $nameNhomBaiViet->setRequired(true);
        $nameNhomBaiViet->setAttrib("class", "form-control");
        $parent->setLabel("Danh mục cha");
        $parent->setAttrib("class", "form-control");

        $arrayParent = array("0" => "Default");
        $parent->setMultiOptions($this->getArrayParent($arrayParent, 0, null));

        $submit->setAttrib("class", "btn btn-primary");

        $this->addElement($nameNhomBaiViet);
        $this->addElement($parent);
        $this->addElement($submit);
    }

    protected function getParent() {
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $listNhomBaiViet = $nhomBaiVietTable->fetchAll();
        $nhomBaiVietSelect = array("0" => "Default");
        foreach ($listNhomBaiViet as $nhomBaiViet) {
            $nhomBaiVietSelect[$nhomBaiViet['idnhom_bai_viet']] = $nhomBaiViet['ten_nhom_bai_viet'];
        }
        return $nhomBaiVietSelect;
    }

    protected function getArrayParent($arrayParent, $parent, $style = "") {
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $listNhomBaiViet = $nhomBaiVietTable->fetchAll(array("parent=?" => $parent));
        $styles = $style . "--";
        foreach ($listNhomBaiViet as $nhomBaiViet) {
            $arrayParent[$nhomBaiViet['idnhom_bai_viet']] = $style . $nhomBaiViet['ten_nhom_bai_viet'];
            $arrayParent = $this->getArrayParent($arrayParent, $nhomBaiViet['idnhom_bai_viet'], $styles);
        }

        return $arrayParent;
    }

}
