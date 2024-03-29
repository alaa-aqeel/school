<?php 

namespace App\Interfaces;

interface BaseRepositoryInterface {


    /**
     * Pagination with filters 
     * 
     * @param int $prePage @default 10 
     * @param mixed $args  @default []
     * @param string $sortBy  @default 'id'
     * @param string $direction  @default 'desc'
     * @return \Illuminate\Database\Eloquent\Builder::paginate
     */
    public function paginate(mixed $args = [], string $sortBy = "id", string $direction = "desc", $perPage = 10);

    /**
     * Set model class 
     * 
     * @param string $model 
     * @return void 
     */
    public function setModel(string $model) : void;

    /**
     * Set name primary key 
     * 
     * @param string $namePrimaryKey
     * @return void 
     */
    public function setPrimaryKey(string $namePrimaryKey);


    /**
     * Filter recode 
     * 
     * @param mixed $args  @default []
     * @param string $sortBy  @default "id"
     * @param string $direction  @default "desc"
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter(mixed $args = [], string $sortBy = "id", string $direction = "desc");

    /**
     * Get all recodes 
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Get one recode by primary key 
     * 
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Model
     * @throws abort(404)
     */
    public function get(string|int $value);


    /**
     * Create new recode 
     * 
     * @param mixed $data 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(mixed $data);


    /**
     * Update recode by primary key 
     * 
     * @param string|int $primaryKey
     * @param mixed $data 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(string|int $primaryKey, mixed $data);


    /**
     * Delete recode by primary key 
     * 
     * @param string|int $primaryKey
     * @return bool|null
     */
    public function delete(string|int $primaryKey);
}