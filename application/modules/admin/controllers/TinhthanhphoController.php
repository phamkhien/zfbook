<?php

class Admin_TinhthanhphoController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
        $controllerNameInBreadcrumb = "Tỉnh thành phố";
        $this->view->controllerNameInBreadcrumb = $controllerNameInBreadcrumb;
    }

    public function indexAction() {
        $this->view->headTitle('Danh sách tỉnh thành phố');
        $tinhThanhPhoTable = new Admin_Model_Tinhthanhpho;
        $search = $this->getParam("search");
        $select = $tinhThanhPhoTable->select();
        if ($search) {
            $select->where('ten_tinh_thanh_pho LIKE ?', "%$search%");
        }

        $listTinhThanhPho = $tinhThanhPhoTable->fetchAll($select);

        $rowCount = count($listTinhThanhPho);
        if (0 == $rowCount) {
            $this->view->noRecord = "true";
            return;
        }

        $items = 10;
        $page = $this->getParam('page', 1);
        $paginator = Zend_Paginator::factory($listTinhThanhPho);
        $paginator->setItemCountPerPage($items);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange(4);

        $this->view->paginator = $paginator;
    }

    public function addAction() {
        $this->view->headTitle('Thêm mới tỉnh thành phố');
        $formAdd = new Admin_Form_Addtinhthanhpho;
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

        $tinhthanhphoTable = new Admin_Model_Tinhthanhpho;

        $checkSameName = $tinhthanhphoTable->fetchRow(array("ten_tinh_thanh_pho = ?" => $dataFiltered['ten_tinh_thanh_pho']));
        if ($checkSameName) {
            $this->_helper->FlashMessenger()->setNamespace('add-false')->addMessage('Tên <b>tỉnh thành phố</b> đã tồn tại!');
            $this->_helper->redirector->gotoSimple("index", "tinhthanhpho");
        }
        $add = $tinhthanhphoTable->insert($dataFiltered);
        if ($add) {
            $this->_helper->FlashMessenger()->setNamespace('add-successful')->addMessage('Bản ghi đã được thêm thành công!');
        } else {
            $this->_helper->FlashMessenger()->setNamespace('add-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được thêm mới!');
        }

        $this->_helper->redirector->gotoSimple("index", "tinhthanhpho");
    }

    public function editAction() {
        $this->view->headTitle('Sửa đổi tỉnh thành phố');
        $file = $this->getParam("file");
        if (!$file) {
            return;
        }
        $tinhThanhPhoTable = new Admin_Model_Tinhthanhpho;
        $rowDataTinhThanhPho = $tinhThanhPhoTable->fetchRow(array("idtinh_thanh_pho =?" => $file));
        if ($rowDataTinhThanhPho == NULL) {
            return;
        }

        $formEdit = new Admin_Form_Addtinhthanhpho;
        $formEdit->populate($rowDataTinhThanhPho->toArray());
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

        $edit = $tinhThanhPhoTable->update($dataFiltered, array("idtinh_thanh_pho =?" => $file));
        if ($edit) {
            $this->_helper->FlashMessenger()->setNamespace('edit-successful')->addMessage('Bản ghi đã được sửa đổi thành công!');
        } else {
            //$this->_helper->flashMessenger()->addMessage('Post created!', 'delete-false');
            $this->_helper->FlashMessenger()->setNamespace('edit-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được sửa đổi!');
            // $this->_helper->flashMessenger(array("delete-false"=>"Bản ghi đã được xóa thành công!"));
        }

        $this->_helper->redirector->gotoSimple("edit", "tinhthanhpho", "admin", array("file" => $file));
    }

    public function deleteAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $file = $this->getParam("file");
        if (!$file) {
            return;
        }
        $tinhThanhPhoTable = new Admin_Model_Tinhthanhpho;

        $delete = $tinhThanhPhoTable->delete(array("idtinh_thanh_pho =?" => $file));
        if ($delete) {
            $this->_helper->FlashMessenger()->setNamespace('delete-successful')->addMessage('Bản ghi đã được xóa thành công!');
        } else {
            //$this->_helper->flashMessenger()->addMessage('Post created!', 'delete-false');
            $this->_helper->FlashMessenger()->setNamespace('delete-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được xóa!');
            // $this->_helper->flashMessenger(array("delete-false"=>"Bản ghi đã được xóa thành công!"));
        }

        $this->_helper->redirector->gotoSimple("index", "tinhthanhpho", "admin");
    }

}
