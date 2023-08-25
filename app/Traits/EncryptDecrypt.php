<?php

namespace App\Traits;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

trait EncryptDecrypt
{
    public function encryptId(string $id): string
    {
        return Crypt::encryptString($id);
    }

    public function decryptId(string $id): string
    {
        try {
            return Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return 'Decryption failed'.$e;
        }
    }
}
