<?php


namespace app\models;


class Commande
{
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