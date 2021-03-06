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

                Handler\PdfHandler::class,

                Service\MetaModelHydrator::class,
                Service\RandomStringService::class,

                Input\FileUploadInput::class,

            ],
            'factories' => [
                Handler\FakeHandler::class => ConfigAbstractFactory::class,
                Handler\FileUploadHandler::class => ConfigAbstractFactory::class,
                Handler\IndexHandler::class => ConfigAbstractFactory::class,
                Handler\SecretLinkHandler::class => ConfigAbstractFactory::class,

                Middleware\FileUploadMiddleware::class => ConfigAbstractFactory::class,
                Middleware\FileUploadValidatorMiddleware::class => ConfigAbstractFactory::class,
                Middleware\MetaFileCreateMiddleware::class => ConfigAbstractFactory::class,
                Middleware\MetaFileReadMiddleware::class => ConfigAbstractFactory::class,
                Middleware\SecretLinkValidatorMiddleware::class => ConfigAbstractFactory::class,

                Service\DirectoryCreator::class => Service\DirectoryCreatorFactory::class,
                Service\FileUpload::class => ConfigAbstractFactory::class,
                Service\MetaFileReader::class => Service\MetaFileReaderFactory::class,
                Service\MetaFileWriter::class => Service\MetaFileWriterFactory::class,
                Service\SecretLinkService::class => Service\SecretLinkServiceFactory::class,

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
            Handler\SecretLinkHandler::class => [
                TemplateRendererInterface::class,
            ],

            Middleware\FileUploadMiddleware::class => [
                Service\FileUpload::class,
            ],
            Middleware\FileUploadValidatorMiddleware::class => [
                Validator\FileUploadValidator::class,
            ],
            Middleware\MetaFileCreateMiddleware::class => [
                Service\MetaModelHydrator::class,
                Service\MetaFileWriter::class,
            ],
            Middleware\MetaFileReadMiddleware::class => [
                Service\MetaModelHydrator::class,
                Service\MetaFileReader::class,
            ],
            Middleware\SecretLinkValidatorMiddleware::class => [
                Service\SecretLinkService::class,
            ],

            Service\FileUpload::class => [
                Service\DirectoryCreator::class,
                Service\RandomStringService::class,
            ],

            Validator\FileUploadValidator::class => [
                Input\FileUploadInput::class,
            ],
        ];
    }
}
