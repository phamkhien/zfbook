<?php

use Phinx\Migration\AbstractMigration;

class NhomTaiKhoan extends AbstractMigration
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
     $table = $this->table('nhom_tai_khoan', array('id' => false, 'primary_key' => 'idnhom_tai_khoan'));
        $table->addColumn('idnhom_tai_khoan', 'integer', array('identity' => true))
                ->addColumn('ten_nhom_tai_khoan', 'string', array('limit' => 50))
                ->addColumn('role', 'integer')
                ->save();
     $this->execute("INSERT INTO nhom_tai_khoan(ten_nhom_tai_khoan, role) VALUES ('Member','0'),"
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