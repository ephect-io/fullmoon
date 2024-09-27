<?php

namespace Ephect\Modules\Forms\Application;

use Ephect\Modules\Forms\Components\FileComponentInterface;
use Ephect\Modules\Forms\Registry\CodeRegistry;
use Ephect\Modules\Forms\Generators\ParserService;

class ApplicationRecursiveParser extends AbstractApplicationParser
{

    /**
     * @return void
     */
    public static function parse(FileComponentInterface $component): void
    {
        CodeRegistry::setCacheDirectory(CACHE_DIR . $component->getMotherUID());
        CodeRegistry::load();

        $parser = new ParserService();

        $parser->doChildSlots($component);
        $component->applyCode($parser->getHtml());
        self::updateComponent($component);

        while ($component->getDeclaration()->getComposition() !== null) {
            $parser->doOpenComponents($component);
            $component->applyCode($parser->getHtml());
            self::updateComponent($component);

            $parser->doClosedComponents($component);
            $component->applyCode($parser->getHtml());
            self::updateComponent($component);

            $parser->doIncludes($component);
            $component->applyCode($parser->getHtml());
        }

        CodeRegistry::save();
    }

}
