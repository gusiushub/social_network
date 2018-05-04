<?php
$memcache = new Memcache;
$memcache->connect('localhost',11211); // подключение
$vRevision = 1; // ревизия кеша, пригодиться для принудительного сброса кеша