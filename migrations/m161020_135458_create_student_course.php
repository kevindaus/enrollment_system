<?php

use yii\db\Migration;

class m161020_135458_create_student_course extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        
        }
        $this->createTable('{{%student_course}}', [
            'id' => $this->primaryKey(),
            "student_id" => $this->integer(),
            "course_id" => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('student_id_fk', '{{%student_course}}', 'student_id', '{{%student_information}}', 'id');
        $this->addForeignKey('course_id_fk', '{{%student_course}}', 'course_id', '{{%course}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('student_id_fk', '{{%student_course}}');
        $this->dropForeignKey('course_id_fk', '{{%student_course}}');
        $this->dropTable('{{%student_course}}');
    }


}
