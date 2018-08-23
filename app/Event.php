<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'date',
        'description',
        'contact_email',
        'time',
        'location',
        'costs',
        'registration_required',
        'registration_email',
        'registration_tel',
        'registration_url',
        'contact_name',
        'contact_tel',
    ];

    public function beforeSave() {
        $this->edit_token = static::generateToken();
    }

    public static function generateToken(int $length = 20) {
		return bin2hex(random_bytes($length));
    }
}
