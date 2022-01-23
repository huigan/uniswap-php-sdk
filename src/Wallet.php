<?php

namespace Huigan\Uniphp;

use Elliptic\EC;
use kornrunner\Keccak;

class Wallet
{
    private $address;
    private $privateKey;

    private function __construct($address, $privateKey)
    {
        $this->address = $address;
        $this->privateKey = $privateKey;
    }

    static public function createByPrivate($privateKey): Wallet
    {
        $ec = new EC('secp256k1');
        // Generate keys
        $key = $ec->keyFromPrivate($privateKey);
        $pub = $key->getPublic('hex');
        // get address based on public key
        return new Wallet(strtolower(self::pubKeyToAddress($pub)), $privateKey);
    }

    public static function pubKeyToAddress($pubkey)
    {
        return '0x' . substr(Keccak::hash(substr(hex2bin($pubkey), 1), 256), 24);
    }


    public function getAddress()
    {
        return $this->address;
    }

    public function getPrivateKey()
    {
        return self::add0x($this->privateKey);
    }


    public static function remove0x($value)
    {
        if (strtolower(substr($value, 0, 2)) == '0x') {
            return substr($value, 2);
        }
        return $value;
    }

    public static function add0x($value): string
    {
        return '0x' . self::remove0x($value);
    }


}
