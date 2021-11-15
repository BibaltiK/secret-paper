<?php declare(strict_types=1);

namespace App\Validator\Input;

use Laminas\InputFilter\FileInput;
use Laminas\Validator\File\MimeType;
use Laminas\Validator\File\Size;

class FileUploadInput extends FileInput
{
    public function __construct()
    {

        parent::__construct('uploadFile');

        $this->setRequired(true);

        $this->getValidatorChain()->attach(
            new MimeType(
                [
                    'mimeType' => ['application/pdf'],
                ]
            )
        );

        $this->getValidatorChain()->attach(
            new Size(
                [
                    'max' => '5MB',
                ]
            )
        );
    }
}
