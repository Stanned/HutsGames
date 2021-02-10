<?php

class passwordHasher
{
    // Function for generating without a salt
    public function hashPassword(string $password): array
    {
        $salt = $this->generateRandomString();
        $saltedPass = $password . $salt;
        return array(password_hash($saltedPass, PASSWORD_DEFAULT), $salt);
    }

    private function generateRandomString(): string
    {
        $length = 16;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Function for generating hash with a known salt
    public function hashPasswordWithSalt(string $password, string $salt): string
    {
        $saltedPass = $password . $salt;
        return password_hash($saltedPass, PASSWORD_DEFAULT);
    }
}


