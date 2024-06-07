<?php

namespace App\Validation\Rules;

use App\Core\Container;
use Illuminate\Database\DatabaseManager;
use Respect\Validation\Rules\AbstractRule;

class ExistsInDatabase extends AbstractRule
{
    public function __construct(protected string $table, protected string $column) {}

    public function validate($input): bool
    {
        return Container::getInstance()->get(DatabaseManager::class)
            ->table($this->table)
            ->where($this->column, '=', $input)
            ->count() >= 1;
    }
}