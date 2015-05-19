<?php

use Phinx\Migration\AbstractMigration;

class SanPham extends AbstractMigration {
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
        $table = $this->table('san_pham', array('id' => false, 'primary_key' => 'idsan_pham'));
        $table->addColumn('idsan_pham', 'integer', array('identity' => true))
                ->addColumn('ma_san_pham', 'string', array('limit' => 50))
                ->addColumn('ten_san_pham', 'string', array('limit' => 50))
                ->addColumn('gioi_tinh', 'integer')
                ->addColumn('xuat_xu', 'string', array('limit' => 50))
                ->addColumn('do_cao', 'string', array('limit' => 50))
                ->addColumn('gia_nhap', 'float')
                ->addColumn('gia_de_xuat', 'float')
                ->addColumn('gia_ban', 'float')
                ->addColumn('nhom_san_pham_id', 'integer')
                ->addColumn('chat_lieu_id', 'integer')
                ->addColumn('tinh_trang_id', 'integer')
                ->addColumn('mau_sac', 'integer')
                ->save();

    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
