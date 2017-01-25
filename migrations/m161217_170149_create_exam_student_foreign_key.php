<?php

use yii\db\Migration;

class m161217_170149_create_exam_student_foreign_key extends Migration
{
    public function up()
    {
        $this->addForeignKey('examination_log_fk', '{{%examination_log}}', 'student_id', '{{%student_information}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('examination_log_fk', '{{%examination_log}}');
    }

}