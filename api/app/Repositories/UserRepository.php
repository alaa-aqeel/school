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
        $filter = parent::filter($args, $sortBy, $direction);

        if ( isset($args['search']) ) {
            
            $filter
                ->where("name", "LIKE", "%{$args['search']}%")
                ->where("email", "LIKE", "%{$args['search']}%");
        }

        return $filter;
    }
}