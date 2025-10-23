<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Caster;

use Symfony\Component\VarDumper\Cloner\Stub;

/**
 * Casts common resource types to array representation.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @final
<<<<<<< HEAD
 *
 * @internal since Symfony 7.3
 */
class ResourceCaster
{
    /**
     * @deprecated since Symfony 7.3
     */
    public static function castCurl(\CurlHandle $h, array $a, Stub $stub, bool $isNested): array
    {
        trigger_deprecation('symfony/var-dumper', '7.3', 'The "%s()" method is deprecated without replacement.', __METHOD__);

        return CurlCaster::castCurl($h, $a, $stub, $isNested);
    }

    /**
     * @param resource|\Dba\Connection $dba
     */
    public static function castDba(mixed $dba, array $a, Stub $stub, bool $isNested): array
    {
        if (\PHP_VERSION_ID < 80402 && !\is_resource($dba)) {
            // @see https://github.com/php/php-src/issues/16990
            return $a;
        }

=======
 */
class ResourceCaster
{
    public static function castCurl(\CurlHandle $h, array $a, Stub $stub, bool $isNested): array
    {
        return curl_getinfo($h);
    }

    /**
     * @return array
     */
    public static function castDba($dba, array $a, Stub $stub, bool $isNested)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $list = dba_list();
        $a['file'] = $list[(int) $dba];

        return $a;
    }

<<<<<<< HEAD
    public static function castProcess($process, array $a, Stub $stub, bool $isNested): array
=======
    /**
     * @return array
     */
    public static function castProcess($process, array $a, Stub $stub, bool $isNested)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return proc_get_status($process);
    }

    public static function castStream($stream, array $a, Stub $stub, bool $isNested): array
    {
        $a = stream_get_meta_data($stream) + static::castStreamContext($stream, $a, $stub, $isNested);
        if ($a['uri'] ?? false) {
            $a['uri'] = new LinkStub($a['uri']);
        }

        return $a;
    }

<<<<<<< HEAD
    public static function castStreamContext($stream, array $a, Stub $stub, bool $isNested): array
=======
    /**
     * @return array
     */
    public static function castStreamContext($stream, array $a, Stub $stub, bool $isNested)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return @stream_context_get_params($stream) ?: $a;
    }

    /**
<<<<<<< HEAD
     * @deprecated since Symfony 7.3
     */
    public static function castGd(\GdImage $gd, array $a, Stub $stub, bool $isNested): array
    {
        trigger_deprecation('symfony/var-dumper', '7.3', 'The "%s()" method is deprecated without replacement.', __METHOD__);

        return GdCaster::castGd($gd, $a, $stub, $isNested);
    }

    /**
     * @deprecated since Symfony 7.3
     */
    public static function castOpensslX509(\OpenSSLCertificate $h, array $a, Stub $stub, bool $isNested): array
    {
        trigger_deprecation('symfony/var-dumper', '7.3', 'The "%s()" method is deprecated without replacement.', __METHOD__);

        return OpenSSLCaster::castOpensslX509($h, $a, $stub, $isNested);
=======
     * @return array
     */
    public static function castGd($gd, array $a, Stub $stub, bool $isNested)
    {
        $a['size'] = imagesx($gd).'x'.imagesy($gd);
        $a['trueColor'] = imageistruecolor($gd);

        return $a;
    }

    /**
     * @return array
     */
    public static function castOpensslX509($h, array $a, Stub $stub, bool $isNested)
    {
        $stub->cut = -1;
        $info = openssl_x509_parse($h, false);

        $pin = openssl_pkey_get_public($h);
        $pin = openssl_pkey_get_details($pin)['key'];
        $pin = \array_slice(explode("\n", $pin), 1, -2);
        $pin = base64_decode(implode('', $pin));
        $pin = base64_encode(hash('sha256', $pin, true));

        $a += [
            'subject' => new EnumStub(array_intersect_key($info['subject'], ['organizationName' => true, 'commonName' => true])),
            'issuer' => new EnumStub(array_intersect_key($info['issuer'], ['organizationName' => true, 'commonName' => true])),
            'expiry' => new ConstStub(date(\DateTimeInterface::ISO8601, $info['validTo_time_t']), $info['validTo_time_t']),
            'fingerprint' => new EnumStub([
                'md5' => new ConstStub(wordwrap(strtoupper(openssl_x509_fingerprint($h, 'md5')), 2, ':', true)),
                'sha1' => new ConstStub(wordwrap(strtoupper(openssl_x509_fingerprint($h, 'sha1')), 2, ':', true)),
                'sha256' => new ConstStub(wordwrap(strtoupper(openssl_x509_fingerprint($h, 'sha256')), 2, ':', true)),
                'pin-sha256' => new ConstStub($pin),
            ]),
        ];

        return $a;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
