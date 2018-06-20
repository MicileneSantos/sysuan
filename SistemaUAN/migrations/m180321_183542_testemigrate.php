<?php

use yii\db\Migration;

/**
 * Class m180321_183542_testemigrate
 */
class m180321_183542_testemigrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180321_183542_testemigrate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180321_183542_testemigrate cannot be reverted.\n";

        return false;
    }
    */
}
