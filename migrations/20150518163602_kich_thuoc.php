<?php

use Phinx\Migration\AbstractMigration;

class KichThuoc extends AbstractMigration {
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
        $table = $this->table('kich_thuoc', array('id' => false, 'primary_key' => 'idkich_thuoc'));
        $table->addColumn('idkich_thuoc', 'integer', array('identity' => true))
                ->addColumn('size', 'integer', array('limit' => 50))
                ->save();

        $this->execute("INSERT INTO kich_thuoc(size) VALUES ('30'),"
                . "('31'),"
                . "('32'),"
                . "('33'),"
                . "('34'),"
                . "('35'),"
                . "('36'),"
                . "('37'),"
                . "('38'),"
                . "('39'),"
                . "('40'),"
                . "('41'),"
                . "('42'),"
                . "('43'),"
                . "('44'),"
                . "('45')");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
