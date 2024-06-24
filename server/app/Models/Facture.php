<?php


// App\Models\Facture.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_facture', 'total_HT', 'total_TTC', 'TVA', 'facture_pdf', 'activite_id'
    ];

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }
}
