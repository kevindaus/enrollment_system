<?php

use yii\db\Migration;

/**
 * Handles the creation of table `examination_log`.
 */
class m161217_165858_create_examination_log_table extends Migration
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
        $this->createTable('{{%examination_log}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(),
            'examination_date' => $this->dateTime(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ], $tableOptions);       

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('examination_log');
    }
}
