<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class JobApplication extends Model
{
    use HasFactory,  HasApiTokens;


    protected $fillable = [
        'user_id',
        'job_offer_id',
        'message',
        'status',
    ];

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
