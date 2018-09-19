<?php
declare(strict_types=1);

namespace Supermercato24\FileSystem;

/**
 * Class Path
 * @category Class
 * @package  Supermercato24\FileSystem
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class Path
{
    /**
     * @var string
     */
    const DS = DIRECTORY_SEPARATOR;

    /**
     * @var string
     */
    const ROOT = '/';

    /**
     * @var string
     */
    const PARENT_SIGN = '..';

    /**
     * @var string
     */
    const CURRENT_SIGN = '.';

    /**
     * @var string
     */
    protected $currentPath;

    /**
     * Path constructor.
     *
     * @param string $path
     *
     * @throws \Exception
     */
    public function __construct(string $path = self::ROOT)
    {
        $this->check($path);
        $this->setCurrentPath($path);
    }

    /**
     * Get the current path.
     * @return string
     */
    public function getCurrentPath(): string
    {
        return $this->currentPath;
    }

    /**
     * Change directory.
     * @param string $path
     *
     * @throws \Exception
     */
    public function cd(string $path)
    {
        $this->check($path);
        substr($path, 0, 1) === self::DS
            ? $this->setCurrentPath($path) : $this->setCurrentPath($this->currentPath . self::DS . $path);
    }

    /**
     * Set the current path removing trailing slash.
     *
     * @param string $path
     */
    protected function setCurrentPath(string $path)
    {
        $path = $path === self::ROOT ? $path : rtrim($path, self::DS);
        $this->currentPath = self::ROOT;
        $folders = explode(self::DS, $path);
        array_walk($folders, function ($folder) {
            $folder = trim($folder, self::DS);
            if ($folder !== self::CURRENT_SIGN) {
                if ($folder === self::PARENT_SIGN) {
                    $this->back();
                    $this->currentPath .= self::DS;
                } elseif ($folder !== '') {
                    $this->currentPath .= $folder . self::DS;
                }
            }
        });

        $this->currentPath = $this->currentPath === self::ROOT ?
            $this->currentPath : rtrim($this->currentPath, self::DS);
    }

    /**
     * Go back to the parent folder.
     */
    protected function back()
    {
        $this->setCurrentPath($this->currentPath);
        $paths = explode(self::DS, $this->currentPath);
        array_pop($paths);
        $this->setCurrentPath(implode(self::DS, $paths));
    }

    /**
     * Check if a path is valid.
     *
     * @param string $path
     *
     * @throws \Exception
     */
    protected function check(string $path)
    {
        if (!preg_match('/^(\/?((\.{1,2}\/)*([A-Za-z])*(\/\.{1,2})*)*\/?)*$/', $path)) {
            throw new \Exception("The path contains invalid directory names: {$path}", 422);
        }
    }
}
