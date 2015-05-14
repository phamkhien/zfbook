<?php

use Phinx\Migration\AbstractMigration;

class TaiKhoan extends AbstractMigration {
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
        $table = $this->table('tai_khoan', array('id' => false, 'primary_key' => 'idtai_khoan'));
        $table->addColumn('idtai_khoan', 'integer', array('identity' => true))
                ->addColumn('ten_dang_nhap', 'string', array('limit' => 50))
                ->addColumn('mat_khau', 'string', array('limit' => 50))
                ->addColumn('avatar', 'string', array('limit' => 200))
                ->addColumn('ho_va_ten', 'string', array('limit' => 50))
                ->addColumn('ngay_sinh', 'date')
                ->addColumn('gioi_tinh', 'integer')
                ->addColumn('email', 'string', array('limit' => 50))
                ->addColumn('dien_thoai', 'string', array('limit' => 20))
                ->addColumn('ngay_dang_ky', 'datetime')
                ->save();

//        $this->execute("INSERT INTO nhom_bai_viet(ten_nhom_bai_viet, parent) VALUES ('Xã hội','0'),"
//                . "('Thể thao','0'),"
//                . "('Kinh doanh','0'),"
//                . "('Văn hóa','0'),"
//                . "('Giải trí','0'),"
//                . "('Chính trị','1'), "
//                . "('Giao thông','1'), "
//                . "('Bóng đá','2'),"
//                . "('Môi trường','1'),"
//                . "('Âm nhạc','5')");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
