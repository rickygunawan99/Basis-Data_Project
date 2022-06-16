<?php


namespace PHP\MVC\Model;


class UpdatePasswordRequest
{
    public string $oldpass;
    public string $newpass;
    public string $confpass;
}