<?php

use Phinx\Migration\AbstractMigration;

class TinhThanhPho extends AbstractMigration {
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

        $table = $this->table('tinh_thanh_pho', array('id' => false, 'primary_key' => 'idtinh_thanh_pho'));
        $table  ->addColumn('idtinh_thanh_pho', 'integer', array('identity' => true))
                ->addColumn('ten_tinh_thanh_pho', 'string', array('limit' => 50))
                ->save();
        
        $this->execute("INSERT INTO tinh_thanh_pho(ten_tinh_thanh_pho) VALUES ('Hà Nội'),"
                . "('Nam Định'),"
                . "('Thái Bình'),"
                . "('Ninh Bình'),"
                . "('Hưng Yên'),"
                . "('Đà Nẵng'), "
                . "('Quảng Nam'), "
                . "('Vinh'),"
                . "('Hồ Chí Minh'),"
                . "('Đồng Tháp')"); 

    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
