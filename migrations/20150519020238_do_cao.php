<?php

use Phinx\Migration\AbstractMigration;

class DoCao extends AbstractMigration
{
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
    public function up()
    {
        $table = $this->table('do_cao', array('id' => false, 'primary_key' => 'iddo_cao'));
        $table->addColumn('iddo_cao', 'integer', array('identity' => true))
                ->addColumn('do_cao', 'integer')
                ->save();

        $this->execute("INSERT INTO do_cao(do_cao) VALUES ('10'),"
                . "('15'),"
                . "('20'),"
                . "('25'),"
                . "('30')");
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}