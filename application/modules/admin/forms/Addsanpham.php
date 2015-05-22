<?php

class Admin_Form_Addsanpham extends Zend_Form {

    public function init() {
        $this->setMethod('POST');

        $maSanPham = new Zend_Form_Element_Text('ma_san_pham');
        $tenSanPham = new Zend_Form_Element_Text('ten_san_pham');
        $giaNhap = new Zend_Form_Element_Text('gia_nhap');
        $giaDeXuat = new Zend_Form_Element_Text('gia_de_xuat');
        $giamGia = new Zend_Form_Element_Select('giam_gia_id');
        $giaBan = new Zend_Form_Element_Text('gia_ban');
        $gioiTinh = new Zend_Form_Element_Select('gioi_tinh');
        $xuatXu = new Zend_Form_Element_Select('xuat_xu_id');
        $doCao = new Zend_Form_Element_Select('do_cao_id');
        $NhomSanPham = new Zend_Form_Element_Select('nhom_san_pham_id');
        $chatLieu = new Zend_Form_Element_Select('chat_lieu_id');
        $tinhTrang = new Zend_Form_Element_Select('tinh_trang_id');
//        $mauSac = new Zend_Form_Element_Select('mau_sac_id');
//        $kichThuoc = new Zend_Form_Element_Select('kich_thuoc_id');
//        $soLuong = new Zend_Form_Element_Text('so_luong');
        $submit = new Zend_Form_Element_Submit('submit');


        $maSanPham->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Mã sản phẩm")
                ->addFilter('StringTrim')
                ->addValidator('stringLength', false, array(3, 200));
        $giaNhap->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Giá nhập")
                ->addFilter('StringTrim')
                ->addValidator('Digits');

        $giaDeXuat->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Giá đề xuất")
                ->addFilter('StringTrim')
                ->addValidator('Digits');
//        $soLuong->setRequired(true)
//                ->setAttrib("class", "form-control")
//                ->setAttrib("placeholder", "Số lượng")
//                ->addFilter('StringTrim')
//                ->addValidator('Digits');

        $giaBan->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Giá bán")
                ->addFilter('StringTrim')
                ->addValidator('Digits');
        $tenSanPham->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Tên sản phẩm")
                ->addFilter('StringTrim')
                ->addValidator('stringLength', false, array(3, 200));

        $giamGia->setAttrib("class", "form-control")
                ->setMultiOptions($this->getGiamGia());

        $gioiTinh->setValue('1')
                ->setAttrib("class", "form-control")
                ->setMultiOptions($this->getSex());

        $xuatXu->setAttrib("class", "form-control")
                ->setMultiOptions($this->getXuatXu());
//
//        $mauSac->setAttrib("class", "form-control")
//                ->setMultiOptions($this->getMauSac());
//
//        $kichThuoc->setAttrib("class", "form-control")
//                ->setMultiOptions($this->getKichThuoc());
        $doCao->setAttrib("class", "form-control")
                ->setMultiOptions($this->getDoCao());

        $arrayParent = array();
        $NhomSanPham->setAttrib("class", "form-control")
                ->setMultiOptions($this->getNhomSanPham($arrayParent, 0, null));

        $chatLieu->setAttrib("class", "form-control")
                ->setMultiOptions($this->getChatLieu());

        $tinhTrang->setAttrib("class", "form-control")
                ->setMultiOptions($this->getTinhTrang());

        $submit->setAttrib("class", "btn btn-primary")
                ->setAttrib("value ", "Submit")
                ->setAttrib("id ", "submit");

        $this->addElement($maSanPham);
        $this->addElement($tenSanPham);
        $this->addElement($giaNhap);
        $this->addElement($giaDeXuat);
        $this->addElement($giamGia);
        $this->addElement($giaBan);
        $this->addElement($gioiTinh);
        $this->addElement($xuatXu);
        $this->addElement($doCao);
        $this->addElement($NhomSanPham);
        $this->addElement($chatLieu);
        $this->addElement($tinhTrang);
//        $this->addElement($mauSac);
//        $this->addElement($kichThuoc);
//        $this->addElement($soLuong);
        $this->addElement($submit);



        foreach ($this->getElements() as $element) {
            $element->removeDecorator('Label');
        }
    }

    protected function getKichThuoc() {
        $mauSacTable = new Admin_Model_Kichthuoc;
        $select = $mauSacTable->select();
        $list = $mauSacTable->fetchAll($select);

        foreach ($list as $item) {
            $array[$item['idkich_thuoc']] = $item['size'];
        }
        return $array;
    }

    protected function getMauSac() {
        $mauSacTable = new Admin_Model_Mausac;
        $select = $mauSacTable->select();
        $list = $mauSacTable->fetchAll($select);

        foreach ($list as $item) {
            $array[$item['idmau_sac']] = $item['ten_mau_sac'];
        }
        return $array;
    }

    protected function getGiamGia() {
        $giamGiaTable = new Admin_Model_Giamgia;
        $select = $giamGiaTable->select()->order('gia_tri ASC');
        $listGiamGia = $giamGiaTable->fetchAll($select);

        foreach ($listGiamGia as $giamGia) {
            $arrayGiamGia[$giamGia['idgiam_gia']] = $giamGia['gia_tri'];
        }
        return $arrayGiamGia;
    }

    protected function getChatLieu() {
        $chatLieuTable = new Admin_Model_Chatlieu;
        $select = $chatLieuTable->select()->order('ten_chat_lieu ASC');
        $listChatLieu = $chatLieuTable->fetchAll($select);

        foreach ($listChatLieu as $chatLieu) {
            $arrayChatLieu[$chatLieu['idchat_lieu']] = $chatLieu['ten_chat_lieu'];
        }
        return $arrayChatLieu;
    }

    protected function getNhomSanPham($arrayParent, $parent, $style = "") {
        $nhomSanPhamTable = new Admin_Model_Nhomsanpham;
        $select = $nhomSanPhamTable->select()->where("parent=?", $parent)->order("ten_nhom_san_pham ASC");
        $listNhomSanPham = $nhomSanPhamTable->fetchAll($select);
        $styles = $style . "--";

        foreach ($listNhomSanPham as $NhomSanPham) {
            $arrayParent[$NhomSanPham['idnhom_san_pham']] = $style . $NhomSanPham['ten_nhom_san_pham'];
            $arrayParent = $this->getNhomSanPham($arrayParent, $NhomSanPham['idnhom_san_pham'], $styles);
        }

        return $arrayParent;
    }

    protected function getDoCao() {
        $doCaoTable = new Admin_Model_Docao;
        $select = $doCaoTable->select()->order('do_cao ASC');
        $listDoCao = $doCaoTable->fetchAll($select);

        foreach ($listDoCao as $doCao) {
            $arrayDoCao[$doCao['iddo_cao']] = $doCao['do_cao'];
        }
        return $arrayDoCao;
    }

    protected function getXuatXu() {
        $xuatXuTable = new Admin_Model_Xuatxu;
        $select = $xuatXuTable->select()->order('noi_xuat_xu ASC');
        $listXuatXu = $xuatXuTable->fetchAll($select);

        foreach ($listXuatXu as $xuatXu) {
            $arrayXuatXu[$xuatXu['idxuat_xu']] = $xuatXu['noi_xuat_xu'];
        }
        return $arrayXuatXu;
    }

    protected function getSex() {
        $arraySatus = array(
            Admin_Model_Sanpham::NAM => "Nam",
            Admin_Model_Sanpham::NU => "Nữ"
        );

        return $arraySatus;
    }

    protected function getTinhTrang() {
        $arraySatus = array(
            Admin_Model_Sanpham::COHANG => "Có sẵn hàng",
            Admin_Model_Sanpham::HETHANG => "Hết hàng"
        );

        return $arraySatus;
    }

}
