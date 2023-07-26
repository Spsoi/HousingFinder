<?php

namespace App\Database;

abstract class Migration
{
    protected $schema;
    protected $tableName;

    public function getTableName()
    {
        return $this->tableName;
    }

    abstract public function up();

    abstract public function down();
}