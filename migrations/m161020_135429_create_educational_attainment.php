<?php

use yii\db\Migration;

class m161020_135429_create_educational_attainment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%educational_attainment}}', [
            'id' => $this->primaryKey(),
            "student_id" => $this->integer(),//owner of student id
            "education" => $this->string(),
            "name_of_school" => $this->string(),
            "address_of_school" => $this->string(),
            "inclusive_dates_of_attendance" => $this->string(),
        ], $tableOptions);
        $this->addForeignKey("student_educational_attainment_fk", "educational_attainment", "student_id", "student_information","id","CASCADE","CASCADE");
        
    }

    public function down()
    {
        $this->dropForeignKey("student_educational_attainment_fk", "educational_attainment");
        $this->dropTable('{{%educational_attainment}}');
    }

}
