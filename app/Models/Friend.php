<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

/**
 * @method static create(array $all)
 * @method static find($id)
 */
class Friend extends Model {
    use HasFactory;

    protected $table = 'friend';
    public $timestamps = false;
    protected $fillable = ['name', 'phNumber', 'dateOfBirth'];

    public function friend(): HasMany {
        return $this->hasMany(__CLASS__, 'friend');
    }
}
