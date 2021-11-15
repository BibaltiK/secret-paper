<?php declare(strict_types=1);

namespace App\Model;

class Meta
{
    public const TYPE_PLAIN = 'txt';
    public const MEDIATYPE_PDF = 'application/pdf';

    private ?string $filename;
    private string $encryptedName;
    private string $mediaType;
    private string $password;
}
