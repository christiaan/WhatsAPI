<?php
require __DIR__. '/../src/rc4.php';

// Test Framework in a tweet by Mathias Verraes: https://gist.github.com/mathiasverraes/9046427
function it($m,$p){echo ($p?'✔':'✘')." It $m\n"; if(!$p){$GLOBALS['f']=1;}}function done(){if(@$GLOBALS['f'])die(1);}

$rc4 = new rc4('Key', 768);

$data = 'Plaintext';

$encrypted = $rc4->cipher($data, 0, strlen($data));

it('should match a precalculated value', bin2hex($encrypted) === '857047028b192029fd');

$rc4 = new rc4('Key', 768);

$data = 'abPlaintext';

$encrypted = $rc4->cipher($data, 2, strlen($data) -2);

it('should match a precalculated value with a offset', bin2hex($encrypted) === '6162857047028b192029fd');

done();