<?php

namespace App\Models;

use App\Traits\UseUlid;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory,UseUlid,Filterable;

    CONST STATUS_ZERO = "pending";
    CONST STATUS_ONE = "on-going";
    CONST STATUS_TWO = "suspended";
    CONST STATUS_THREE = "completed";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title','description','user_id',
        'cover_image_url','start_date','end_date',
        'goal'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function donationTransaction()
    {
        return $this->hasMany(DonationTransaction::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $baseSlug = \Str::slug($model->title);
            $model->slug = $model->generateUniqueSlug($baseSlug);
        });
    }

    public function generateUniqueSlug($baseSlug)
    {
        $slug = $baseSlug;
        while ($this->slugExists($slug)) {
            $randomString = \Str::random(3);
            $slug =  $randomString.'-'.$baseSlug;
        }

        return $slug;
    }

    public function slugExists($slug)
    {
        // Check if a record with the given slug already exists in the database
        return static::where('slug', $slug)->exists();
    }
}
