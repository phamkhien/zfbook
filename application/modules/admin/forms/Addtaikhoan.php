<?php

class Admin_Form_Addtaikhoan extends Zend_Form {

    public function init() {
      
        $this->setMethod('POST');
        $userNameLogin = new Zend_Form_Element_Text('ten_dang_nhap');
        $password = new Zend_Form_Element_Password('mat_khau');
        $repeatPassword = new Zend_Form_Element_Password('repeat_mat_khau');
        $submit = new Zend_Form_Element_Submit('submit');
        $avatar = new Zend_Form_Element_File('avatar');
        $userName = new Zend_Form_Element_Text('ho_va_ten');
        $birthday = new Zend_Form_Element_Text('ngay_sinh');
        $sex = new Zend_Form_Element_Select('gioi_tinh');
        $group_user = new Zend_Form_Element_Select('nhom_tai_khoan_id');
        $email = new Zend_Form_Element_Text('email');
        $phone = new Zend_Form_Element_Text('dien_thoai');
        // $timeRegister = new Zend_Form_Element_Hidden('ngay_dang_ky');

        $userNameLogin->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Tên đăng nhập")
                ->addFilter('StringTrim')
                ->addValidator('stringLength', false, array(3, 50));

        $password->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("id", "mat_khau")
                ->setAttrib("placeholder", "Mật khẩu")
                ->addFilter('StringTrim')
                ->addValidator('stringLength', false, array(3, 50));
        $repeatPassword->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("id", "repeat_mat_khau")
                ->setAttrib("placeholder", "Nhập lại mật khẩu")
                ->addFilter('StringTrim')
                ->addValidator('stringLength', false, array(3, 50));

        $avatar->setAttrib("class", "form-control")
                ->setDestination(APPLICATION_PATH . '/../public/file/avatar')
        ;

        $userName->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Họ và tên")
                ->addFilter('StringTrim')
                ->setAttrib('maxLength', 50);
        
        $email->setRequired(true)
                ->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Email")
                ->addFilter('StringTrim')
                ->addValidator('EmailAddress')
                ->setAttrib('maxLength', 50);

        $phone->setAttrib("class", "form-control")
                ->setAttrib("placeholder", "Điện thoại")
                ->addFilter('StringTrim')
                ->setAttrib('maxLength', 20);

        $birthday->setAttrib("id", "datepicker")
                ->setAttrib("placeholder", "Ngày sinh")
                ->setAttrib("class", "form-control");
       
        $group_user->setValue('1')
                ->setAttrib("class", "form-control")
                ->setMultiOptions($this->getGroupUser());
        
        $sex->setAttrib("class", "form-control")
                ->setMultiOptions($this->getSex());

        $submit->setAttrib("class", "btn btn-primary")
                ->setAttrib("value ", "Submit")
                ->setAttrib("id ", "submit-register");

        $this->addElement($userNameLogin);
        $this->addElement($password);
        $this->addElement($repeatPassword);
        $this->addElement($avatar);
        $this->addElement($userName);
        $this->addElement($birthday);
        $this->addElement($sex);
        $this->addElement($group_user);
        $this->addElement($email);
        $this->addElement($phone);
        $this->addElement($submit);

        foreach ($this->getElements() as $element) {
            $element->removeDecorator('Label');
        }
    }

    protected function getSex() {
        $arraySex = array("1" => "Nam", "2" => "Nữ");
        return $arraySex;
    }
     protected function getGroupUser() {
       $groupUserTable = new Admin_Model_Nhomtaikhoan;
       $select = $groupUserTable->select()->from('nhom_tai_khoan',
                    array('idnhom_tai_khoan', 'ten_nhom_tai_khoan'));
       $listGroupUser = $groupUserTable->fetchAll($select);
      
       $arrayGroupUser = array();
       foreach($listGroupUser as $groupUser){
           $arrayGroupUser[$groupUser['idnhom_tai_khoan']] = $groupUser['ten_nhom_tai_khoan'];
       }
      
       return $arrayGroupUser;
       
    }

}
