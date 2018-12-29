<?php

namespace App\Repositories;

use App\Models\Worker;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class WorkerRepository
 * @package App\Repositories
 * @version December 28, 2018, 5:01 pm UTC
 *
 * @method Worker findWithoutFail($id, $columns = ['*'])
 * @method Worker find($id, $columns = ['*'])
 * @method Worker first($columns = ['*'])
*/
class WorkerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Worker::class;
    }
}
