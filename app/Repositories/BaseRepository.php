<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Một lớp có thể kế thừa từ nhiều interface khác nhau bằng từ khóa implements
 */
abstract class BaseRepository implements RepositoryInterface
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

    public function _query()
    {
        return $this->_model;
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
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function insert(array $attributes)
    {
        return $this->_model->insert($attributes);
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

    public function query($options = [], $with = [], $order = [])
    {
        $query = $this->_model;
        if ($options) {
            foreach ($options as $key => $value) {
                if (is_array($value)) {
                    $query = $query->whereIn($key, $value);
                } else {
                    $query = $query->where($key, $value);
                }
            }
        }
        if($with) {
            $query = $query->with($with);
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

    public function queryOptions($options = [])
    {
        $query = $this->query();
        if (!empty($options['select'])) {
            $query = $query->select($options['select']);
        }

        if (!empty($options['options'])) {
            $query = $this->switchQuery($options['options'], $query);
        }

        if(!empty($options['with'])) {
            if(!empty($options['with']['relation'])) {
                $relation = $options['with']['relation'];
                $options = $options['with']['options'] ?? [];
                $query = $query->with([$relation => function ($query) use ($options) {
                    if(!empty($options)) {
                        $this->switchQuery($options, $query);
                    }
                }]);
            } else {
                $query = $query->with($options['with']);
            }
        }

        if(!empty($options['where-has'])) {
            if(!empty($options['where-has']['relation'])) {
                $relation = $options['where-has']['relation'];
                $options = $options['where-has']['options'] ?? [];
                $query = $query->whereHas($relation, function ($query) use ($options) {
                    if(!empty($options)) {
                        $this->switchQuery($options, $query);
                    }
                });
            } else {
                $query = $query->whereHas($options['where-has'], function ($query) {});
            }
        }

        return $query->orderBy($options['order_by'] ?? 'created_at', $options['sort'] ?? 'desc');
    }

    public function switchQuery($options, $query)
    {
        if (!empty($options)) {
            foreach ($options as $item) {
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
        return $query;
    }

    public function paginatedQuery($query, $page = 1, $limit = 15)
    {
        $page = (int)$page;
        $limit = (int)$limit;
        if ($page <= 0) {
            $page = 1;
        }
        if ($limit > 100) {
            $limit = 100;
        }

        $query->skip(($page - 1) * $limit);
        $query->take($limit);

        return $query->get();
    }

    public function paginate($options, $page = 1, $limit = 15, $with = [], $order = []): array
    {
        $query = $this->query($options, $with, $order);
        $res['total'] = $query->count();
        $res['data'] = $this->paginatedQuery($query, $page, $limit);

        return $res;
    }

    public function paginateOptions($options, $page = 1, $limit = 15): array
    {
        $query = $this->queryOptions($options);
        $res['total'] = $query->count();
        $res['data'] = $this->paginatedQuery($query, $page, $limit);

        return $res;
    }
}
