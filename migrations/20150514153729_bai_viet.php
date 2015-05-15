<?php

use Phinx\Migration\AbstractMigration;

class BaiViet extends AbstractMigration {
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
      public function change()
      {
      }
     */

    /**
     * Migrate Up.
     */
    public function up() {
        $table = $this->table('bai_viet', array('id' => false, 'primary_key' => 'idbai_viet'));
        $table->addColumn('idbai_viet', 'integer', array('identity' => true))
                ->addColumn('tieu_de', 'string', array('limit' => 200))
                ->addColumn('hinh_minh_hoa', 'string', array('limit' => 200))
                ->addColumn('gioi_thieu', 'text')
                ->addColumn('noi_dung', 'text')
                ->addColumn('trang_thai', 'integer')
                ->addColumn('thoi_gian', 'datetime')
                ->addColumn('nhom_bai_viet_id', 'integer')
                ->addColumn('tai_khoan_id', 'integer')
                ->save();

        $this->execute("INSERT INTO bai_viet"
                . "(tieu_de, hinh_minh_hoa, gioi_thieu, noi_dung, trang_thai, nhom_bai_viet_id, tai_khoan_id) "
                . "VALUES "
                . "('Tieu de 1','abc.jpg', 'gioi thieu chung chung', 'noi dung cu the','1','1','1'),"
                . "('Tieu de 2','abc2.jpg', 'gioi thieu chung chung2', 'noi dung cu the2','2','2','2')");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
