<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriadanBobotModel extends Model
{
    use HasFactory;

    protected $table = 'kriteria_dan_bobot';

    protected $fillable = [
        'kode',
        'nama',
        'tipe',
        'bobot'
    ];

    protected $casts = [
        'bobot' => 'float'
    ];

    public function alternatifSkor()
    {
        return $this->hasMany(AlternatifdanSkorModel::class, 'kriteria_id');
    }
}
