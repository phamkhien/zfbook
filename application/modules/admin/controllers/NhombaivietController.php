<?php

class Admin_NhombaivietController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
    }

    public function indexAction() {
       //$nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $arrayParent = $this->getArrayParent(null, 0, "--");

//        $select = $nhomBaiVietTable->select()->order("idnhom_bai_viet DESC");
//        $listNhomBaiViet = $nhomBaiVietTable->fetchAll($select);
        
//        echo "<pre>";
//        print_r($listNhomBaiViet);
//        echo "</pre>";
//        die();
//        echo "<pre>";
//        print_r($this->getAllNhomBaiViet(null, 0));
//        echo "</pre>";
//        die();
        $listNhomBaiViet = $this->getAllNhomBaiViet(null, 0);
        $this->view->listNhomBaiViet = $listNhomBaiViet;
        $this->view->arrayParent = $arrayParent;
        //$this->_helper->layout()->getView()->headTitle('View all students');
        $this->view->headTitle('Danh sách nhóm bài viết');
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
        $styles = $style . " -- ";
        foreach ($listNhomBaiViet as $nhomBaiViet) {
            $arrayParent[$nhomBaiViet['idnhom_bai_viet']] = $style." " . $nhomBaiViet['ten_nhom_bai_viet'];
            $arrayParent = $this->getArrayParent($arrayParent, $nhomBaiViet['idnhom_bai_viet'], $styles);
        }

        return $arrayParent;
    }

    protected function getAllNhomBaiViet($arrayParent, $parent) {
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $listNhomBaiViet = $nhomBaiVietTable->fetchAll(array("parent=?" => $parent)); 
        foreach ($listNhomBaiViet as $nhomBaiViet) {
            $idNhomBaiViet = $nhomBaiViet->idnhom_bai_viet;
            $tenNhomBaiViet = $nhomBaiViet->ten_nhom_bai_viet;
            $parentNhomBaiViet = $nhomBaiViet->parent;
            $arrayParent[] = array("idnhom_bai_viet"=>$idNhomBaiViet, "ten_nhom_bai_viet" =>$tenNhomBaiViet, "parent"=>$parentNhomBaiViet );
            $arrayParent = $this->getAllNhomBaiViet($arrayParent, $nhomBaiViet['idnhom_bai_viet']);
        }
       
        return $arrayParent;
        
    }

}
