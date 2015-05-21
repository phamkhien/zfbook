<?php

use Phinx\Migration\AbstractMigration;

class XuatXu extends AbstractMigration {
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
        $table = $this->table('xuat_xu', array('id' => false, 'primary_key' => 'idxuat_xu'));
        $table->addColumn('idxuat_xu', 'integer', array('identity' => true))
                ->addColumn('noi_xuat_xu', 'string', array('limit' => 50))
                ->save();

        $this->execute("INSERT INTO xuat_xu(noi_xuat_xu) VALUES ('Việt Nam'),"
                . "('Trung Quốc'),"
                . "('Hàn Quốc'),"
                . "('Chưa rõ')");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
