<?php

namespace App\Models\Traits;

trait SearchTrait
{
    public function toSearch(array $query): array
    {
        $columns = \Schema::getColumnListing($this->getTable());
        $query = array_filter($query, static function ($value, $key) use ($columns) {
            if ($value === '' || $value === null) {
                return false;
            }

            if (is_array($value) || empty($value)) {
                return false;
            }

            if (! in_array(strtolower($key), $columns, true)) {
                return false;
            }

            return true;
        }, ARRAY_FILTER_USE_BOTH);

        return $query;
    }
}
