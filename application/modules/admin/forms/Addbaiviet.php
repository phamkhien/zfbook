<?php

class Admin_Form_Addbaiviet extends Zend_Form {

    public function init() {
        $this->setMethod('POST');

        $title = new Zend_Form_Element_Text('tieu_de');
        $info = new Zend_Form_Element_Textarea('gioi_thieu');
        $picture = new Zend_Form_Element_File('hinh_minh_hoa');
        $content = new Zend_Form_Element_Textarea('noi_dung');
        $status = new Zend_Form_Element_Select('trang_thai');
        $category = new Zend_Form_Element_Select('nhom_bai_viet_id');

        $submit = new Zend_Form_Element_Submit('submit');


        $title->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Tiêu đề")
                ->addFilter('StringTrim')
                ->addValidator('stringLength', false, array(3, 200));

        $info->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Giới thiệu")
                ->setAttrib("rows", "5")
                ->addFilter('StringTrim');

        $content->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Nội dung chính")
                ->setAttrib("rows", "10")
                ->addFilter('StringTrim');

        $picture->setAttrib("class", "form-control")
                ->setDestination(APPLICATION_PATH . '/../public/file/baiviet');

        $status->setValue('1')
                ->setAttrib("class", "form-control")
                ->setMultiOptions($this->getStatus());

        $arrayParent = array();
        $category->setAttrib("class", "form-control")
                ->setMultiOptions($this->getCategory($arrayParent, 0, null));

        $submit->setAttrib("class", "btn btn-primary")
                ->setAttrib("value ", "Submit")
                ->setAttrib("id ", "submit");

        $this->addElement($title);
        $this->addElement($submit);
        $this->addElement($status);
        $this->addElement($category);
        $this->addElement($picture);
        $this->addElement($content);
        $this->addElement($info);


        foreach ($this->getElements() as $element) {
            $element->removeDecorator('Label');
        }
    }

    protected function getCategory($arrayParent, $parent, $style = "") {
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $select = $nhomBaiVietTable->select()->where("parent=?", $parent)->order("idnhom_bai_viet DESC");
        $listNhomBaiViet = $nhomBaiVietTable->fetchAll($select);
        $styles = $style . "--";

        foreach ($listNhomBaiViet as $nhomBaiViet) {
            $arrayParent[$nhomBaiViet['idnhom_bai_viet']] = $style . $nhomBaiViet['ten_nhom_bai_viet'];
            $arrayParent = $this->getCategory($arrayParent, $nhomBaiViet['idnhom_bai_viet'], $styles);
        }

        return $arrayParent;
    }

    protected function getStatus() {
        $arraySatus = array(
            Admin_Model_Baiviet::PREVIEW => "Đăng bài",
            Admin_Model_Baiviet::DRAP => "Lưu tạm chưa đăng (Nháp)"
        );

        return $arraySatus;
    }

}
