<?php

namespace App\Repositories;

use App\Models\Matching;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MatchingRepository
 * @package App\Repositories
 * @version December 30, 2018, 12:56 am UTC
 *
 * @method Matching findWithoutFail($id, $columns = ['*'])
 * @method Matching find($id, $columns = ['*'])
 * @method Matching first($columns = ['*'])
*/
class MatchingRepository extends BaseRepository
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
        return Matching::class;
    }
}
