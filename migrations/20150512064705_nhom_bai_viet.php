<?php

use Phinx\Migration\AbstractMigration;

class NhomBaiViet extends AbstractMigration
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
    $table = $this->table('nhom_bai_viet', array('id' => false, 'primary_key' => 'idnhom_bai_viet'));
        $table  ->addColumn('idnhom_bai_viet', 'integer', array('identity' => true))
                ->addColumn('ten_nhom_bai_viet', 'string', array('limit' => 50))
                ->addColumn('parent', 'integer')
                ->save();
        
        $this->execute("INSERT INTO nhom_bai_viet(ten_nhom_bai_viet, parent) VALUES ('Xã hội','0'),"
                . "('Thể thao','0'),"
                . "('Kinh doanh','0'),"
                . "('Văn hóa','0'),"
                . "('Giải trí','0'),"
                . "('Chính trị','1'), "
                . "('Giao thông','1'), "
                . "('Bóng đá','2'),"
                . "('Môi trường','1'),"
                . "('Âm nhạc','5')"); 
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}