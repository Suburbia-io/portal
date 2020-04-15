<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dataset extends Model
{

    use SoftDeletes;
    protected $fillable = ['name'];

    /**
     * the users that have access to this dataset
     * @return BelongsToMany
     */
    public function users() :BelongsToMany {
        return $this->belongsToMany(User::class, 'user_datasets', 'dataset_id', 'user_id');
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->attributes['name'] = $name;
    }

    /**
     * @return string
     */
    public function getName() :string {
        return $this->attributes['name'];
    }

}
