<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifdanSkorModel extends Model
{
    use HasFactory;

    protected $table = 'alternatif_dan_skor';

    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'skor',
    ];

    public function kriteria()
    {
        return $this->belongsTo(KriteriadanBobotModel::class, 'kriteria_id');
    }

    public function alternatif()
    {
        return $this->belongsTo(AlternatifModel::class, 'alternatif_id', 'id');
    }
}
