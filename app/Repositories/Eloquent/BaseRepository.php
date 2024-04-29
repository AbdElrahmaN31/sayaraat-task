<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\IBaseRepository;

abstract class BaseRepository implements IBaseRepository
{

    protected $model;

    protected $with = [];

    function __construct($model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->newQuery()->with($this->with)->get();
    }

    public function get($id, $fail = true)
    {
        if ($fail) {
            return $this->model->findOrFail($id);
        }
        return $this->model->find($id);
    }

    public function findOne($id, $fail = true)
    {
        if ($fail) {
            return $this->model->findOrFail($id);
        }
        return $this->model->find($id);
    }

    public function findOneWhere($where = [], $fail = false)
    {
        if ($fail) {
            return $this->model->where($where)->firstOrFail();
        }
        return $this->model->where($where)->first();
    }

    public function getWhere($where = [], $orderBy = ['column' => 'id', 'dir' => 'desc'])
    {
        return $this->model->where($where)->orderBy($orderBy['column'], $orderBy['dir'])->get();
    }

    public function getWhereWith($where = [], $with = [])
    {
        return $this->model->where($where)->with($with)->get();
    }

    public function getWhereFirst($where = [])
    {
        return $this->model->where($where)->first();
    }

    public function getWhereFirstWith($where = [], $with = [])
    {
        return $this->model->where($where)->with($with)->first();
    }


    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data, $attribute = "id")
    {
        return tap($this->model->find($id))->update($data)->refresh();
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    public function with($relations)
    {
        if (is_string($relations)) {
            $this->with = explode(',', $relations);

            return $this;
        }

        $this->with = is_array($relations) ? $relations : [];

        return $this;
    }

    public function getWherePaginate($where = [], $orderBy = ['column' => 'id', 'dir' => 'desc'], $perPage = 15)
    {
        return $this->model->where($where)->orderBy($orderBy['column'], $orderBy['dir'])->paginate($perPage);
    }

    public function selectQuery($data = '*')
    {
        return $this->model->select($data);
    }
}
