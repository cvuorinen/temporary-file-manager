<?php

/**
 * This file is part of the pekkis-temporary-file-manager package.
 *
 * For copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pekkis\TemporaryFileManager;

use Symfony\Component\Filesystem\Filesystem;

class TemporaryFileManager
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $root;

    /**
     * @var array
     */
    private $files = [];

    public function __construct($tempDir, $directoryMode = 0700)
    {
        $this->root = $tempDir;

        $this->filesystem = new Filesystem();
        $this->filesystem->mkdir($tempDir, $directoryMode);
    }

    public function __destruct()
    {
        $this->filesystem->remove($this->files);
    }

    /**
     * @param string $contents
     * @return string
     */
    public function add($contents)
    {
        $path = $this->path();
        $this->filesystem->dumpFile($path, $contents);
        $this->files[] = $path;
        return $path;
    }

    /**
     * @param string $path
     * @return string
     */
    public function addFile($path)
    {
        return $this->add(file_get_contents($path));
    }

    /**
     * @return string
     */
    private function path()
    {
        return $this->root . DIRECTORY_SEPARATOR . uniqid();
    }
}
