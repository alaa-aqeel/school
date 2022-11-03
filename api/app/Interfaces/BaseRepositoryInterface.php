<?php 

namespace App\Interfaces;

interface BaseRepositoryInterface {

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
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter(mixed $args = []);

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