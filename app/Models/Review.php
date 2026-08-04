<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = [
    'booking_id',
    'user_id',
    'terapis_id',
    'rating',
    'komentar',
    'ramah',
    'rapi',
    'profesional',
    'bersih',
    'keterampilan'
];

    public function booking() { return $this->belongsTo(Booking::class); }
    public function user()    { return $this->belongsTo(User::class); }
    public function terapis() { return $this->belongsTo(Terapis::class); }
}
