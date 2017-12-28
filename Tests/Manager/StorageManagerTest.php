<?php

/**
 * This file is part of the edm-bundle package.
 *
 * (c) 2017 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\EDMBundle\Tests\Manager;

use PHPUnit_Framework_TestCase;
use WBW\Bundle\EDMBundle\Entity\Document;
use WBW\Bundle\EDMBundle\Manager\StorageManager;

/**
 * Storage manager test.
 *
 * @author NdC/WBW <https://github.com/webeweb/>
 * @package WBW\Bundle\EDMBundle\Manager
 * @final
 */
final class StorageManagerTest extends PHPUnit_Framework_TestCase {

	/**
	 * Directory 1.
	 *
	 * @var Document
	 */
	private $dir1;

	/**
	 * Directory 2.
	 *
	 * @var Document
	 */
	private $dir2;

	/**
	 * Directory 3.
	 *
	 * @var Document
	 */
	private $dir3;

	/**
	 * {@inheritdoc}
	 */
	protected function setUp() {

		$this->dir1 = new TestDocument();
		$this->dir1->setId(1);
		$this->dir1->setName("phpunit");
		$this->dir1->setType(Document::TYPE_DIRECTORY);

		$this->dir2 = new TestDocument();
		$this->dir2->setId(2);
		$this->dir2->setName("unittest");
		$this->dir2->setParent($this->dir1);
		$this->dir2->setType(Document::TYPE_DIRECTORY);

		$this->dir3 = new TestDocument();
		$this->dir3->setId(3);
		$this->dir3->setName("functionaltest");
		$this->dir3->setParent($this->dir2);
		$this->dir3->setType(Document::TYPE_DIRECTORY);
	}

	/**
	 * Tests the getRelativePath() method.
	 *
	 * @return void
	 */
	public function testGetRelativePath() {

		$obj = new StorageManager(getcwd());

		$this->assertEquals("", $obj->getRelativePath(null));
		$this->assertEquals("1", $obj->getRelativePath($this->dir1));
		$this->assertEquals("1/2", $obj->getRelativePath($this->dir2));
		$this->assertEquals("1/2/3", $obj->getRelativePath($this->dir3));
	}

	/**
	 * Tests the getVirtualPath() method.
	 *
	 * @return void
	 */
	public function testGetVirtualPath() {

		$obj = new StorageManager(getcwd());

		$this->assertEquals("", $obj->getVirtualPath(null));
		$this->assertEquals("phpunit", $obj->getVirtualPath($this->dir1));
		$this->assertEquals("phpunit/unittest", $obj->getVirtualPath($this->dir2));
		$this->assertEquals("phpunit/unittest/functionaltest", $obj->getVirtualPath($this->dir3));
	}

	/**
	 * Tests the saveDocument() method.
	 *
	 * @return void
	 */
	public function testSaveDocument() {

		$obj = new StorageManager(getcwd());

		$this->assertEquals(true, $obj->saveDocument($this->dir1));
		$this->assertEquals(false, $obj->saveDocument($this->dir1));
		$this->assertEquals(true, $obj->saveDocument($this->dir2));
		$this->assertEquals(true, $obj->saveDocument($this->dir3));

		$this->assertFileExists(getcwd() . "/1");
		$this->assertFileExists(getcwd() . "/1/2");
		$this->assertFileExists(getcwd() . "/1/2/3");
	}

	/**
	 * Tests the moveDocument() method.
	 *
	 * @return void
	 * @depends testSaveDocument
	 */
	public function testMoveDocument() {

		$obj = new StorageManager(getcwd());

		$this->dir3->setParentBackedUp($this->dir3->getParent());
		$this->dir3->setParent($this->dir1);
		$this->assertEquals(true, $obj->moveDocument($this->dir3));

		$this->assertFileExists(getcwd() . "/1");
		$this->assertFileExists(getcwd() . "/1/2");
		$this->assertFileExists(getcwd() . "/1/3");
	}

	/**
	 * Tests the deleteDocument() method.
	 *
	 * @return void
	 * @depends testMoveDocument
	 */
	public function testDeleteDocument() {

		$obj = new StorageManager(getcwd());

		$this->dir3->setParent($this->dir1); // This directory was moved.
		$this->assertEquals(false, $obj->deleteDocument($this->dir1));
		$this->assertEquals(true, $obj->deleteDocument($this->dir3));
		$this->assertEquals(true, $obj->deleteDocument($this->dir2));
		$this->assertEquals(true, $obj->deleteDocument($this->dir1));

		$this->assertFileNotExists(getcwd() . "/1/3");
		$this->assertFileNotExists(getcwd() . "/1/2");
		$this->assertFileNotExists(getcwd() . "/1");
	}

}
