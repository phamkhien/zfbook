<?php

class Admin_BaivietController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
        $controllerNameInBreadcrumb = "Bài viết";
        $this->view->controllerNameInBreadcrumb = $controllerNameInBreadcrumb;
    }

    public function indexAction() {
        
    }

    public function addAction() {
        $this->view->headTitle('Thêm mới bài viết');
        $formAdd = new Admin_Form_Addbaiviet;
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

        $fullNameAvatar = $this->changeFileName('hinh_minh_hoa', $formAdd);

        $dataFiltered = $formAdd->getValues();

        unset($dataFiltered['repeat_mat_khau']);

        if (!$dataFiltered['hinh_minh_hoa']) {
            unset($dataFiltered['hinh_minh_hoa']);
        } else {
            $dataFiltered['hinh_minh_hoa'] = 'baiviet/' . $fullNameAvatar;
        }

        $baiVietTable = new Admin_Model_Baiviet;
        $add = $baiVietTable->insert($dataFiltered);
        if ($add) {
            $this->_helper->FlashMessenger()
                    ->setNamespace('add-successful')
                    ->addMessage('Bản ghi đã được thêm thành công!');
        } else {
            $this->_helper->FlashMessenger()
                    ->setNamespace('add-false')
                    ->addMessage('Có lỗi xảy ra, bản ghi chưa được thêm mới!');
        }

        $this->_helper->redirector->gotoSimple("index", "baiviet");
    }

    public function editAction() {
        $this->view->headTitle('Sửa đổi bài viết');
        $file = $this->getParam("file");
        if (!$file) {
            return;
        }
        $baiVietTable = new Admin_Model_Baiviet;
        $rowDataBaiViet = $baiVietTable->fetchRow(array("idbai_viet = ?" => $file));

        if ($rowDataBaiViet == NULL) {
            return;
        }

        $formEdit = new Admin_Form_Addbaiviet;
        $formEdit->populate($rowDataBaiViet->toArray());
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
        $fullNameHinhMinhHoa = $this->changeFileName('hinh_minh_hoa', $formEdit);
        $dataFiltered = $formEdit->getValues();

        if (!$dataFiltered['hinh_minh_hoa']) {
            unset($dataFiltered['hinh_minh_hoa']);
        } else {
            $dataFiltered['hinh_minh_hoa'] = 'baiviet/' . $fullNameHinhMinhHoa;
        }

        $edit = $baiVietTable->update($dataFiltered, array("idbai_viet = ?" => $file));
        if ($edit) {
            $this->_helper->FlashMessenger()->setNamespace('edit-successful')->addMessage('Bản ghi đã được sửa đổi thành công!');
        } else {
            $this->_helper->FlashMessenger()->setNamespace('edit-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được sửa đổi!');
        }

        $this->_helper->redirector->gotoSimple("edit", "baiviet", "admin", array("file" => $file));
    }

    public function deleteAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $file = $this->getParam("file");
        if (!$file) {
            return;
        }
        $baiVietTable = new Admin_Model_Baiviet;

        $delete = $baiVietTable->delete(array("idbai_viet =?" => $file));
        if ($delete) {
            $this->_helper->FlashMessenger()->setNamespace('delete-successful')->addMessage('Bản ghi đã được xóa thành công!');
        } else {
            $this->_helper->FlashMessenger()->setNamespace('delete-false')->addMessage('Có lỗi xảy ra, bản ghi chưa được xóa!');
        }
        $this->_helper->redirector->gotoSimple("index", "baiviet", "admin");
    }

}
