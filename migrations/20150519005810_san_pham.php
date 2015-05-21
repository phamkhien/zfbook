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
                ->addColumn('gia_nhap', 'float')
                ->addColumn('gia_de_xuat', 'float')
                ->addColumn('gia_ban', 'float')
                ->addColumn('do_cao_id', 'integer')
                ->addColumn('xuat_xu_id', 'integer')
                ->addColumn('nhom_san_pham_id', 'integer')
                ->addColumn('chat_lieu_id', 'integer')
                ->addColumn('tinh_trang_id', 'integer')
                ->save();
         $this->execute("INSERT INTO san_pham "
                 . "(ma_san_pham,ten_san_pham,gioi_tinh,gia_nhap,gia_de_xuat,gia_ban,do_cao_id,xuat_xu_id,nhom_san_pham_id,chat_lieu_id,tinh_trang_id ) VALUES"
                 . "('BOY-0044','ten sp1', '1', '15000', '25000', '20000', '1', '2', '1', '1', '1'),"
              . "('GIRL-0044','ten sp2', '1', '16000', '22000', '19000', '1', '2', '1', '1', '1')");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
