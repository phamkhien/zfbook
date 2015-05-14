<?php

use Phinx\Migration\AbstractMigration;

class GroupUser extends AbstractMigration
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
     $table = $this->table('group_user', array('id' => false, 'primary_key' => 'idgroup_user'));
        $table->addColumn('idgroup_user', 'integer', array('identity' => true))
                ->addColumn('ten_group_user', 'string', array('limit' => 50))
                ->addColumn('role', 'integer')
                ->save();
     $this->execute("INSERT INTO group_user(ten_group_user, role) VALUES ('Member','0'),"
                . "('Reader','1'),"
                . "('Editor','2'),"
                . "('Deleter ','4'),"
                . "('Admin','7')");
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}