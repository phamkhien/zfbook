<?php

class Admin_NhaphangController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
        $controllerNameInBreadcrumb = "Nhập sản phẩm";
        $this->view->controllerNameInBreadcrumb = $controllerNameInBreadcrumb;
    }

    public function indexAction() {
        $defaultNamespace = new Zend_Session_Namespace('cart');

        $defaultNamespace->san_pham_id = 3423;
        $defaultNamespace->mau_sac_id = 2;
        $defaultNamespace->kich_thuoc_id = 3;
        var_dump($defaultNamespace);
        die();
    }

    public function addAction() {
        $this->view->headTitle('Nhập hàng về kho');
        $formAdd = new Admin_Form_Addnhaphang;
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
        $kichThuoc = $dataFiltered['kich_thuoc_id'];


        var_dump($dataFiltered);
        $defaultNamespace = new Zend_Session_Namespace('cart');

        $defaultNamespace->san_pham_id = 3423;
        $defaultNamespace->mau_sac_id = 2;
        $defaultNamespace->kich_thuoc_id = 3;
        var_dump($cart);
        die();
        // $nhapHangTable = new Admin_Model_Thuoctinh;

        for ($i = 0; $i < count($kichThuoc); $i++) {
            $defaultNamespace = new Zend_Session_Namespace('cart');
            $defaultNamespace->san_pham_id = 1;
            $defaultNamespace->mau_sac_id = 1;
            $defaultNamespace->kich_thuoc_id = $kichThuoc[$i];

//        $add = $nhapHangTable->insert(array(
//                'san_pham_id' => 1,
//                'mau_sac_id' => 1,
//                'kich_thuoc_id' => $kichThuoc[$i],
//                'so_luong' => $dataFiltered['so_luong'][$kichThuoc[$i]]
//                    )
//            );
        }
        var_dump($defaultNamespace);
        die();
        die();
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
        $defaultNamespace = new Zend_Session_Namespace('cart');
       

        var_dump($defaultNamespace->san_pham_id);
        die();
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
