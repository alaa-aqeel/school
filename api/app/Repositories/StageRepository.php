<?php 

namespace App\Repositories;

use App\Interfaces\StageRepositoryInterface;
use App\Models\Stage;

class StageRepository extends BaseRepository implements StageRepositoryInterface 
{

    /**
     * @var \App\Models\Stage
     */
    protected $model = Stage::class;

}