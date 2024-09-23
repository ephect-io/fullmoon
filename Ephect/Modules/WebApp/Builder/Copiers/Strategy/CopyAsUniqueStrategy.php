<?php

namespace Ephect\Modules\WebApp\Builder\Copiers\Strategy;

use Ephect\Framework\ElementUtils;
use Ephect\Framework\Utils\File;
use Ephect\Modules\Forms\Components\Component;

class CopyAsUniqueStrategy implements CopierStrategyInterface
{
    private string $uniqueDomain = '';
    public function __construct()
    {
        $this->uniqueDomain = "Unique" . uniqid();
        File::safeMkDir(UNIQUE_DIR);
    }

    public function copy(string $path, string $key, string $filename): void
    {
        $root = pathinfo($path, PATHINFO_FILENAME) . DIRECTORY_SEPARATOR;

        if ($root === APP_DIR) {
            $root = DIRECTORY_SEPARATOR;
        }

        $dirname = pathinfo($filename, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR;
        $basename = pathinfo($filename, PATHINFO_BASENAME);
        File::safeMkDir(UNIQUE_DIR . $root . $dirname);
        $contents = file_get_contents($path . $dirname . $basename);

        [
            $namespace,
            $functionName,
            $parameters,
            $returnedType,
            $startsAt
        ] = ElementUtils::getFunctionDefinition($contents);

        if ($startsAt == -1) {
            $comp = Component::createByHtml($contents);
            $comp->makeComponent($filename, $contents);
        }

        $contents = str_replace('namespace '. CONFIG_NAMESPACE, 'namespace ' .  $this->uniqueDomain, $contents);
        $contents = preg_replace('/^use ' . CONFIG_NAMESPACE . '/m', 'use ' .  $this->uniqueDomain, $contents);
        $contents = preg_replace('/^use function ' . CONFIG_NAMESPACE . '/m', 'use function ' .  $this->uniqueDomain, $contents);

        File::safeWrite(UNIQUE_DIR . $root . $dirname . $basename, $contents);
    }
}
