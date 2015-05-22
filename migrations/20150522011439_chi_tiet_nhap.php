<?php

use Phinx\Migration\AbstractMigration;

class ChiTietNhap extends AbstractMigration
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
     $table = $this->table('chi_tiet_nhap', array('id' => false, 'primary_key' => 'idchi_tiet_nhap'));
        $table->addColumn('idchi_tiet_nhap', 'integer', array('identity' => true))
                ->addColumn('san_pham_id', 'integer')
                ->addColumn('kich_thuoc_id', 'integer')
                ->addColumn('mau_sac_id', 'integer')
                ->addColumn('so_luong', 'integer')     
                ->addColumn('hoa_don_nhap_id', 'integer')  
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}