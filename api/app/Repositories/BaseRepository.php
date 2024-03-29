<?php 

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface {

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
        $this->model = $model;
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
     * @param string $sortBy  @default 'id'
     * @param string $direction  @default 'desc'
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter(mixed $args = [], string $sortBy = "id", string $direction = "desc")
    {
        $filter = $this->model::orderBy($sortBy, $direction);

        if (isset($args[$this->primaryKey])) {

            $filter->where($this->primaryKey, $args[$this->primaryKey]);
        }

        return $filter;
    }

    /**
     * Pagination with filters 
     * 
     * @param mixed $args  @default []
     * @param string $sortBy  @default 'id'
     * @param string $direction  @default 'desc'
     * @param int $prePage @default 10 
     * @return \Illuminate\Database\Eloquent\Builder::paginate
     */
    public function paginate(mixed $args = [], string $sortBy = "id", string $direction = "desc", $perPage = 10)
    {   
        return $this
                ->filter($args, $sortBy, $direction)
                ->paginate($perPage);
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
     * Get recode by primary key 
     * 
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function get(string|int $value)
    {
        $recode = $this->filter([$this->primaryKey => $value])->first();
        
        return $recode ?? abort(response()->json([
            "messages" => "messages.notfound",
        ], 404));
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
        $user = $this->get($primaryKey);
        $user->update($data);
        return $user;
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