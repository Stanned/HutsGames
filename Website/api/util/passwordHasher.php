<?php

class passwordHasher
{
    // Function for generating without a salt
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}


