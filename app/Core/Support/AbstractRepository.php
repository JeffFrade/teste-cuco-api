<?php

namespace App\Core\Support;

abstract class AbstractRepository
{
    protected $model;

    /**
     * Get all data from Model/Table
     *
     * @param array $cols
     * @return mixed
     * @author Jefferson Frade
     */
    public function all(array $cols = ['*'])
    {
        return $this->model->withTrashed()->get($cols);
    }

    /**
     * Get all data from Model/Table (No Trashed (With SoftDelete = null))
     *
     * @param array $cols
     * @return mixed
     * @author Jefferson Frade
     */
    public function allNoTrashed(array $cols = ['*'])
    {
        return $this->model->get($cols);
    }

    /**
     * Paginate data from Model/Table
     *
     * @param int $perPage
     * @param array $cols
     * @return mixed
     * @author Jefferson Frade
     */
    public function paginate(int $perPage = 15, array $cols = ['*'])
    {
        return $this->model->paginate($perPage, $cols);
    }

    /**
     * Search by id from Model/Table
     *
     * @param $value
     * @return mixed
     * @author Jefferson Frade
     */
    public function find($value)
    {
        return $this->model->where('id', $value)->get();
    }

    /**
     * Get first occurrence from Model/Table
     *
     * @param $field
     * @param $value
     * @return mixed
     * @author Jefferson Frade
     */
    public function findFirst($field, $value)
    {
        return $this->model->where($field, $value)->first();
    }

    /**
     * Custom search from Model/Table
     *
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     * @author Jefferson Frade
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, $value)->get($columns);
    }

    /**
     * Insert data from Table
     *
     * @param array $data
     * @return mixed
     * @author Jefferson Frade
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update data from Table with custom criteria
     *
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     * @author Jefferson Frade
     */
    public function updateCustom(array $data, $id, $attribute = 'id')
    {
        return $this->model->where($attribute, $id)->update($data);
    }

    /**
     * Update data from Table for ID
     *
     * @param array $data
     * @param $id
     * @return mixed
     * @author Jefferson Frade
     */
    public function update(array $data, $id)
    {
        $instance = $this->model->find($id);
        $instance->fill($data);

        return $instance->save();
    }

    /**
     * Delete data from table with custom criteria
     *
     * @param string $field
     * @param string $value
     * @return mixed
     * @author Jefferson Frade
     */
    public function customDelete(string $field, string $value)
    {
        return $this->model->where($field, $value)->delete();
    }

    /**
     * Delete data from table with ID
     *
     * @param $id
     * @return mixed
     * @author Jefferson Frade
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Retrieve deleted data (With Softdeletes) from Model/Table
     *
     * @param $value
     * @param string $field
     * @return mixed
     * @author Jefferson Frade
     */
    public function retrieveDelete($value, $field = 'id')
    {
        $instance = $this->model->onlyTrashed()
            ->where($field, $value)
            ->first();

        return $instance->restore();
    }
}
