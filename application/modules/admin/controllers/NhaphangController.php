<?php

class Admin_NhaphangController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
        $controllerNameInBreadcrumb = "Nhập sản phẩm";
        $this->view->controllerNameInBreadcrumb = $controllerNameInBreadcrumb;
    }

    public function indexAction() {
        $defaultNamespace = new Zend_Session_Namespace('cart');

        $defaultNamespace->cart[1][1] = 1111111111111112312;
        $defaultNamespace->cart[1][2] = 111111111113233;
        $defaultNamespace->cart[1][3] = 1231342;
        echo count($defaultNamespace->cart);
        var_dump($defaultNamespace->cart);
//        $defaultNamespace->i->mau_sac = 3423;
//        $defaultNamespace->i->kich_thuoc = 12312;
//        $defaultNamespace->mau_sac_id = 2;
//        $defaultNamespace->kich_thuoc_id = 3;


        die();
    }

    public function addsanphamAction() {
        $this->view->headTitle('Nhập hàng về kho');

        $sanPhamId = $file = $this->getParam("file");
        $sanPhamtable = new Admin_Model_Sanpham;
        $rowSanPham = $sanPhamtable->fetchAll(array('idsan_pham' => $sanPhamId));

        $rowCount = count($rowSanPham);
        if (0 == $rowCount) {
            $this->view->noRecord = "true";
            return;
        }

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

        var_dump($dataFiltered);

        $sessionCart = new Zend_Session_Namespace('cart');
        $countSessionCart = count($sessionCart->item);

        $sessionCart->item[$countSessionCart]['mau_sac_id'] = 3423;
        $sessionCart->item[$countSessionCart]['kich_thuoc_id'] = 2;
        $sessionCart->item[$countSessionCart]['so_luong'] = 3;
        var_dump($sessionCart->item);
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

    public function addthuoctinhAction() {
        $this->view->headTitle('Nhập hàng về kho');

        $sanPhamId = $file = $this->getParam("file");
        if (!$sanPhamId) {
            return;
        }

        $sanPhamtable = new Admin_Model_Sanpham;
        $rowSanPham = $sanPhamtable->fetchRow(array('idsan_pham=?' => $sanPhamId));
        $rowCount = count($rowSanPham);
        if (0 == $rowCount) {
            return;
        }

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
        $kichThuocChecked = $dataFiltered['kich_thuoc_id'];

        $mauSacSelected = $dataFiltered['mau_sac_id'];
        $soLuongInput = $dataFiltered['so_luong'];
        $giaNhap = $rowSanPham->gia_nhap;
        if ($kichThuocChecked == NULL) {
            echo "X";
            die();
        }
        for ($i = 0; $i < count($kichThuocChecked); $i++) {
            $sessionCart = new Zend_Session_Namespace('cart');

            $sessionCart->cart[$sanPhamId][$mauSacSelected][$kichThuocChecked[$i]]['san_pham_id'] = $sanPhamId;
            $sessionCart->cart[$sanPhamId][$mauSacSelected][$kichThuocChecked[$i]]['mau_sac_id'] = $mauSacSelected;
            $sessionCart->cart[$sanPhamId][$mauSacSelected][$kichThuocChecked[$i]]['kich_thuoc_id'] = $kichThuocChecked[$i];
            $sessionCart->cart[$sanPhamId][$mauSacSelected][$kichThuocChecked[$i]]['so_luong'] = $soLuongInput[$kichThuocChecked[$i]];
            $sessionCart->cart[$sanPhamId][$mauSacSelected][$kichThuocChecked[$i]]['gia_nhap'] = $giaNhap;
        }

        echo "<pre>";
        print_r($sessionCart->cart);
        echo "</pre>";
        var_dump($sessionCart->cart);
        die();
    }

    public function adddonhangAction() {
        $this->view->headTitle('Nhập hàng về kho');

        $sessionCart = new Zend_Session_Namespace('cart');
        if ($sessionCart->cart == NULL) {
            echo "x";
            return;
        }

        $request = $this->getRequest();
        $isPost = $request->isPost();
        if (!$isPost) {
            return;
        }
        $listCart = $sessionCart->cart;
        $totalMoney = 0;
        foreach ($listCart as $valSanPham) {
            foreach ($valSanPham as $valMauSac) {
                foreach ($valMauSac as $valsize) {
                    $totalMoney += $valsize['so_luong'] * $valsize['gia_nhap'];
                    echo $totalMoney . "<br />";
                }
            }
        }
        $dataInsert = array(
                        'tai_khoan_id' => 1,
                        'thoi_gian' =>  time(),
                        'tong_tien' => $totalMoney
                      );
        $donHangTable = new Admin_Model_Hoadonnhap;
        $add = $donHangTable->insert($dataInsert);
        if ($add) {
            $this->_helper->FlashMessenger()
                    ->setNamespace('add-successful')
                    ->addMessage('Bản ghi đã được thêm thành công!');
        } else {
            $this->_helper->FlashMessenger()
                    ->setNamespace('add-false')
                    ->addMessage('Có lỗi xảy ra, bản ghi chưa được thêm mới!');
        }

        $this->_helper->redirector->gotoSimple("print", "nhaphang");
    }

    public function editAction() {

        $sessionCart = new Zend_Session_Namespace('cart');



        var_dump($sessionCart->item);
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
