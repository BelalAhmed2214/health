<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'national_id',
        'mobile',
        'date_of_birth',
        'marital_status',
        'children_count',
        'governorate',
        'address',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function visits()
    {
        return $this->hasMany(Visit::class);
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
