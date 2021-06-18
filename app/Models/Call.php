<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $all)
 * @method static find($id)
 */
class Call extends Model {
    use HasFactory;

    protected $table = 'call';
    public $timestamps = false;
    protected $fillable = ['idFriend', 'callDate'];

    public function call(): BelongsTo {
        return $this->belongsTo(__CLASS__, 'idFriend');
    }
}
