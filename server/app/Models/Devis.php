<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_devis', 'Total_HT', 'Total_TTC', 'TVA', 'devis_pdf', 'activite_id'
    ];

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }
}
