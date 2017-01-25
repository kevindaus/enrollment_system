<?php

use yii\db\Migration;

class m170121_194007_add_course_new_cols extends Migration
{


    public function safeUp()
    {
        // $this->addColumn('{{%course}}', 'id', $this->primaryKey());
        $this->addColumn('{{%course}}', 'course_description', $this->string());
        $this->addColumn('{{%course}}', 'course_unit', $this->string());
    }

    public function safeDown()
    {
        // $this->dropColumn('{{%course}}', 'id');
        $this->dropColumn('{{%course}}', 'course_description');
        $this->dropColumn('{{%course}}', 'course_unit');
    }
}
