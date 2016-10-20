<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student_course`.
 */
class m161016_102231_create_student_course_table extends Migration
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
        $this->createTable('{{%student_course}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(),
            'course_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);
        $this->addForeignKey('student12_fk', '{{%student_course}}', 'student_id', '{{%student_information}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('course_fk', '{{%student_course}}', 'course_id', '{{%course}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('student12_fk', '{{%student_course}}');
        $this->dropForeignKey('course_fk', '{{%student_course}}');
        $this->dropTable('{{%student_course}}');
    }
}
