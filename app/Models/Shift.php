<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Shift",
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
class Shift extends Model
{
    use SoftDeletes;

    public $table = 'shifts';

    protected $dates = ['deleted_at'];

    public $fillable = [
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
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function matching()
    {
        return $this->hasOne(\App\Models\Matching::class);
    }

    /**
     * This is an alias that we need to make it compatible with the
     * InfyOm\Generator\Common BaseRepository->updateRelations method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function matching_id()
    {
        return $this->matching();
    }
}
