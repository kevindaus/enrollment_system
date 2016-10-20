<?php

use yii\db\Migration;

/**
 * Handles the creation of table `couse`.
 */
class m161016_095448_create_couse_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%course}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'description'=>$this->text(),
            'unit'=>$this->integer(),
            'department_image'=>$this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%course}}');
    }
}
