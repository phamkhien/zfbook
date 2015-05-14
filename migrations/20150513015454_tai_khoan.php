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
                ->addColumn('nhom_tai_khoan_id', 'integer')
                ->save();

        $this->execute("INSERT INTO tai_khoan(ten_dang_nhap, mat_khau, nhom_tai_khoan_id, email) VALUES "
                . "('admin', md5('admin'), 7,'admin@gmail.com'),"
                . "('member',md5('member'),1, 'member@gmail.com'),"
                . "('editor',md5('editor'),2, 'editor@gmail.com'),"
                . "('deleter',md5('deleter'),4, 'delete@gmail.com')");
    }

    
    public function down() {
        
    }

}
