<?php


namespace app\models;


use Illuminate\Database\Eloquent\Model;

class Commande extends Model {
    public $timestamps = true;
    protected $table = "commandes";
    protected $primaryKey = "idt";
    protected $fillable = [
        'idt_utilisateur',
        'idt_rest',
        'type',
        'proximite',
        'montant',
        'statut'
    ];
}