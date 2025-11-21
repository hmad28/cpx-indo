<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappNumber extends Model
{
    use HasFactory;

    protected $table = 'whatsapp_numbers';

    protected $fillable = [
        'page_name',
        'position',
        'phone_number',
        'display_name',
        'message',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getFormattedPhoneAttribute()
    {
        $phone = preg_replace('/[^0-9]/', '', $this->phone_number);

        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
    }

    public function getWhatsappUrlAttribute()
    {
        $message = $this->message ? urlencode($this->message) : '';
        return "https://wa.me/{$this->formatted_phone}?text={$message}";
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function getActiveByPageAndPosition(string $pageName, string $position)
    {
        return self::where('page_name', $pageName)
            ->where('position', $position)
            ->where('is_active', true)
            ->get();
    }
}
