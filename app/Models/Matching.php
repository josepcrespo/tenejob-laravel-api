<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Matching",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Matching extends Model
{
    public $table = 'matchings';


    public $fillable = [
        'shift_id',
        'worker_id'
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'shift_id',
        'worker_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'shift_id'  => 'required|numeric|unique:matchings',
        'worker_id' => 'required|numeric',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function shift()
    {
        return $this->belongsTo(\App\Models\Shift::class);
    }

    /**
     * This is an alias that we need to make it compatible with the
     * InfyOm\Generator\Common BaseRepository->updateRelations method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function shift_id()
    {
        return $this->shift();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function worker()
    {
        return $this->belongsTo(\App\Models\Worker::class);
    }

    /**
     * This is an alias that we need to make it compatible with the
     * InfyOm\Generator\Common BaseRepository->updateRelations method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function worker_id()
    {
        return $this->worker();
    }
}
