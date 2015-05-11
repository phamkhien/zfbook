<?php

class Admin_NhombaivietController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
        $controllerNameInBreadcrumb = "Nhóm bài viết";
        $this->view->controllerNameInBreadcrumb = $controllerNameInBreadcrumb;
    }

    public function indexAction() {
        $this->view->headTitle('Danh sách nhóm bài viết');
//        if($this->_helper->flashMessenger()->hasMessages('delete-false')){
//             var_dump($this->_helper->flashMessenger()->getMessages('delete-false'));
//         die();
//        }
        //$this->view->messages = $this->_helper->flashMessenger()->getMessages();

        $arrayParent = $this->getArrayParent(null, 0, "--");
        $listNhomBaiViet = $this->getAllNhomBaiViet(null, 0);

        if (!$listNhomBaiViet) {
            $this->view->noRecord = true;
            return;
        }

        $items = 10;
        $page = $this->getParam('page', 1);
        $paginator = Zend_Paginator::factory($listNhomBaiViet);
        $paginator->setItemCountPerPage($items);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange(4);

        $this->view->paginator = $paginator;

//       var_dump($paginator);
//       die();
        // $this->view->listNhomBaiViet = $listNhomBaiViet;
        $this->view->arrayParent = $arrayParent;
        //$this->_helper->layout()->getView()->headTitle('View all students');
        // $this->view->messages = $this->_helper->flashMessenger->getMessages();
    }

    public function addAction() {
        $this->view->headTitle('Thêm mới nhóm bài viết');
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

        $checkSameName = $nhomBaiVietTable->fetchRow(array("ten_nhom_bai_viet = ?" => $dataFiltered['ten_nhom_bai_viet']));
        if ($checkSameName) {
            $this->_helper->FlashMessenger()->setNamespace('add-false')->addMessage('Tên <b>nhóm bài viết</b> đã tồn tại!');
            $this->_helper->redirector->gotoSimple("index", "nhombaiviet");
        }
        $add = $nhomBaiVietTable->insert($dataFiltered);
        if ($add) {
            $this->_helper->FlashMessenger()->setNamespace('add-successful')->addMessage('Bản ghi đã được thêm thành công!');
        } else {
            $this->_helper->FlashMessenger()->setNamespace('add-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được thêm mới!');
        }

        $this->_helper->redirector->gotoSimple("index", "nhombaiviet");
    }

    public function editAction() {
        $this->view->headTitle('Sửa đổi nhóm bài viết');
        $file = $this->getParam("file");
        if (!$file) {
            return;
        }
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $dataNhomBaiViet = $nhomBaiVietTable->fetchRow(array("idnhom_bai_viet =?" => $file));
        if ($dataNhomBaiViet == NULL) {
            return;
        }

        $formEdit = new Admin_Form_Addnhombaiviet;
        $formEdit->populate($dataNhomBaiViet->toArray());
        $this->view->formEdit = $formEdit;
        $request = $this->getRequest();
        $isPost = $request->isPost();
        if (!$isPost) {
            return;
        }

        $isValid = $formEdit->isValid($request->getPost());
        if (!$isValid) {
            return;
        }

        $dataFiltered = $formEdit->getValues();

        $edit = $nhomBaiVietTable->update($dataFiltered, array("idnhom_bai_viet =?" => $file));
        if ($edit) {
            $this->_helper->FlashMessenger()->setNamespace('edit-successful')->addMessage('Bản ghi đã được sửa đổi thành công!');
        } else {
            //$this->_helper->flashMessenger()->addMessage('Post created!', 'delete-false');
            $this->_helper->FlashMessenger()->setNamespace('edit-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được sửa đổi!');
            // $this->_helper->flashMessenger(array("delete-false"=>"Bản ghi đã được xóa thành công!"));
        }

        $this->_helper->redirector->gotoSimple("edit", "nhombaiviet", "admin", array("file" => $file));
    }

    public function deleteAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $file = $this->getParam("file");
        if (!$file) {
            return;
        }
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $dataNhomBaiViet = $nhomBaiVietTable->fetchRow(array("parent=?" => $file));

        if (!empty($dataNhomBaiViet)) {
            $this->_helper->FlashMessenger()->setNamespace('delete-false')->addMessage('Tồn tại bản ghi con thuộc <b>Nhóm bài viết</b> này. Vui lòng xóa hết các bản ghi con trước khi xóa bản ghi hiện tại!');
            $this->_helper->redirector->gotoSimple("index", "nhombaiviet", "admin");
            return;
        }
        $delete = $nhomBaiVietTable->delete(array("idnhom_bai_viet =?" => $file));
        if ($delete) {
            $this->_helper->FlashMessenger()->setNamespace('delete-successful')->addMessage('Bản ghi đã được xóa thành công!');
        } else {
            //$this->_helper->flashMessenger()->addMessage('Post created!', 'delete-false');
            $this->_helper->FlashMessenger()->setNamespace('delete-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được xóa!');
            // $this->_helper->flashMessenger(array("delete-false"=>"Bản ghi đã được xóa thành công!"));
        }

        $this->_helper->redirector->gotoSimple("index", "nhombaiviet", "admin");
    }

    protected function getArrayParent($arrayParent, $parent, $style = "") {
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $listNhomBaiViet = $nhomBaiVietTable->fetchAll(array("parent=?" => $parent));
        $styles = $style . " -- ";
        foreach ($listNhomBaiViet as $nhomBaiViet) {
            $arrayParent[$nhomBaiViet['idnhom_bai_viet']] = $style . " " . $nhomBaiViet['ten_nhom_bai_viet'];
            $arrayParent = $this->getArrayParent($arrayParent, $nhomBaiViet['idnhom_bai_viet'], $styles);
        }
        return $arrayParent;
    }

    protected function getAllNhomBaiViet($arrayParent, $parent) {
        $nhomBaiVietTable = new Admin_Model_Nhombaiviet;
        $select = $nhomBaiVietTable->select()->where("parent=?", $parent)->order("idnhom_bai_viet DESC");
        //$listNhomBaiViet = $nhomBaiVietTable->fetchAll(array("parent=?" => $parent));
        $listNhomBaiViet = $nhomBaiVietTable->fetchAll($select);

        foreach ($listNhomBaiViet as $nhomBaiViet) {
            $idNhomBaiViet = $nhomBaiViet->idnhom_bai_viet;
            $tenNhomBaiViet = $nhomBaiViet->ten_nhom_bai_viet;
            $parentNhomBaiViet = $nhomBaiViet->parent;
            $arrayParent[] = array("idnhom_bai_viet" => $idNhomBaiViet, "ten_nhom_bai_viet" => $tenNhomBaiViet, "parent" => $parentNhomBaiViet);
            $arrayParent = $this->getAllNhomBaiViet($arrayParent, $nhomBaiViet['idnhom_bai_viet']);
        }
        return $arrayParent;
    }

}
