<?php

use yii\db\Migration;
use yii\db\Schema;

class m170311_175866_alter_audit_data extends Migration
{
    const TABLE = '{{%audit_data}}';

    public function up()
    {
        $this->addColumn(self::TABLE, 'created', $this->dateTime()->notNull());
    }

}
