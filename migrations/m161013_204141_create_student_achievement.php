<?php

use yii\db\Migration;

class m161013_204141_create_student_achievement extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        
        }
        $this->createTable('{{%student_achievement}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(),
            'achievement_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);
        /*create the foreign key here for student*/
        /*create the foreign key here for achievement*/
        $this->addForeignKey('student_fk', 'student_achievement', 'student_id', 'student_information', 'id');
        $this->addForeignKey('achievement_fk', 'student_achievement', 'achievement_id', 'achievement', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('student_fk','student_achievement');
        $this->dropForeignKey('achievement_fk', 'student_achievement');
        $this->dropTable('{{%student_achievement}}');
    }
}
