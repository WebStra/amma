<?php
namespace App;

use Keyhunter\Administrator\Repository;

class RecoverPassword extends Repository
{

    /**
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * @var array
     */
    protected $fillable = ['email', 'token'];

    /**
     * @var bool
     */
    public $timestamps = false;
}