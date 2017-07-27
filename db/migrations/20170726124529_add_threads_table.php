<?php

use Phinx\Migration\AbstractMigration;

class AddThreadsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('threads');

        $table->addColumn('category_id', 'integer')
            ->addColumn('title', 'string', ['limit' => 255])
            ->addColumn('create_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('deleted_at', 'boolean', ['null' => true])
            ->addForeignKey('category_id' ,'categories', 'id')
            ->save();
    }
}