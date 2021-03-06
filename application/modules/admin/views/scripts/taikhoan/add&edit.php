<?php
if (!$this->formEdit AND ! $this->formAdd) {
    return;
}
if ($this->formAdd) {
    $form = $this->formAdd;
}
if ($this->formEdit) {
    $form = $this->formEdit;
}
?>
<div class="div-content-left"> 
    <h4>
        Thông tin bắt buộc
    </h4>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
                <?php echo $form->getElement('ten_dang_nhap'); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-cog"></span></div>
                <?php echo $form->getElement('mat_khau'); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-cog"></span></div>
                <?php echo $form->getElement('repeat_mat_khau'); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                <?php echo $form->getElement('email'); ?>
            </div>
        </div>
        <?php echo $form->getElement('submit')->setLabel('Submit')->setAttrib('id','submit-register') ; ?>


</div>
<div class="div-content-right"> 
    <h4>
        Thông tin bổ sung
    </h4>
      <div class="form-group">
        <?php echo $form->getElement('nhom_tai_khoan_id'); ?>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon">Avatar</div>
            <?php echo $form->getElement('avatar'); ?>
        </div>
    </div>
    <div class="form-group">  
        <?php echo $form->getElement('ho_va_ten'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->getElement('ngay_sinh'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->getElement('gioi_tinh'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->getElement('dien_thoai'); ?>
    </div>
</form>
</div>
