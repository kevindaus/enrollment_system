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
            /*application information*/
            'college_admission_test_number' => $this->string(),//should be auto generated
            'official_receipt_number' => $this->string(),//should be auto generated
            'date_taken' => $this->dateTime(),//default to date today
            'application_status' => $this->string(),//[New Student , Old Student , Transferee]
            'is_first_time' => $this->string(),//[Yes, No]
            'is_first_time_location' => $this->string(),// [Bayombong , Bambang]
            /*personal information*/
            'title' => $this->string()->notNull(),
            'firstName' => $this->string()->notNull(),
            'middleName' => $this->string(),
            'lastName' => $this->string()->notNull(),
            /*contact information*/
            'phoneNumber' => $this->string(),
            'houseNumber' => $this->string(),

            /*permanent address*/
            'permanent_address_house_number' => $this->string(),
            'permanent_address_street' => $this->string(),
            'permanent_address_purok' => $this->string(),
            'permanent_address_barangay' => $this->string(),
            'permanent_address_town' => $this->string(),
            'permanent_address_province' => $this->string()->defaultValue('Nueva Vizcaya'),
            'permanent_address_postalCode' => $this->string(),
            /*residential address*/
            'residential_address_house_number' => $this->string(),
            'residential_address_street' => $this->string(),
            'residential_address_purok' => $this->string(),
            'residential_address_barangay' => $this->string(),
            'residential_address_town' => $this->string(),
            'residential_address_province' => $this->string()->defaultValue('Nueva Vizcaya'),
            'residential_address_postalCode' => $this->string(),
            /*other information*/
            'birthday' => $this->date(),
            'age' => $this->integer(),//age of the person when he/she enrolled
            'place_of_birth' => $this->string(),//
            'civil_status' => $this->string(),//[Single , Married]
            'gender' => $this->string(),//[Single , Married]
            'ethnic_origin' => $this->string(),//[Single , Married]
            'citizenship' => $this->string(),//[Single , Married]
            /**/
            'signature_image' => $this->string(),//signature image of student

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
