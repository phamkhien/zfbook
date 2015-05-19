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
    <div class="row"> 
        <div class="form-group col-sm-6">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-cog"> </span> Hình minh họa</div>
                <?php echo $form->getElement('hinh_minh_hoa'); ?>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"> </span> Chuyên mục</div>
                <?php echo $form->getElement('nhom_bai_viet_id'); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div><label>Giới thiệu</label></div> 
        <?php echo $form->getElement('gioi_thieu'); ?>
    </div>
    <div class="form-group">
        <div><label>Nội dung</label></div> 
        <?php echo $form->getElement('noi_dung'); ?>

    </div>

    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-menu-hamburger"> </span> Trạng thái</div>
            <?php echo $form->getElement('trang_thai'); ?>
        </div>
    </div>
    <?php echo $form->getElement('submit')->setLabel('Submit')->setAttrib('id', 'submit-register'); ?>
</form>
<script>
    CKEDITOR.replace('noi_dung', {
        height: ['300px']
    });
</script>

<script>
    CKEDITOR.replace('gioi_thieu', {
        toolbar: [
            {name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']}, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', 'Bold', 'Italic'], // Defines toolbar group without name.
            '/'																				// Line break - next group will be placed in new line.

        ],
        height: ['100px'],
        weight: ['100%']

    }
    );

</script>