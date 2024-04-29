<?php

namespace App\Repositories\Interfaces;

interface IBaseRepository
{
    public function selectQuery($data = '*');

    public function getAll();

    public function get($id, $fail = true);

    public function findOne($id, $fail = true);

    public function findOneWhere($where = [], $fail = false);

    public function getWhere($where = [], $orderBy = ['column' => 'id', 'dir' => 'desc']);

    public function getWhereWith($where = [], $with = []);

    public function getWhereFirst($where = []);

    public function getWhereFirstWith($where = [], $with = []);

    public function getWherePaginate($where = [], $orderBy = ['column' => 'id', 'dir' => 'desc'], $perPage = 15);

    public function create(array $data);

    public function update($id, array $data, $attribute = "id");

    public function delete($id);

    public function paginate($perPage = 15, $columns = array('*'));

    public function with($relations);
}
