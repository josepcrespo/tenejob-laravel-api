<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Worker",
 *      required={"payrate"},
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
 *      ),
 *      @SWG\Property(
 *          property="payrate",
 *          description="payrate",
 *          type="number",
 *          format="float"
 *      )
 * )
 */
class Worker extends Model
{
    use SoftDeletes;

    public $table = 'workers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'payrate',
        'days'
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'payrate' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'payrate' => 'required|numeric',
        'day_ids' => 'required|array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function days()
    {
        return $this->belongsToMany(\App\Models\Day::class)
            ->withTimestamps();
    }

    /**
     * This is an alias that we need to make it compatible with the
     * InfyOm\Generator\Common BaseRepository->updateRelations method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function day_ids()
    {
        return $this->days();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function matchings()
    {
        return $this->hasMany(\App\Models\Matching::class)
            ->withTimestamps();
    }

    /**
     * This is an alias that we need to make it compatible with the
     * InfyOm\Generator\Common BaseRepository->updateRelations method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function matching_ids()
    {
        return $this->matchings();
    }
}
