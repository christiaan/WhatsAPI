<?php
require __DIR__. '/../src/func.php';

// Test Framework in a tweet by Mathias Verraes: https://gist.github.com/mathiasverraes/9046427
function it($m,$p){echo ($p?'✔':'✘')." It $m\n"; if(!$p){$GLOBALS['f']=1;}}function done(){if(@$GLOBALS['f'])die(1);}


$algorithm = 'sha1'; // Only sha1 is ever used
$raw_output = true; // Is always true in the codebase


$simpleHash = wa_pbkdf2(
    $algorithm,
    'simple password',
    'some salt',
    2,
    20,
    $raw_output
);

it('should create a simple hash of 20 characters', strlen($simpleHash) === 20);
it('should create a simple hash with expected value', bin2hex($simpleHash) === '1c4ed08799ca7f2cc88624d2168656529c2a7872');


$authBlobHash = wa_pbkdf2(
    $algorithm,
    'iwerhthpwerptpwet',
    'owertowethowetoowet',
    16,
    20,
    $raw_output
);

it('should create a authBlob hash of 20 characters', strlen($authBlobHash) === 20);
it('should create a authBlob hash with expected value', bin2hex($authBlobHash) === '6965a4063946c12f9c70abccedff3a36540dd475');

done();