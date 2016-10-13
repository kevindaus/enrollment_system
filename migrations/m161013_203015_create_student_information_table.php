<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student_information`.
 */
class m161013_203015_create_student_information_table extends Migration
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
        $this->createTable('{{%student_information}}', [
            'id' => $this->primaryKey(),
            'firstName' => $this->string()->notNull(),
            'middleName' => $this->string(),
            'lastName' => $this->string()->notNull(),
            'phoneNumber' => $this->string(),
            'houseNumber' => $this->string(),
            'street' => $this->string()->notNull(),
            'barangay' => $this->string()->notNull(),
            'postalCode' => $this->string(),
            'city' => $this->string(),
            'province' => $this->string()->defaultValue('Nueva Vizcaya'),
            'country' => $this->string()->defaultValue("Philippines"),
            'birthday' => $this->date(),
            'emailAddress' => $this->string(),
            'height' => $this->string(),
            'weight' => $this->string(),
            'bloodType' => $this->string(),
            'elementary_graduated' => $this->string(),
            'highschool_graduated' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('student_information');
    }
}
