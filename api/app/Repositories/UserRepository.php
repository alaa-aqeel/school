<?php 

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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


    private function hashPassword(mixed &$data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data["password"]);
        } else {
            
            // if is_null(password) 
            unset($data['password']);
        }
    }


    public function create(mixed $data) 
    {
        $this->hashPassword($data);

        return parent::create($data);
    }


    public function update(string|int $primaryKey, mixed $data)
    {
        $this->hashPassword($data);

        return parent::update($primaryKey, $data);
    }
}