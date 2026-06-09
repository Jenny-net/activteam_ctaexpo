<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get's a item by it's ID
     *
     * @param int
     * @return Collection
     */
    public function show($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a item.
     *
     * @param array $data
     * @return Collection
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Get's all items.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Deletes a item.
     *
     * @param int
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Deletes all item.
     *
     * @param string $attribute
     * @param string $value
     * @return mixed
     */
    public function deleteAll($attribute, $value)
    {
        return $this->model->where($attribute, $value)->delete();
    }

    /**
     * Updates a item.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data)
    {
        $this->model->find($id)->update($data);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    /**
     * @param $whereArray array
     * @param array $columns
     * @return mixed
     */
    public function findBy($whereArray = [], $columns = array('*'))
    {
        return $this->model->select($columns)->where(
            !is_array($whereArray[0]) ? [$whereArray] : $whereArray
        )->get();
    }

    /**
     * @param $firstAttribute
     * @param $secondAttribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findByOr($firstAttribute,$secondAttribute, $value, $columns = array('*'))
    {
        return $this->model->select($columns)->where($firstAttribute,$value)->orWhere($secondAttribute, $value)->get();
    }
}
