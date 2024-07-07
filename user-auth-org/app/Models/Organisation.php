<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organisation extends Model
{
    use HasFactory;

    protected $primaryKey = 'orgId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'orgId', 'name', 'description'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'organisation_user', 'organisation_id', 'user_id');
    }
}
