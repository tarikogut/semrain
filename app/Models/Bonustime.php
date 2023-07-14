<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bonustime extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'bonustimes';

    protected $dates = [
        'bonustarihi',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bonusadi',
        'bonustarihi',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function bonusadiBonuseklemes()
    {
        return $this->belongsToMany(Bonusekleme::class);
    }

    public function getBonustarihiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBonustarihiAttribute($value)
    {
        $this->attributes['bonustarihi'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
