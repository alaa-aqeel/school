<?php 

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface 
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = User::class;

    /**
     * @var string 
     */
    protected string $primaryKey = 'id';


    

}