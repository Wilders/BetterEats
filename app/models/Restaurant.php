<?php


namespace app\models;


class Restaurant
{
    public $timestamps = false;
    protected $table = "restaurants";
    protected $primaryKey = "idt";
    protected $fillable = [
        'nom',
        'adresse',
        'specialite',
        'gamme'
    ];
}