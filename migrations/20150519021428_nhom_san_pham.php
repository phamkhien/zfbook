<?php

use Phinx\Migration\AbstractMigration;

class NhomSanPham extends AbstractMigration
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
     $table = $this->table('nhom_san_pham', array('id' => false, 'primary_key' => 'idnhom_san_pham'));
        $table->addColumn('idnhom_san_pham', 'integer', array('identity' => true))
                ->addColumn('ten_nhom_san_pham', 'string', array('limit' => 50))
                ->addColumn('parent', 'integer')
                ->save();

        $this->execute("INSERT INTO nhom_san_pham(ten_nhom_san_pham, parent) VALUES ('Adidas','0'),"
                . "('Niken','0'),"
                . "('Sport Adidas','1'),"
                . "('Adidas pro','1')");
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}