<?php

use yii\db\Migration;

class m161020_154846_create_student_educational_attainment_awards extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        
        }
        $this->createTable('{{%student_educational_attainment_awards}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(),
            'educational_attainment_id' => $this->integer(),
            'awards_received_id' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('student_id_1dasdasfk', '{{%student_educational_attainment_awards}}', 'student_id', '{{%student_information}}', 'id');
        $this->addForeignKey('educational_attainment_id_fk', '{{%student_educational_attainment_awards}}', 'educational_attainment_id', '{{%educational_attainment}}', 'id');
        $this->addForeignKey('awards_received_id_fk', '{{%student_educational_attainment_awards}}', 'awards_received_id', '{{%awards_received}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('student_id_fk', '{{%student_educational_attainment_awards}}');
        $this->dropForeignKey('educational_attainment_id_fk', '{{%student_educational_attainment_awards}}');
        $this->dropForeignKey('awards_received_id_fk', '{{%student_educational_attainment_awards}}');
    }
}
