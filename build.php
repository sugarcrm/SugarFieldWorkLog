#!/usr/bin/env php
<?php

// Copyright 2016 SugarCRM Inc.  Licensed by SugarCRM under the Apache 2.0 license.

$id = time();
$zipFile = "builds/SugarFieldWorkLog-{$id}.zip";

echo "Creating {$zipFile} ... \n";

$zip = new ZipArchive();
$zip->open($zipFile, ZipArchive::CREATE);
$basePath = realpath('src/');

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($basePath, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file) {
    if ($file->isFile()) {
        $fileReal = $file->getRealPath();
        $fileRelative = str_replace($basePath . '/', '', $fileReal);
        echo " [*] $fileRelative \n";
        $zip->addFile($fileReal, $fileRelative);
        $installdefs['copy'][] = array(
            'from' => '<basepath>/' . $fileRelative,
            'to' => preg_replace('/^src\/(.*)/', '$1', $fileRelative),
        );
    }
}

$license = 'LICENSE.txt';
$zip->addFile($license, $license);
echo " [*] $license \n";

$zip->close();

echo "done\n";
exit(0);
