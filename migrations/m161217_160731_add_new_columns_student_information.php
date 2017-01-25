<?php

use yii\db\Migration;

class m161217_160731_add_new_columns_student_information extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%student_information}}', 'student_picture', $this->string());
        $this->addColumn('{{%student_information}}', 'requirement_certificate', $this->string());
        $this->addColumn('{{%student_information}}', 'serial_number', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%student_information}}', 'student_picture');
        $this->dropColumn('{{%student_information}}', 'requirement_certificate');
        $this->dropColumn('{{%student_information}}', 'serial_number');
    }
}