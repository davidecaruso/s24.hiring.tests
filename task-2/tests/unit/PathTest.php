<?php
declare(strict_types=1);

namespace Supermercato24\FileSystem;

/**
 * Class PathTest
 *
 * @category Class
 * @package  Supermercato24\FileSystem
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class PathTest extends \Codeception\Test\Unit
{
    public function testDefaultPathShouldBeRoot()
    {
        $instance = new Path();
        $this->assertEquals('/', $instance->getCurrentPath());
    }

    public function testPathShouldBeEqualToPassed()
    {
        $instance = new Path('/a/b/c/d/');
        $this->assertEquals('/a/b/c/d', $instance->getCurrentPath());
    }

    public function testCanGoToParentFolder()
    {
        $instance = new Path('/a/b/c/d/');
        $instance->cd('../');
        $this->assertEquals('/a/b/c', $instance->getCurrentPath());
    }

    public function testPassComplexPath()
    {
        $instance = new Path('/a/./b/../b/./c/../');
        $this->assertEquals('/a/b', $instance->getCurrentPath());
    }

    public function testNavigationWithComplexPath()
    {
        $instance = new Path('/a/./b/../b/./c/../');
        $instance->cd('../b/./c/d/../');
        $this->assertEquals('/a/b/c', $instance->getCurrentPath());
    }

    public function testGoToRootFolder()
    {
        $instance = new Path('/a/./b/../b/./c/../');
        $instance->cd('/');
        $this->assertEquals('/', $instance->getCurrentPath());
    }

    public function testInvalidPathShouldThrowException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The path contains invalid directory names: /1-4m-1nv4l1d/');
        $instance = new Path('/1-4m-1nv4l1d/');
    }
}
