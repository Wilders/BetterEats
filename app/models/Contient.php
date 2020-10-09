<?php


namespace app\models;


use Illuminate\Database\Eloquent\Model;

class Contient extends Model
{
    public $timestamps = false;
    protected $table = "contients";
    protected $primaryKey = "idt_article,idt_Commande";
    protected $fillable = [

    ];
}