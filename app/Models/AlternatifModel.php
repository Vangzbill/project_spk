<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifModel extends Model
{
    use HasFactory;

    protected $table = 'alternatif';

    protected $fillable =[
        'kode',
        'nama'
    ];
    
    public function alternatifSkor()
    {
        return $this->hasMany(AlternatifdanSkorModel::class, 'alternatif_id');
    }
}
