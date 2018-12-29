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
        'payrate'
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
        'payrate' => 'required|numeric'
    ];

    /**
     * Return the "payrate" with two decimals.
     *
     * @param  string  $value
     * @return string
     */
    public function setPayrateAttribute($value)
    {
        return ($value);
    }

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
}
