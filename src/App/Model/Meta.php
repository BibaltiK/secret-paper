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
    private string $path = '';

    public function getClientFilename(): string
    {
        return $this->clientFilename;
    }

    public function setClientFilename(string $clientFilename): self
    {
        $this->clientFilename = $clientFilename;

        return $this;
    }

    public function getServerFilename(): string
    {
        return $this->serverFilename;
    }

    public function setServerFilename(string $serverFilename): self
    {
        $this->serverFilename = $serverFilename;

        return $this;
    }

    public function getMediaType(): string
    {
        return $this->mediaType;
    }

    public function setMediaType(string $mediaType): self
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
}
