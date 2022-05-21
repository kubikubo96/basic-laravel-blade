<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Một lớp có thể kế thừa từ nhiều interface khác nhau bằng từ khóa implements
 */
abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get all
     */
    public function getAll()
    {
        return $this->_model->all();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->_model->find($id);
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }

    public function queryNor($conds = [], $order = [])
    {
        $query = $this->_model;
        if ($conds) {
            foreach ($conds as $key => $value) {
                if (is_array($value)) {
                    $query = $query->whereIn($key, $value);
                } else {
                    $query = $query->where($key, $value);
                }
            }
        }
        if ($order) {
            foreach ($order as $key => $value) {
                $query = $query->orderBy($key, $value);
            }
        } else {
            $query = $query->orderBy('created_at', 'desc');
        }
        return $query;
    }

    public function queryAdv($conds = [], $query = null)
    {
        if (is_null($query)) {
            $query = $this->_model;
        }
        if (!empty($conds['select'])) {
            $query = $query->select($conds['select']);
        }
        if (!empty($conds['data'])) {
            foreach ($conds['data'] as $item) {
                $opera = $item['opera'] ?? '=';
                switch ($opera) {
                    case 'like':
                        $query = $query->where($item['key'], 'like', '%' . $item['value'] . '%');
                        break;
                    case 'in':
                        $query = $query->whereIn($item['key'], $item['value']);
                        break;
                    case 'null':
                        $query = $query->whereNull($item['key']);
                        break;
                    case 'notNull':
                        $query = $query->whereNotNull($item['key']);
                        break;
                    case 'between':
                        $query = $query->whereBetween($item['key'], $item['value']);
                        break;
                    default:
                        $query = $query->where($item['key'], $opera, $item['value']);
                }
            }
        }

        if (!empty($conds['order'])) {
            foreach ($conds['order'] as $key => $value) {
                $query = $query->orderBy($key, $value);
            }
        } else {
            $query = $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

    public function paginateQuery($query, $limit = 5)
    {
        return $query->paginate($limit);
    }
}
