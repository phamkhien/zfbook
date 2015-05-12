<?php

class Admin_QuanhuyenController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
        $controllerNameInBreadcrumb = "Quận huyện";
        $this->view->controllerNameInBreadcrumb = $controllerNameInBreadcrumb;
    }

    public function indexAction() {
        $this->view->headTitle('Danh sách quận huyện');
        
        $quanhuyenTable = new Admin_Model_Quanhuyen;
        $select = $quanhuyenTable->select()->setIntegrityCheck(FALSE)
                ->from('quan_huyen')
                ->joinInner("tinh_thanh_pho", 
                        "quan_huyen.tinh_thanh_pho_id=tinh_thanh_pho.idtinh_thanh_pho", 
                        array('ten_tinh_thanh_pho'))
                ->order('ten_tinh_thanh_pho ASC')
                ->order('ten_quan_huyen ASC');;
        $listQuanHuyen = $quanhuyenTable->fetchAll($select);
      
        $rowCount = count($listQuanHuyen);
        if (0 == $rowCount) {
            $this->view->noRecord = "true";
            return;
        }

        $items = 10;
        $page = $this->getParam('page', 1);
        $paginator = Zend_Paginator::factory($listQuanHuyen);
        $paginator->setItemCountPerPage($items);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange(4);
        //$this->view->mapIdToNameTinhThanhPho = $this->mapIdToNameTinhThanhPho();
        $this->view->paginator = $paginator;
    }

    public function addAction() {
        $this->view->headTitle('Thêm mới quận huyện');
        $formAdd = new Admin_Form_Addquanhuyen;
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

        $quanhuyenTable = new Admin_Model_Quanhuyen;

        $add = $quanhuyenTable->insert($dataFiltered);
        if ($add) {
            $this->_helper->FlashMessenger()->setNamespace('add-successful')->addMessage('Bản ghi đã được thêm thành công!');
        } else {
            $this->_helper->FlashMessenger()->setNamespace('add-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được thêm mới!');
        }

        $this->_helper->redirector->gotoSimple("index", "quanhuyen");
    }

    public function editAction() {
        $this->view->headTitle('Sửa đổi quận huyện');
        $file = $this->getParam("file");
        if (!$file) {
            return;
        }
        $quanhuyenTable = new Admin_Model_Quanhuyen;
        $rowDataQuanHuyen = $quanhuyenTable->fetchRow(array("idquan_huyen =?" => $file));

        if ($rowDataQuanHuyen == NULL) {
            return;
        }

        $formEdit = new Admin_Form_Addquanhuyen;
        $formEdit->populate($rowDataQuanHuyen->toArray());
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
        $edit = $quanhuyenTable->update($dataFiltered, array("idquan_huyen = ?" => $file));
        if ($edit) {
            $this->_helper->FlashMessenger()->setNamespace('edit-successful')->addMessage('Bản ghi đã được sửa đổi thành công!');
        } else {
            $this->_helper->FlashMessenger()->setNamespace('edit-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được sửa đổi!');
        }

        $this->_helper->redirector->gotoSimple("edit", "quanhuyen", "admin", array("file" => $file));
    }

    public function deleteAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $file = $this->getParam("file");
        if (!$file) {
            return;
        }
        $quanhuyenTable = new Admin_Model_Quanhuyen;

        $delete = $quanhuyenTable->delete(array("idquan_huyen =?" => $file));
        if ($delete) {
            $this->_helper->FlashMessenger()->setNamespace('delete-successful')->addMessage('Bản ghi đã được xóa thành công!');
        } else {
            //$this->_helper->flashMessenger()->addMessage('Post created!', 'delete-false');
            $this->_helper->FlashMessenger()->setNamespace('delete-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được xóa!');
            // $this->_helper->flashMessenger(array("delete-false"=>"Bản ghi đã được xóa thành công!"));
        }

        $this->_helper->redirector->gotoSimple("index", "quanhuyen", "admin");
    }

//    protected function mapIdToNameTinhThanhPho(){
//        $tinhThanhPhoTable = new Admin_Model_Tinhthanhpho;
//        $listTinhThanhPho = $tinhThanhPhoTable->fetchAll();
//        $arrayFromIdToNameTinhThanhPho=array();
//        foreach ($listTinhThanhPho as $tinhThanhPho) {
//            $arrayFromIdToNameTinhThanhPho[$tinhThanhPho['idtinh_thanh_pho']] = $tinhThanhPho['ten_tinh_thanh_pho'];
//        }
//        return $arrayFromIdToNameTinhThanhPho;
//    }
}
