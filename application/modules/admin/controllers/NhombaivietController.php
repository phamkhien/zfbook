<?php

class Admin_NhombaivietController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
    }

    public function indexAction() {

        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $arrayParent = $this->getArrayParent(null, 0, null);

        $select = $nhomBaiVietTable->select()->order("idnhom_bai_viet DESC");
        $listNhomBaiViet = $nhomBaiVietTable->fetchAll($select);

        $this->view->listNhomBaiViet = $listNhomBaiViet;
        $this->view->arrayParent = $arrayParent;
        //$this->_helper->layout()->getView()->headTitle('View all students');
        $this->view->headTitle('Index Nhom Bai Viet');
    }

    public function addAction() {
        $formAdd = new Admin_Form_Addnhombaiviet;
        $this->view->formAdd = $formAdd;

        $request = $this->getRequest();
        $isPost = $request->isPost();
        if (!$isPost) {
            return;
        }

        $isValid = $formAdd->isValid($request->getPost());
        if (!$isValid) {
            return;
        }

        $dataFiltered = $formAdd->getValues();
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $nhomBaiVietTable->insert($dataFiltered);
        $this->_helper->redirector->gotoSimple("index", "nhombaiviet");
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
