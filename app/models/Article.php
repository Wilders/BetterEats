<?php


namespace app\models;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
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