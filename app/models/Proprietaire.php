<?php


namespace app\models;


class Proprietaire
{
    public $timestamps = false;
    protected $table = "proprietaire";
    protected $primaryKey = "idt";
    protected $fillable = [
        'idt_utilisateur',
        'idt_restaurant'
    ];
}