<?php

class Purchase
{
    public $id;
    public $token;

    public function __construct($id, $token)
    {
        $this->id = $id;
        $this->token = $token;
    }
}