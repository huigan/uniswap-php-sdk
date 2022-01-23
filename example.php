<?php
namespace Huigan\Uniphp;
require 'vendor/autoload.php';
use Huigan\Uniphp\Uniswap;



$Uniphp = new Uniswap();
$Uniphp->setKey('fc062ebf12fd5e89f8cf580276a42da3c7f1ec9e41673dc9c93ea3a81add8929');
//$id=$uniswap->approve($uniswap->routeAddress,'10');
$id=$Uniphp->swap('1');
var_dump($id);
