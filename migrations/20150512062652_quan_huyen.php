<?php

use Phinx\Migration\AbstractMigration;

class QuanHuyen extends AbstractMigration {
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
        $table = $this->table('quan_huyen', array('id' => false, 'primary_key' => 'idquan_huyen'));
        $table->addColumn('idquan_huyen', 'integer', array('identity' => true))
                ->addColumn('ten_quan_huyen', 'string', array('limit' => 50))
                ->addColumn('tinh_thanh_pho_id', 'integer')
                ->save();

        $this->execute("INSERT INTO quan_huyen(ten_quan_huyen, tinh_thanh_pho_id) VALUES ('Từ Liêm','1'),"
                . "('Đông Áng','2'),"
                . "('Trung Lung','2'),"
                . "('Hòa Ngoặc ','3'),"
                . "('Lung Tung','2'),"
                . "('Gia Viên','2'),"
                . "('Khung Sắc','5'),"
                . "('Đại Tu','6'),"
                . "('Trùng Phùng','9'),"
                . "('Đã Ôi','10')");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
