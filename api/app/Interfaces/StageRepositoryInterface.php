<?php 

namespace App\Interfaces;

use App\Models\Stage;

interface StageRepositoryInterface extends BaseRepositoryInterface 
{

    /**
     * Syncing Associations
     * 
     * @param \App\Models\Stage $stage 
     * @param mixed $data 
     * @return void 
     */
    public function syncDivision(Stage $stage, mixed $data);

    
}