<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Repositories\Criteria\Criteria;

interface CriteriaInterface
{
    public function skipCriteria($status = true);

    public function getCriteria();

    public function getByCriteria(Criteria $criteria);

    public function pushCriteria(Criteria $criteria);

    public function applyCriteria();
}
