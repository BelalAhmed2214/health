<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'national_id',
        'mobile',
        'date_of_birth',
        'marital_status',
        'children_count',
        'governorate',
        'address',
        'problem',
        'solution',
        'notes',
        'visit_date',
        'is_completed',
        'user_id',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'visit_date'   => 'datetime',
        'notes'        => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function egyptianGovernorates()
    {
        return [
            'Cairo'          => 'القاهرة',
            'Giza'           => 'الجيزة',
            'Alexandria'     => 'الإسكندرية',
            'Dakahlia'       => 'الدقهلية',
            'Red Sea'        => 'البحر الأحمر',
            'Beheira'        => 'البحيرة',
            'Faiyum'         => 'الفيوم',
            'Gharbia'        => 'الغربية',
            'Ismailia'       => 'الإسماعيلية',
            'Monufia'        => 'المنوفية',
            'Minya'          => 'المنيا',
            'Qalyubia'       => 'القليوبية',
            'New Valley'     => 'الوادي الجديد',
            'Suez'           => 'السويس',
            'Aswan'          => 'أسوان',
            'Asyut'          => 'أسيوط',
            'Beni Suef'      => 'بني سويف',
            'Port Said'      => 'بورسعيد',
            'Damietta'       => 'دمياط',
            'South Sinai'    => 'جنوب سيناء',
            'North Sinai'    => 'شمال سيناء',
            'Sharqia'        => 'الشرقية',
            'Kafr El Sheikh' => 'كفر الشيخ',
            'Qena'           => 'قنا',
            'Luxor'          => 'الأقصر',
            'Sohag'          => 'سوهاج',
            'Matrouh'        => 'مطروح'
        ];
    }
}
