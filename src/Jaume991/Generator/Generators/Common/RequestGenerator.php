<?php

namespace Jaume991\Generator\Generators\Common;

use Config;
use Jaume991\Generator\CommandData;
use Jaume991\Generator\Generators\GeneratorProvider;
use Jaume991\Generator\Utils\GeneratorUtils;

class RequestGenerator implements GeneratorProvider
{
    /** @var  CommandData */
    private $commandData;

    /** @var string */
    private $path;

    public function __construct($commandData)
    {
        $this->commandData = $commandData;
        $this->path = Config::get('generator.path_request', app_path('Http/Requests/'));
    }

    public function generate()
    {
        $this->generateCreateRequest();
        $this->generateUpdateRequest();
    }

    private function generateCreateRequest()
    {
        $templateData = $this->commandData->templatesHelper->getTemplate('CreateRequest', 'scaffold/requests');

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);

        $fileName = 'Create'.$this->commandData->modelName.'Request.php';

        $path = $this->path.$fileName;

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->comment("\nCreate Request created: ");
        $this->commandData->commandObj->info($fileName);
    }

    private function generateUpdateRequest()
    {
        $templateData = $this->commandData->templatesHelper->getTemplate('UpdateRequest', 'scaffold/requests');

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);

        $fileName = 'Update'.$this->commandData->modelName.'Request.php';

        $path = $this->path.$fileName;

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->comment("\nUpdate Request created: ");
        $this->commandData->commandObj->info($fileName);
    }
}
