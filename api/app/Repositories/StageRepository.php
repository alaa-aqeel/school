<?php 

namespace App\Repositories;

use App\Interfaces\StageRepositoryInterface;
use App\Models\Stage;

class StageRepository extends BaseRepository implements StageRepositoryInterface 
{

    /**
     * 
     * @var \App\Models\Stage
     */
    protected $model = Stage::class;

    /**
     * 
     * @var string 
     */
    protected string $primaryKey = 'id';


    /**
     * Syncing Associations
     * 
     * @param Stage $stage 
     * @param mixed $data 
     * @return void 
     */
    public function syncDivision(Stage $stage, mixed $data)
    {
        $stage->divisions()->sync($data['divisions'] ?? []);
        $stage->refresh();
    }


    public function create(mixed $data) 
    {   
        $stage = parent::create($data);
        $this->syncDivision($stage, $data);

        return $stage;
    }


    public function update(string|int $primaryKey, mixed $data)
    {
        $stage = parent::update($primaryKey, $data);
        $this->syncDivision($stage, $data);

        return $stage;
    }
}