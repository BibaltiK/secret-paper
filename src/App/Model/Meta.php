<?php declare(strict_types=1);

namespace App\Model;

class Meta
{
    public const TYPE_PLAIN = 'txt';
    public const TYPE_PDF = 'application/pdf';

    private string $clientFilename = '';
    private string $serverFilename = '';
    private string $mediaType = '';
    private string $password = '';
}
