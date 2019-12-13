<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Repositories\Criteria\Criteria;

interface CriteriaInterface
{
    public function pushCriteria(Criteria $criteria);

    public function applyCriteria();
}
