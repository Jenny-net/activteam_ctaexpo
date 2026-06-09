<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get's all items.
     *
     * @return mixed
     */
    public function all();

    /**
     * Create new item.
     *
     * @param array
     * @return mixed
     */
    public function create(array $data);

    /**
     * Deletes an item.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);

    /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function show($id);

    /**
     * Get's post by specific field
     * @param $whereArray array
     * @param array $columns
     */
    public function findBy($whereArray = [], $columns = array('*'));

    /**
     * Get data by or condition
     * @param $firstAttribute
     * @param $secondAttribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findByOr($firstAttribute,$secondAttribute, $value, $columns = array('*'));
}
