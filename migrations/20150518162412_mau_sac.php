<?php

use Phinx\Migration\AbstractMigration;

class MauSac extends AbstractMigration {
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
        $table = $this->table('mau_sac', array('id' => false, 'primary_key' => 'idmau_sac'));
        $table->addColumn('idmau_sac', 'integer', array('identity' => true))
                ->addColumn('ten_mau_sac', 'string', array('limit' => 50))
                ->addColumn('ma_mau', 'string', array('limit' => 50))
                ->save();

        $this->execute("INSERT INTO mau_sac(ten_mau_sac, ma_mau) VALUES ('Đỏ','#FF0000'),"
                . "('Đen','#000000'),"
                . "('Xanh lá','#00FF33'),"
                . "('Xanh thẫm ','#000099'),"
                . "('Trắng','#FFFFFF'),"
                . "('Khác ','#000099')");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
