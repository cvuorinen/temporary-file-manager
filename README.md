# pekkis/temporary-file-manager

A manager for application's temporary files. Deletes per-request.

## Quickstart

## Status

Full maintenance mode. If you want to maintain, holler.

```php
<?php

use Pekkis\TemporaryFileManager\TemporaryFileManager;

$fm = new TemporaryFileManager($someDirectoryPath);

// Add some bytes
$ret = $fm->add($someContent);

// or add a file and it gets copied
$ret2 = $fm->addFile($someFilePath);

// Either way, you get a path to the temporary file
var_dump($ret);

// And when all the manager references are destroyed, typically at the end of a request, the files are deleted too.
unset($fm);

```