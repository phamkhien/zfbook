<?php

class Admin_NhombaivietController extends Zendvn_Controller_Action{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $listNhomBaiViet = $nhomBaiVietTable->fetchAll();
        var_dump($listNhomBaiViet->toArray());
    }

    public function addAction(){
        $formAdd = new Admin_Form_Addnhombaiviet;
        $this->view->formAdd = $formAdd;

        $request = $this->getRequest();
        $isPost = $request ->isPost();
        if (!$isPost) {
            return;
        }

        $isValid = $formAdd->isValid($request->getPost());
        if (!$isValid){
            return;
        }

        $dataFiltered = $formAdd->getValues();
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $nhomBaiVietTable->insert($dataFiltered);
    }
}

