<?php

use Phinx\Migration\AbstractMigration;

class GiamGia extends AbstractMigration {
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
        $table = $this->table('giam_gia', array('id' => false, 'primary_key' => 'idgiam_gia'));
        $table->addColumn('idgiam_gia', 'integer', array('identity' => true))
                ->addColumn('gia_tri', 'integer')
                ->save();

        $this->execute("INSERT INTO giam_gia(gia_tri) VALUES ('0'),"
                . "('5'),"
                . "('10'),"
                . "('15'),"
                . "('20'),"
                . "('25'),"
                . "('30'),"
                . "('35')");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
