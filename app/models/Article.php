<?php


namespace app\models;


class Article
{
    public $timestamps = false;
    protected $table = "articles";
    protected $primaryKey = "idt";
    protected $fillable = [
        'nom',
        'prix',
        'idt_restaurant'
    ];
}