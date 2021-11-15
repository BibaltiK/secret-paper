<?php declare(strict_types=1);

namespace App\Service;

use InvalidArgumentException;

use function bin2hex;
use function openssl_random_pseudo_bytes;

class RandomStringService
{
    public function generateRandomString(int $length=18): string
    {
        if (($length % 2) !== 0) {
            throw new InvalidArgumentException('generateRandomString: Length must correspond to a power of 2');
        }

        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}
