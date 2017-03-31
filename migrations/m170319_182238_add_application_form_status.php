<?php

use yii\db\Migration;

class m170319_182238_add_application_form_status extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%student_information}}', 'application_form_status', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%student_information}}', 'application_form_status');        
    }
}
