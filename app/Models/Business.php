<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'category',
        'location',
        'rating',
        'reviews',
        'phone',
        'website',
        'hours',
        'description',
        'image',
        'featured',
         'email',
        'user_id',
        'featured_image',
        'additional_images',
        'twitter',
        'linkedin',
        'instagram',
        'facebook'
    ];
    public function membershipUser()
    {
        return $this->belongsTo(MembershipUser::class, 'user_id');
    }
}
