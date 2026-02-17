<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhiteLabelSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'primary_color',
        'secondary_color',
        'contact_email',
        'contact_phone',
        'footer_text',
    ];

    public static function getSettings()
    {
        return self::first() ?? new self([
            'site_name' => 'E-Commerce Store',
            'primary_color' => '#007bff',
            'secondary_color' => '#6c757d',
        ]);
    }
}
