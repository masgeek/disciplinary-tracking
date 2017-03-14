<?php

use yii\db\Migration;

/**
 * Handles the creation of table `UON_STUDENTS`.
 */
class m170310_193625_create_UON_STUDENTS_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        return true;
        $table_name = 'UON_STUDENTS';

        $faker = Faker\Factory::create();

        $this->createTable($table_name, [
            'REGISTRATION_NUMBER' => $this->string(15),
            'SURNAME' => $this->string(),
            'OTHER_NAMES' => $this->string(),
        ]);

        $this->addPrimaryKey('REGISTRATION_NUMBER_PK', $table_name, 'REGISTRATION_NUMBER');
        if (YII_DEBUG) {
            for ($x = 0; $x <= 20; $x++) {
                $this->insert($table_name, [
                    'REGISTRATION_NUMBER' => strtoupper($faker->randomLetter.$faker->randomNumber(1).'/'.$faker->year),
                    'SURNAME' => $faker->lastName,
                    'OTHER_NAMES' => $faker->firstName,
                ]);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        return true;
        $this->dropTable('UON_STUDENTS');
    }
}
