<?php

namespace App\Repositories;

use App\Models\Shift;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ShiftRepository
 * @package App\Repositories
 * @version December 28, 2018, 5:00 pm UTC
 *
 * @method Shift findWithoutFail($id, $columns = ['*'])
 * @method Shift find($id, $columns = ['*'])
 * @method Shift first($columns = ['*'])
*/
class ShiftRepository extends BaseRepository
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
        return Shift::class;
    }
}
