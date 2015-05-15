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
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div>
            <?php echo $form->getElement('tieu_de'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-cog"> Hình minh họa</span></div>
            <?php echo $form->getElement('hinh_minh_hoa'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-pushpin"></span></div>
            <?php echo $form->getElement('gioi_thieu'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
            <?php echo $form->getElement('noi_dung'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"> Chuyên mục</span></div>
            <?php echo $form->getElement('nhom_bai_viet_id'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"> Trạng thái</span></div>
            <?php echo $form->getElement('trang_thai'); ?>
        </div>
    </div>
    <?php echo $form->getElement('submit')->setLabel('Submit')->setAttrib('id', 'submit-register'); ?>
</form>