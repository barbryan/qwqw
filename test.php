<?php

foreach (['gd', 'xmlwriter', 'zip', 'xsl']
         as $extension) {
    $loaded = extension_loaded($extension) ? 'Loaded' : 'Not Loaded';
    echo "{$extension}: {$loaded}<br>";
}

echo phpinfo();