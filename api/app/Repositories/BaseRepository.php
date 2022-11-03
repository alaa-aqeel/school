<?php 

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface {

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var string 
     */
    protected string $primaryKey = 'id';

    /**
     * Set model class 
     * 
     * @param string $model 
     * @return void 
     */
    public function setModel(string $model) : void
    {
        $this->$model = $model;
    }

    /**
     * Set name primary key 
     * 
     * @param string $namePrimaryKey
     * @return void 
     */
    public function setPrimaryKey(string $namePrimaryKey)
    {
        $this->primaryKey = $namePrimaryKey;
    }


    /**
     * Filter recode 
     * 
     * @param mixed $args  @default []
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter(mixed $args = [])
    {
        $filter = $this->model::orderBy();

        if (isset($args[$this->primaryKey])) {

            $filter->where($this->primaryKey, $args['primaryKey']);
        }

        return $filter;
    }

    /**
     * Get all recodes 
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {

        return $this->model::all();
    }

    /**
     * Get one recode by primary key 
     * 
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function get(string|int $value)
    {
        $recode = $this->filter([$this->primaryKey => $value])->first();
        
        return $recode ?? abort(404);
    }


    /**
     * Create new recode 
     * 
     * @param mixed $data 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(mixed $data)
    {
        return $this->model::create($data);
    }


    /**
     * Update recode by primary key 
     * 
     * @param string|int $primaryKey
     * @param mixed $data 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(string|int $primaryKey, mixed $data)
    {
        return $this->get($primaryKey)->update($data);
    }


    /**
     * Delete recode by primary key 
     * 
     * @param string|int $primaryKey
     * @return bool|null
     */
    public function delete(string|int $primaryKey)
    {
        return $this->get($primaryKey)->delete();
    }

}