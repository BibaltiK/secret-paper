<?php declare(strict_types=1);

namespace App\Validator;

use App\Validator\Input\FileUploadInput;
use Laminas\InputFilter\InputFilter;

class FileUploadValidator extends InputFilter
{
    public const FILE_UPLOAD_VALIDATOR_MESSAGE = 'fileUploadValidatorMessage';

    public function __construct(
        private FileUploadInput $fileInput,
    ) {
        $this->add($this->fileInput);
    }

}
