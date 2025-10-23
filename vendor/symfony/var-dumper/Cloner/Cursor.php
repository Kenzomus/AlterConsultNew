<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Cloner;

/**
 * Represents the current state of a dumper while dumping.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class Cursor
{
    public const HASH_INDEXED = Stub::ARRAY_INDEXED;
    public const HASH_ASSOC = Stub::ARRAY_ASSOC;
    public const HASH_OBJECT = Stub::TYPE_OBJECT;
    public const HASH_RESOURCE = Stub::TYPE_RESOURCE;

<<<<<<< HEAD
    public int $depth = 0;
    public int $refIndex = 0;
    public int $softRefTo = 0;
    public int $softRefCount = 0;
    public int $softRefHandle = 0;
    public int $hardRefTo = 0;
    public int $hardRefCount = 0;
    public int $hardRefHandle = 0;
    public int $hashType;
    public string|int|null $hashKey = null;
    public bool $hashKeyIsBinary;
    public int $hashIndex = 0;
    public int $hashLength = 0;
    public int $hashCut = 0;
    public bool $stop = false;
    public array $attr = [];
    public bool $skipChildren = false;
=======
    public $depth = 0;
    public $refIndex = 0;
    public $softRefTo = 0;
    public $softRefCount = 0;
    public $softRefHandle = 0;
    public $hardRefTo = 0;
    public $hardRefCount = 0;
    public $hardRefHandle = 0;
    public $hashType;
    public $hashKey;
    public $hashKeyIsBinary;
    public $hashIndex = 0;
    public $hashLength = 0;
    public $hashCut = 0;
    public $stop = false;
    public $attr = [];
    public $skipChildren = false;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
