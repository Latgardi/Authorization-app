<?php
include "lib/BladeOne.php";
use eftec\bladeone\BladeOne;

const VIEWS = __DIR__ . '/views';
const CACHE = __DIR__ . '/cache';
$blade = new BladeOne(VIEWS, CACHE,BladeOne::MODE_DEBUG);
return $blade;

