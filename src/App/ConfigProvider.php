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

                Service\MetaHydrator::class,
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
                Middleware\MetaCreateMiddleware::class => ConfigAbstractFactory::class,
                Middleware\MetaReadMiddleware::class => ConfigAbstractFactory::class,
                Middleware\SecretLinkValidatorMiddleware::class => ConfigAbstractFactory::class,

                Service\DirectoryCreator::class => Service\DirectoryCreatorFactory::class,
                Service\FileUpload::class => ConfigAbstractFactory::class,
                Service\MetaReader::class => Service\MetaReaderFactory::class,
                Service\MetaWriter::class => Service\MetaWriterFactory::class,
                Service\SecretLinkService::class => Service\SecertLinkServiceFactory::class,

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
            Middleware\MetaCreateMiddleware::class => [
                Service\MetaHydrator::class,
                Service\MetaWriter::class,
            ],
            Middleware\MetaReadMiddleware::class => [
                Service\MetaHydrator::class,
                Service\MetaReader::class,
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
