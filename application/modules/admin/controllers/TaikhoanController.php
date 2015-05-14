<?php

class Admin_TaikhoanController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
        $controllerNameInBreadcrumb = "Tài khoản người dùng";
        $this->view->controllerNameInBreadcrumb = $controllerNameInBreadcrumb;
    }

    public function indexAction() {
        $this->view->headTitle('Danh sách tài khoản');

        $taiKhoanTable = new Admin_Model_Taikhoan;
        $select = $taiKhoanTable->select()->setIntegrityCheck(FALSE)
                ->from('tai_khoan')
                ->joinInner("nhom_tai_khoan", "tai_khoan.nhom_tai_khoan_id=nhom_tai_khoan.idnhom_tai_khoan", array('ten_nhom_tai_khoan'))
                ->order('ten_nhom_tai_khoan ASC')
                ->order('ten_dang_nhap ASC');
        ;
        $listTaiKhoan = $taiKhoanTable->fetchAll($select);

        $rowCount = count($listTaiKhoan);
        if (0 == $rowCount) {
            $this->view->noRecord = "true";
            return;
        }

        $items = 10;
        $page = $this->getParam('page', 1);
        $paginator = Zend_Paginator::factory($listTaiKhoan);
        $paginator->setItemCountPerPage($items);
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange(4);
        $this->view->paginator = $paginator;
    }

    public function addAction() {

        $this->view->headTitle('Thêm mới tài khoản');
        $formAdd = new Admin_Form_Addtaikhoan;
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

        $this->changeFileName('avatar', $formAdd);

        $dataFiltered = $formAdd->getValues();

        unset($dataFiltered['repeat_mat_khau']);

        if (!$dataFiltered['avatar']) {
            unset($dataFiltered['avatar']);
        }

        $dataFiltered['ngay_sinh'] = date("Y-m-d", strtotime($dataFiltered['ngay_sinh']));
        $dataFiltered['mat_khau'] = md5($dataFiltered['mat_khau']);
        $dataFiltered['ngay_dang_ky'] = date('Y-m-d H:i:s');

        $taiKhoanTable = new Admin_Model_Taikhoan;
        $add = $taiKhoanTable->insert($dataFiltered);
        if ($add) {
            $this->_helper->FlashMessenger()->setNamespace('add-successful')->addMessage('Bản ghi đã được thêm thành công!');
        } else {
            $this->_helper->FlashMessenger()->setNamespace('add-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được thêm mới!');
        }

        $this->_helper->redirector->gotoSimple("index", "taikhoan");
    }

    public function editAction() {
        $this->view->headTitle('Sửa đổi tài khoản');
        $file = $this->getParam("file");
        if (!$file) {
            return;
        }
        $taiKhoanTable = new Admin_Model_Taikhoan;
        $rowDataTaiKhoan = $taiKhoanTable->fetchRow(array("idtai_khoan = ?" => $file));
        $arrayRowDataTaiKhoan = $rowDataTaiKhoan->toArray();
        $arrayRowDataTaiKhoan['ngay_sinh'] = date("d-m-Y", strtotime($arrayRowDataTaiKhoan['ngay_sinh']));
        if ($rowDataTaiKhoan == NULL) {
            return;
        }

        $formEdit = new Admin_Form_Addtaikhoan;
        $formEdit->populate($arrayRowDataTaiKhoan);
        $this->view->formEdit = $formEdit;

        $formEdit->mat_khau->setRequired(FALSE);
        $formEdit->mat_khau->setValidators(array());

        $formEdit->repeat_mat_khau->setRequired(FALSE);
        $formEdit->repeat_mat_khau->setValidators(array());

        $request = $this->getRequest();
        $isPost = $request->isPost();
        if (!$isPost) {
            return;
        }

        $isValid = $formEdit->isValid($request->getPost());
        if (!$isValid) {
            return;
        }
        $this->changeFileName('avatar', $formEdit);
        $dataFiltered = $formEdit->getValues();

        unset($dataFiltered['repeat_mat_khau']);

        if (!$dataFiltered['avatar']) {
            unset($dataFiltered['avatar']);
        }
        if ($rowDataTaiKhoan->mat_khau == md5($dataFiltered['mat_khau'])) {
            unset($dataFiltered['mat_khau']);
        } else {
            $dataFiltered['mat_khau'] = md5($dataFiltered['mat_khau']);
        }
        $dataFiltered['ngay_sinh'] = date("Y-m-d", strtotime($dataFiltered['ngay_sinh']));
        $edit = $taiKhoanTable->update($dataFiltered, array("idtai_khoan = ?" => $file));
        if ($edit) {
            $this->_helper->FlashMessenger()->setNamespace('edit-successful')->addMessage('Bản ghi đã được sửa đổi thành công!');
        } else {
            $this->_helper->FlashMessenger()->setNamespace('edit-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được sửa đổi!');
        }

        $this->_helper->redirector->gotoSimple("edit", "taikhoan", "admin", array("file" => $file));
    }

    public function deleteAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $file = $this->getParam("file");
        if (!$file) {
            return;
        }
        $taikhoanTable = new Admin_Model_Taikhoan;

        $delete = $taikhoanTable->delete(array("idtai_khoan =?" => $file));
        if ($delete) {
            $this->_helper->FlashMessenger()->setNamespace('delete-successful')->addMessage('Bản ghi đã được xóa thành công!');
        } else {
            $this->_helper->FlashMessenger()->setNamespace('delete-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được xóa!');
        }
        $this->_helper->redirector->gotoSimple("index", "taikhoan", "admin");
    }

    protected function changeFileName($nameElement, $form) {
        $upload = new Zend_File_Transfer();
        if (!$upload->getFileName("$nameElement")) {
            return;
        }
        $pathInfo = pathinfo($upload->getFileName("$nameElement"));

        $fileName = $pathInfo['filename'];
        $extension = $pathInfo['extension'];

        $fileNameAlias = $this->change_alias($fileName);
        $fileNameFull = $fileNameAlias . time() . ".$extension";

        $getElementAvatar = $form->getElement('avatar');
        /* @var $front Zend_Form_Element_File */
        $getFileTransfer = $getElementAvatar->getTransferAdapter();
        /* @var $tfa Zend_File_Transfer_Adapter_Abstract */
        $getFileTransfer->addFilter('Rename', $fileNameFull);
    }

}
