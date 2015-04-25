<?php

class Admin_Form_Addnhombaiviet extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('POST');
        $nameNhomBaiViet = new Zend_Form_Element_Text('ten_nhom_bai_viet');
        $parent = new Zend_Form_Element_Select('parent');
        $submit = new Zend_Form_Element_Submit('submit');

        $nameNhomBaiViet->setLabel("tên nhóm bài viết");
        $parent->setMultiOptions($this->getParent());

        $this->addElement($nameNhomBaiViet);
        $this->addElement($parent);
        $this->addElement($submit);
    }

    protected function getParent(){
    	$nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $listNhomBaiViet = $nhomBaiVietTable->fetchAll();
        $nhomBaiVietSelect = array();
        foreach($listNhomBaiViet as $nhomBaiViet){
        	$nhomBaiVietSelect[$nhomBaiViet['idnhom_bai_viet']] = $nhomBaiViet['ten_nhom_bai_viet'];
        }
        return $nhomBaiVietSelect;

    }

}

