<?php

namespace Ephect\Modules\Forms\Components;

use Ephect\Framework\ElementTrait;
use Ephect\Framework\Entity\Entity;
use Ephect\Framework\Structure\StructureInterface;
use Ephect\Framework\Tree\TreeTrait;
use Ephect\Framework\Utils\File;
use Ephect\Modules\Forms\Registry\ComponentRegistry;

/**
 * Description of match
 *
 * @author david
 */
class ComponentEntity extends Entity implements ComponentEntityInterface
{
    use ElementTrait;
    use TreeTrait;

    protected int $parentId = 0;
    protected string $name = '';
    protected string $text = '';
    protected int $start = 0;
    protected int $end = 0;
    protected int $depth = 0;
    protected bool $isSibling = false;
    protected ?array $closer = null;
    protected mixed $contents = null;
    protected bool $hasCloser = false;
    protected bool $hasProperties = false;
    protected array $properties = [];
    protected string $method = '';
    protected string $compName = '';
    protected ?string $className = '';
    protected bool $isSingle = false;
    protected array $attributes = [];
    protected StructureInterface|null $struct;

    public function __construct(ComponentStructure|null $struct)
    {
        parent::__construct($struct);

        if ($struct === null) {
            return null;
        }
        $this->struct = $struct;

        $this->uid = $struct->uid;
        $this->motherUID = $struct->motherUID;
        $this->id = $struct->id;
        $this->className = $struct->class;
        $this->compName = $struct->component;
        $this->parentId = $struct->parentId;
        $this->text = $struct->text;
        $this->name = $struct->name;
        $this->method = $struct->method;
        $this->start = $struct->startsAt;
        $this->end = $struct->endsAt;
        $this->depth = $struct->depth;
        $this->hasProperties = count($struct->props) !== 0;
        $this->properties = $this->hasProperties ? $struct->props : [];
        $this->hasCloser = is_array($struct->closer);
        $this->closer = $this->hasCloser ? $struct->closer : null;
        $this->isSingle = $struct->isSingle;
        $this->attributes = $struct->attributes;

        $this->elementList = (false === $struct->node) ? [] : $struct->node;

        $this->bindNode();
    }

    public function bindNode(): void
    {
        if ($this->elementList === false || $this->elementList === null) {
            return;
        }

        $this->elementList = array_map(function ($child) {
            return new ComponentEntity(new ComponentStructure($child));
        }, $this->elementList);
    }

    public static function buildFromArray(?array $list): ?ComponentEntity
    {
        $result = null;

        if ($list === null) {
            return null;
        }

        $depthIds = static::listIdsByDepth($list);

        $c = count($list);

        for ($j = 0; $j < $c; $j++) {
            $i = $depthIds[$j];
            if ($list[$i]['parentId'] === -1) {
                continue;
            }
            $pId = $list[$i]['parentId'];

            if (!is_array($list[$pId]['node'])) {
                $list[$pId]['node'] = [];
            }
            $list[$pId]['node'][] = $list[$i];
            unset($list[$i]);
        }

        if (count($list) === 1) {
            $result = new ComponentEntity(new ComponentStructure($list[0]));
        } elseif (count($list) > 1) {
            $result = self::makeFragment();
            foreach ($list as $item) {
                $entity = new ComponentEntity(new ComponentStructure($item));
                $result->add($entity);
            }
        }

        return $result;
    }

    private static function listIdsByDepth(?array $list): ?array
    {
        if ($list === null) {
            return null;
        }

        $result = [];

        $depths = [];

        foreach ($list as $match) {
            $struct = new ComponentStructure($match);
            $depths[$struct->depth] = 1;
        }

        $maxDepth = count($depths);
        for ($i = $maxDepth; $i > -1; $i--) {
            foreach ($list as $match) {
                if ($match["depth"] == $i) {
                    $result[] = $match['id'];
                }
            }
        }

        return $result;
    }

    private static function makeFragment(): ComponentEntityInterface
    {
        $fragment = [
            "closer" => [
                "id" => 1,
                "parentId" => 0,
                "text" => "<\/>",
                "startsAt" => 0,
                "endsAt" => 0,
                "contents" => [
                    "startsAt" => 0,
                    "endsAt" => 0
                ]
            ],
            "uid" => "00000000-0000-0000-0000-000000000000",
            "id" => 0,
            "name" => "FakeFragment",
            "class" => null,
            "component" => "Ephect",
            "text" => "<>",
            "method" => "echo",
            "startsAt" => 0,
            "endsAt" => 0,
            "props" => [],
            "node" => [],
            "hasCloser" => true,
            "isSibling" => false,
            "parentId" => -1,
            "depth" => 0
        ];

        return new ComponentEntity(new ComponentStructure($fragment));
    }

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getDepth(): int
    {
        return $this->depth;
    }

    public function hasProps(): bool
    {
        return count($this->properties) > 0;
    }

    public function hasCloser(): bool
    {
        return $this->hasCloser;
    }

    public function isSibling(): bool
    {
        return $this->isSibling;
    }

    public function getCloser(): array
    {
        return $this->closer;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function getEnd(): int
    {
        return $this->end;
    }

    public function composedOf(): array
    {
        $names = [];
        $names[] = $this->name;

        $this->forEach(function (ComponentEntityInterface $item, $key) use (&$names) {
            $names[] = $item->getName();
        }, $this);

        return $names;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return $this->struct->toArray();
    }

    public function props(?string $key = null): string|array|null
    {
        if ($key === null) {
            if (count($this->properties) === 0) {
                return null;
            }
            return $this->properties;
        }
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }
        return null;
    }

    public function getInnerHTML(): string
    {
        $result = '';

        if (!isset($this->closer['contents']['text'])) {
            return $result;
        }

        $result = $this->closer['contents']['text'];
        $result = substr($result, 9);

        return base64_decode($result);
    }

    public function getContents(?string $html = null): ?string
    {
        $result = '';

        if (!$this->hasCloser) {
            return $result;
        }

        $contents = $this->closer['contents'];
        $start = $contents['startsAt'];
        $end = $contents['endsAt'];

        $compFile = ComponentRegistry::read($this->compName);
        if ($compFile === null) {
            return $result;
        }
        $text = $html ?: File::safeRead(COPY_DIR . $compFile);

        if (($pos = strpos($text, $this->text) + strlen($this->text)) > $start) {
            $offset = $pos - $start;

            $start += $offset;
            $end += $offset;
        }

        return substr($text, $start, $end - $start + 1);
    }

    public function hasAttributes(): bool
    {
        return count($this->attributes) > 0;
    }
    public function getAttributes(): array
    {
        return $this->attributes;
    }

}
