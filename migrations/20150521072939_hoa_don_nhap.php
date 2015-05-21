<?php

use Phinx\Migration\AbstractMigration;

class HoaDonNhap extends AbstractMigration {
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
        $table = $this->table('hoa_don_nhap', array('id' => false, 'primary_key' => 'idhoa_don_nhap'));
        $table->addColumn('idhoa_don_nhap', 'integer', array('identity' => true))
                ->addColumn('tai_khoan_id', 'integer')
                 ->addColumn('thoi_gian', 'datetime')
                 ->addColumn('tong_tien', 'float')
                ->save();

        $this->execute("INSERT INTO hoa_don_nhap(tai_khoan_id,tong_tien) VALUES ('1','12231212'),"
                . "('2', '12312312'),"
                . "('1', '444444')");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
