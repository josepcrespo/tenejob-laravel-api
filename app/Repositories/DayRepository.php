<?php

namespace App\Repositories;

use App\Models\Day;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DayRepository
 * @package App\Repositories
 * @version December 28, 2018, 4:59 pm UTC
 *
 * @method Day findWithoutFail($id, $columns = ['*'])
 * @method Day find($id, $columns = ['*'])
 * @method Day first($columns = ['*'])
*/
class DayRepository extends BaseRepository
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
        return Day::class;
    }
}
