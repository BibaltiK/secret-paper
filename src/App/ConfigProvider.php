<?php declare(strict_types=1);

namespace App;

use App\Service;
use App\Validator\Input;
use Laminas\Config\Reader;
use Laminas\Config\Writer;
use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;
use Mezzio\Template\TemplateRendererInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            ConfigAbstractFactory::class => $this->getAbstractFactoryConfig(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Writer\Json::class,
                Reader\Json::class,

                Service\RandomStringService::class,

                Input\FileUploadInput::class,
            ],
            'factories' => [
                Handler\FakeHandler::class => ConfigAbstractFactory::class,
                Handler\FileUploadHandler::class => ConfigAbstractFactory::class,
                Handler\IndexHandler::class => ConfigAbstractFactory::class,
                Handler\SecretHandler::class => ConfigAbstractFactory::class,

                Middleware\FileUploadMiddleware::class => ConfigAbstractFactory::class,
                Middleware\FileUploadValidatorMiddleware::class => ConfigAbstractFactory::class,

                Service\DirectoryCreator::class => Service\DirectoryCreatorFactory::class,
                Service\FileUpload::class => ConfigAbstractFactory::class,
                Service\MetaReader::class => ConfigAbstractFactory::class,
                Service\MetaWriter::class => ConfigAbstractFactory::class,

                Validator\FileUploadValidator::class => ConfigAbstractFactory::class,
            ],
        ];
    }

    public function getAbstractFactoryConfig(): array
    {
        return [
            Handler\FakeHandler::class => [
                TemplateRendererInterface::class,
            ],
            Handler\FileUploadHandler::class => [
                TemplateRendererInterface::class,
            ],
            Handler\IndexHandler::class => [
                TemplateRendererInterface::class,
            ],
            Handler\SecretHandler::class => [
                TemplateRendererInterface::class,
            ],

            Middleware\FileUploadMiddleware::class => [
                Service\FileUpload::class,
            ],
            Middleware\FileUploadValidatorMiddleware::class => [
                Validator\FileUploadValidator::class,
            ],

            Service\FileUpload::class => [
                Service\DirectoryCreator::class,
                Service\RandomStringService::class,
            ],
            Service\MetaReader::class => [
                Reader\Json::class,
            ],
            Service\MetaWriter::class => [
                Writer\Json::class,
            ],

            Validator\FileUploadValidator::class => [
                Input\FileUploadInput::class,
            ],
        ];
    }
}
