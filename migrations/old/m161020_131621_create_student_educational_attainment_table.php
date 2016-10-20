<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student_educational_attainment`.
 */
class m161020_131621_create_student_educational_attainment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('student_educational_attainment', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('student_educational_attainment');
    }
}
