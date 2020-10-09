<?php


namespace app\models;


class Utilisateur
{
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
}