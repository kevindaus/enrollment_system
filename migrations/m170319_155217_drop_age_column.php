<?php

use yii\db\Migration;

class m170319_155217_drop_age_column extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%student_information}}', 'age');
    }

    public function safeDown()
    {
        $this->addColumn('{{%student_information}}', 'age', $this->integer());
    }
}
