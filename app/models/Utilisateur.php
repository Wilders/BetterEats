<?php


namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model {
    public $timestamps = false;
    protected $table = "utilisateur";
    protected $primaryKey = "idt";
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mdp',
        'adresse',
        'statut'
    ];

    public function restaurant() {
        return $this->belongsTo('App\models\Restaurant', 'idt_proprietaire');
    }
}