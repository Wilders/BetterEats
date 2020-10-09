<?php


namespace app\models;


use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model {
    public $timestamps = false;
    protected $table = "restaurants";
    protected $primaryKey = "idt";
    protected $fillable = [
        'nom',
        'adresse',
        'specialite',
        'gamme',
        'idt_proprietaire'
    ];

    public function proprietaire() {
        return $this->hasOne('App\models\Utilisateur', 'idt');
    }
}