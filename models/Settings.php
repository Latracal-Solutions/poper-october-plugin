<?php namespace Poper\Poper\Models;

use Model;

class Settings extends Model
{
    // Specify the database table used by the model
    public $table = 'poper_settings';

    // Specify which attributes can be mass-assigned
    protected $fillable = ['account_id'];
}
