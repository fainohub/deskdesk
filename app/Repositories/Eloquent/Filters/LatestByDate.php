<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent\Filters;

use App\Repositories\Contracts\Criteria;
use App\Repositories\Contracts\RepositoryInterface;

class LatestByDate extends Criteria
{

    private $attribute;

    public function __construct(string $attribute = 'updated_at')
    {
        $this->attribute = $attribute;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->latest($this->attribute);

        return $model;
    }
}
