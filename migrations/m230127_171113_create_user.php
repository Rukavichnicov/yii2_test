<?php

use yii\db\Migration;

/**
 * Class m230127_171113_create_user
 */
class m230127_171113_create_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'surname' => $this->string(100),
            'password' => $this->string()->notNull(),
            'image' => $this->string(),
        ]);
//        $this->insertFakeUsers();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }

    private function insertFakeUsers()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 30; ++$i) {
            $this->insert(
                'user',
                [
                    'name' => $faker->name,
                    'surname' => $faker->lastName,
                    'password' => password_hash('password', PASSWORD_DEFAULT),
                    'image' => NULL,
                ]
            );
        }
    }
}
