<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation;

/**
 * HeaderBag is a container for HTTP headers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @implements \IteratorAggregate<string, list<string|null>>
 */
class HeaderBag implements \IteratorAggregate, \Countable, \Stringable
{
    protected const UPPER = '_ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    protected const LOWER = '-abcdefghijklmnopqrstuvwxyz';

    /**
     * @var array<string, list<string|null>>
     */
<<<<<<< HEAD
    protected array $headers = [];
    protected array $cacheControl = [];
=======
    protected $headers = [];
    protected $cacheControl = [];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public function __construct(array $headers = [])
    {
        foreach ($headers as $key => $values) {
            $this->set($key, $values);
        }
    }

    /**
     * Returns the headers as a string.
     */
    public function __toString(): string
    {
        if (!$headers = $this->all()) {
            return '';
        }

        ksort($headers);
        $max = max(array_map('strlen', array_keys($headers))) + 1;
        $content = '';
        foreach ($headers as $name => $values) {
            $name = ucwords($name, '-');
            foreach ($values as $value) {
                $content .= \sprintf("%-{$max}s %s\r\n", $name.':', $value);
            }
        }

        return $content;
    }

    /**
     * Returns the headers.
     *
     * @param string|null $key The name of the headers to return or null to get them all
     *
     * @return ($key is null ? array<string, list<string|null>> : list<string|null>)
     */
    public function all(?string $key = null): array
    {
        if (null !== $key) {
            return $this->headers[strtr($key, self::UPPER, self::LOWER)] ?? [];
        }

        return $this->headers;
    }

    /**
     * Returns the parameter keys.
     *
     * @return string[]
     */
    public function keys(): array
    {
        return array_keys($this->all());
    }

    /**
     * Replaces the current HTTP headers by a new set.
<<<<<<< HEAD
     */
    public function replace(array $headers = []): void
=======
     *
     * @return void
     */
    public function replace(array $headers = [])
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->headers = [];
        $this->add($headers);
    }

    /**
     * Adds new headers the current HTTP headers set.
<<<<<<< HEAD
     */
    public function add(array $headers): void
=======
     *
     * @return void
     */
    public function add(array $headers)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        foreach ($headers as $key => $values) {
            $this->set($key, $values);
        }
    }

    /**
     * Returns the first header by name or the default one.
     */
    public function get(string $key, ?string $default = null): ?string
    {
        $headers = $this->all($key);

        if (!$headers) {
            return $default;
        }

        if (null === $headers[0]) {
            return null;
        }

<<<<<<< HEAD
        return $headers[0];
=======
        return (string) $headers[0];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    /**
     * Sets a header by name.
     *
     * @param string|string[]|null $values  The value or an array of values
     * @param bool                 $replace Whether to replace the actual value or not (true by default)
<<<<<<< HEAD
     */
    public function set(string $key, string|array|null $values, bool $replace = true): void
=======
     *
     * @return void
     */
    public function set(string $key, string|array|null $values, bool $replace = true)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $key = strtr($key, self::UPPER, self::LOWER);

        if (\is_array($values)) {
            $values = array_values($values);

            if (true === $replace || !isset($this->headers[$key])) {
                $this->headers[$key] = $values;
            } else {
                $this->headers[$key] = array_merge($this->headers[$key], $values);
            }
        } else {
            if (true === $replace || !isset($this->headers[$key])) {
                $this->headers[$key] = [$values];
            } else {
                $this->headers[$key][] = $values;
            }
        }

        if ('cache-control' === $key) {
            $this->cacheControl = $this->parseCacheControl(implode(', ', $this->headers[$key]));
        }
    }

    /**
     * Returns true if the HTTP header is defined.
     */
    public function has(string $key): bool
    {
        return \array_key_exists(strtr($key, self::UPPER, self::LOWER), $this->all());
    }

    /**
     * Returns true if the given HTTP header contains the given value.
     */
    public function contains(string $key, string $value): bool
    {
<<<<<<< HEAD
        return \in_array($value, $this->all($key), true);
=======
        return \in_array($value, $this->all($key));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    /**
     * Removes a header.
<<<<<<< HEAD
     */
    public function remove(string $key): void
=======
     *
     * @return void
     */
    public function remove(string $key)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $key = strtr($key, self::UPPER, self::LOWER);

        unset($this->headers[$key]);

        if ('cache-control' === $key) {
            $this->cacheControl = [];
        }
    }

    /**
     * Returns the HTTP header value converted to a date.
     *
<<<<<<< HEAD
     * @throws \RuntimeException When the HTTP header is not parseable
     */
    public function getDate(string $key, ?\DateTimeInterface $default = null): ?\DateTimeImmutable
=======
     * @return \DateTimeImmutable|null
     *
     * @throws \RuntimeException When the HTTP header is not parseable
     */
    public function getDate(string $key, ?\DateTimeInterface $default = null): ?\DateTimeInterface
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        if (null === $value = $this->get($key)) {
            return null !== $default ? \DateTimeImmutable::createFromInterface($default) : null;
        }

        if (false === $date = \DateTimeImmutable::createFromFormat(\DATE_RFC2822, $value)) {
            throw new \RuntimeException(\sprintf('The "%s" HTTP header is not parseable (%s).', $key, $value));
        }

        return $date;
    }

    /**
     * Adds a custom Cache-Control directive.
<<<<<<< HEAD
     */
    public function addCacheControlDirective(string $key, bool|string $value = true): void
=======
     *
     * @return void
     */
    public function addCacheControlDirective(string $key, bool|string $value = true)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->cacheControl[$key] = $value;

        $this->set('Cache-Control', $this->getCacheControlHeader());
    }

    /**
     * Returns true if the Cache-Control directive is defined.
     */
    public function hasCacheControlDirective(string $key): bool
    {
        return \array_key_exists($key, $this->cacheControl);
    }

    /**
     * Returns a Cache-Control directive value by name.
     */
    public function getCacheControlDirective(string $key): bool|string|null
    {
        return $this->cacheControl[$key] ?? null;
    }

    /**
     * Removes a Cache-Control directive.
<<<<<<< HEAD
     */
    public function removeCacheControlDirective(string $key): void
=======
     *
     * @return void
     */
    public function removeCacheControlDirective(string $key)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        unset($this->cacheControl[$key]);

        $this->set('Cache-Control', $this->getCacheControlHeader());
    }

    /**
     * Returns an iterator for headers.
     *
     * @return \ArrayIterator<string, list<string|null>>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->headers);
    }

    /**
     * Returns the number of headers.
     */
    public function count(): int
    {
        return \count($this->headers);
    }

<<<<<<< HEAD
    protected function getCacheControlHeader(): string
=======
    /**
     * @return string
     */
    protected function getCacheControlHeader()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        ksort($this->cacheControl);

        return HeaderUtils::toString($this->cacheControl, ',');
    }

    /**
     * Parses a Cache-Control HTTP header.
     */
    protected function parseCacheControl(string $header): array
    {
        $parts = HeaderUtils::split($header, ',=');

        return HeaderUtils::combine($parts);
    }
}
