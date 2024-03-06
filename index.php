<?php
require __DIR__ . '/loader.php';
$server = new LicenseServer();
$server->handleRequest();