<?php

use Phinx\Migration\AbstractMigration;

class ChatLieu extends AbstractMigration {
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
        $table = $this->table('chat_lieu', array('id' => false, 'primary_key' => 'idchat_lieu'));
        $table->addColumn('idchat_lieu', 'integer', array('identity' => true))
                ->addColumn('ten_chat_lieu', 'string', array('limit' => 50))
                ->save();

        $this->execute("INSERT INTO chat_lieu(ten_chat_lieu) VALUES ('Da'),"
                . "('Vải')");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        
    }

}
