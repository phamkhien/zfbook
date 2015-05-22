<?php

class Admin_NhaphangController extends Zendvn_Controller_Action {

    public function init() {
        parent::init();
        $controllerNameInBreadcrumb = "Nhập sản phẩm";
        $this->view->controllerNameInBreadcrumb = $controllerNameInBreadcrumb;
    }

    public function indexAction() {
        var_dump($this->mapIdToNameSanPham());
        die();
        $a = 11;
        if ($a) {
            echo "x";
        } else {
            echo 'y';
        }
//        $defaultNamespace = new Zend_Session_Namespace('cart');
//
//        $defaultNamespace->cart[1][1] = 1111111111111112312;
//        $defaultNamespace->cart[1][2] = 111111111113233;
//        $defaultNamespace->cart[1][3] = 1231342;
//        echo count($defaultNamespace->cart);
//        var_dump($defaultNamespace->cart);
//        $defaultNamespace->i->mau_sac = 3423;
//        $defaultNamespace->i->kich_thuoc = 12312;
//        $defaultNamespace->mau_sac_id = 2;
//        $defaultNamespace->kich_thuoc_id = 3;


        die();
    }

    public function addsanphamAction() {
        $this->view->headTitle('Nhập sản phẩm');
        $formAdd = new Admin_Form_Addsanpham;
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

        $sanPhamtable = new Admin_Model_Sanpham;
        $add = $sanPhamtable->insert($dataFiltered);
        if ($add) {
            $this->_helper->getHelper('FlashMessenger')
                    ->setNamespace('add-successful')
                    ->addMessage('Bản ghi đã được thêm thành công!');
        } else {
            $this->_helper->getHelper('FlashMessenger')
                    ->setNamespace('add-false')
                    ->addMessage('Có lỗi xảy ra, bản ghi chưa được thêm mới!');
        }
        $this->_helper->redirector->gotoSimple("addthuoctinh", "nhaphang", "admin", array("file" => $add));
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
        $this->view->mapIdToNameSanPham = $this->mapIdToNameSanPham();
        $this->view->mapIdToNameKichThuoc = $this->mapIdToNameKichThuoc();
        $this->view->mapIdToNameMauSac = $this->mapIdToNameMauSac();
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
        $this->_helper->redirector->gotoSimple("addthuoctinh", "nhaphang", "admin", array("file" => $sanPhamId));
    }

    public function adddonhangAction() {
        $this->view->headTitle('Nhập hàng về kho');

        $sessionCart = new Zend_Session_Namespace('cart');
        if ($sessionCart->cart == NULL) {
            echo "x";
            return;
        }
        $this->view->mapIdToNameSanPham = $this->mapIdToNameSanPham();
        $this->view->mapIdToNameKichThuoc = $this->mapIdToNameKichThuoc();
        $this->view->mapIdToNameMauSac = $this->mapIdToNameMauSac();

        $listCart = $sessionCart->cart;
        $totalMoney = 0;
        foreach ($listCart as $valSanPham) {
            foreach ($valSanPham as $valMauSac) {
                foreach ($valMauSac as $valsize) {
                    $totalMoney += $valsize['so_luong'] * $valsize['gia_nhap'];
                }
            }
        }

        $this->view->totalMoney = $totalMoney;

        $request = $this->getRequest();
        $isPost = $request->isPost();
        if (!$isPost) {
            return;
        }


        $timeNow = date('Y/m/d h:i:s a', time());
        $dataInsert = array(
            'tai_khoan_id' => 1,
            'thoi_gian' => $timeNow,
            'tong_tien' => $totalMoney
        );
        $donHangTable = new Admin_Model_Hoadonnhap;
        $add = $donHangTable->insert($dataInsert);
        if ($add) {
            $this->_helper->getHelper('FlashMessenger')
                    ->setNamespace('add-successful')
                    ->addMessage('Bản ghi đã được thêm thành công!');
        } else {
            $this->_helper->getHelper('FlashMessenger')
                    ->setNamespace('add-false')
                    ->addMessage('Có lỗi xảy ra, bản ghi chưa được thêm mới!');
        }
        $chiTietNhapTable = new Admin_Model_Chitietnhap;
        $thuocTinhTable = new Admin_Model_Thuoctinh;
        foreach ($listCart as $valSanPham) {
            foreach ($valSanPham as $valMauSac) {
                foreach ($valMauSac as $valsize) {
                    $dataInsertChiTietNhap = array(
                        'mau_sac_id' => $valsize['mau_sac_id'],
                        'kich_thuoc_id' => $valsize['kich_thuoc_id'],
                        'san_pham_id' => $valsize['san_pham_id'],
                        'so_luong' => $valsize['so_luong'],
                        'hoa_don_nhap_id' => $add,
                    );
                    $dataInsertThuocTinh = array(
                        'mau_sac_id' => $valsize['mau_sac_id'],
                        'kich_thuoc_id' => $valsize['kich_thuoc_id'],
                        'san_pham_id' => $valsize['san_pham_id'],
                        'so_luong' => $valsize['so_luong'],
                    );
                    $chiTietNhapTable->insert($dataInsertChiTietNhap);
                    $thuocTinhTable->insert($dataInsertThuocTinh);
                }
            }
        }
        $this->_helper->redirector->gotoSimple("print", "nhaphang", "admin", array("file" => $add));
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

    public function mapIdToNameSanPham() {
        $Table = new Admin_Model_Sanpham;
        $select = $Table->select()->from('san_pham', array('idsan_pham', 'ten_san_pham'));
        $list = $Table->fetchAll($select);
        $array = array();
        foreach ($list as $item) {
            $array[$item['idsan_pham']] = $item['ten_san_pham'];
        }
        return $array;
    }

    public function mapIdToNameKichThuoc() {
        $Table = new Admin_Model_Kichthuoc();
        $select = $Table->select()->from('kich_thuoc', array('idkich_thuoc', 'size'));
        $list = $Table->fetchAll($select);
        $array = array();
        foreach ($list as $item) {
            $array[$item['idkich_thuoc']] = $item['size'];
        }
        return $array;
    }

    public function mapIdToNameMauSac() {
        $Table = new Admin_Model_Mausac();
        $select = $Table->select()->from('mau_sac', array('idmau_sac', 'ten_mau_sac'));
        $list = $Table->fetchAll($select);
        $array = array();
        foreach ($list as $item) {
            $array[$item['idmau_sac']] = $item['ten_mau_sac'];
        }
        return $array;
    }

}
