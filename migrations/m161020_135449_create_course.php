<?php

use yii\db\Migration;

class m161020_135449_create_course extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        
        }
        $this->createTable('{{%course}}', [
            'id' => $this->primaryKey(),        
            'course_name' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%course}}');
    }

}
