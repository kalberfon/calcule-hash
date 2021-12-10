<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Hash
 * @package App\Models
 */
class Hash extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        "batch",
        "block_number",
        "input",
        "output",
        "key",
        "tries",
    ];
    /**
     * @var array
     */
    protected $casts = [
        "batch" => 'datetime',
        "block_number" => "integer",
        "tries" => "integer",
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function previusBlock()
    {
        return $this->hasOne(self::class, "output", "input");
    }
}
