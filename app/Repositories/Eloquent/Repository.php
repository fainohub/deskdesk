<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Exceptions\RepositoryException;
use App\Repositories\Contracts\CriteriaInterface;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Criteria\Criteria;

abstract class Repository implements RepositoryInterface, CriteriaInterface
{
    protected $model;
    protected $criteria;

    public function __construct()
    {
        $this->criteria = null;
        $this->makeModel();
    }

    public abstract function model();

    public function all($columns = array('*'))
    {
        $this->applyCriteria();

        return $this->model->get($columns);
    }

    public function paginate($perPage = 25, $columns = array('*'))
    {
        $this->applyCriteria();

        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = array('*'))
    {
        $this->applyCriteria();

        return $this->model->find($id, $columns);
    }

    public function with(array $relations)
    {
        $this->model = $this->model->with($relations);

        return $this;
    }

    public function addCriteria(Criteria $criteria)
    {
        $this->criteria = $criteria;

        return $this;
    }

    public function applyCriteria()
    {
        if ($this->criteria instanceof Criteria) {
            $this->model = $this->criteria->apply($this->model, $this);
        }

        return $this;
    }

    private function makeModel()
    {
        $newModel = resolve($this->model());

        if (!$newModel instanceof Model) {
            throw new RepositoryException("Class {$newModel} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $newModel;
    }
}
