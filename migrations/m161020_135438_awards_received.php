<?php

use yii\db\Migration;

class m161020_135438_awards_received extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%awards_received}}', [
            'id' => $this->primaryKey(),
            'education_attainment_id' => $this->integer(),
            "awards_name" => $this->string(),
        ], $tableOptions);
        $this->addForeignKey("education_attainment_id_fk", "awards_received", "education_attainment_id", "educational_attainment", "id","CASCADE","CASCADE");
    }

    public function down()
    {
        $this->dropForeignKey("education_attainment_id_fk", "awards_received");
        $this->dropTable('{{%awards_received}}');
    }

}
