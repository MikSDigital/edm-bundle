<?php

/**
 * This file is part of the edm-bundle package.
 *
 * (c) 2017 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\EDMBundle\Tests\Entity;

use DateTime;
use PHPUnit_Framework_TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use WBW\Bundle\EDMBundle\Entity\Document;

/**
 * DocumentTest.
 *
 * @author NdC/WBW <https://github.com/webeweb/>
 * @package WBW\Bundle\EDMBundle\Tests\Entity
 */
final class DocumentTest extends PHPUnit_Framework_TestCase {

	/**
	 * Tests __construct() method.
	 *
	 * @return void.
	 */
	public function testConstructor() {

		$obj = new Document();

		$this->assertEquals(null, $obj->getAlphabeticalTreeSortLabel());
		$this->assertCount(0, $obj->getChildrens());
		$this->assertEquals(null, $obj->getChoiceLabel());
		$this->assertEquals(null, $obj->getCreatedAt());
		$this->assertEquals(null, $obj->getId());
		$this->assertEquals(null, $obj->getOldName());
		$this->assertEquals(null, $obj->getOldParent());
		$this->assertEquals(null, $obj->getName());
		$this->assertEquals(null, $obj->getParent());
		$this->assertEquals(null, $obj->getSize());
		$this->assertEquals(Document::TYPE_DOCUMENT, $obj->getType());
		$this->assertEquals(null, $obj->getUpdatedAt());
		$this->assertEquals(null, $obj->getUpload());
	}

	/**
	 * Tests the addChildren() method.
	 *
	 * @return void
	 */
	public function testAddChildren() {

		$obj = new Document();
		$arg = new Document();

		$obj->addChildren($arg);
		$this->assertEquals($arg, $obj->getChildrens()[0]);
	}

	/**
	 * Tests the backup() method.
	 *
	 * @return void
	 */
	public function testBackup() {

		$obj = new Document();
		$arg = new Document();

		$obj->backup();
		$this->assertEquals(null, $obj->getOldName());
		$this->assertEquals(null, $obj->getOldParent());

		$obj->setName("name");
		$obj->setParent($arg);
		$this->assertEquals("name", $obj->getOldName());
		$this->assertEquals($arg, $obj->getOldParent());
	}

	/**
	 * Tests the removeChildren() method.
	 *
	 * @return void
	 */
	public function testRemoveChildren() {

		$obj = new Document();
		$arg = new Document();

		$obj->addChildren($arg);
		$this->assertEquals($arg, $obj->getChildrens()[0]);

		$obj->removeChildren($arg);
		$this->assertCount(0, $obj->getChildrens());
	}

	/**
	 * Tests setCreatedAt() method.
	 *
	 * @return void
	 */
	public function testSetCreatedAt() {

		$obj = new Document();
		$arg = new DateTime();

		$obj->setCreatedAt($arg);
		$this->assertEquals($arg, $obj->getCreatedAt());
	}

	/**
	 * Tests setName() method.
	 *
	 * @return void
	 */
	public function testSetName() {

		$obj = new Document();

		$obj->setName("name");
		$this->assertEquals("name", $obj->getName());
	}

	/**
	 * Tests setParent() method.
	 *
	 * @return void
	 */
	public function testSetParent() {

		$obj = new Document();
		$arg = new Document();

		$obj->setParent($arg);
		$this->assertEquals($arg, $obj->getParent());
	}

	/**
	 * Tests setSize() method.
	 *
	 * @return void
	 */
	public function testSetSize() {

		$obj = new Document();

		$obj->setSize(0);
		$this->assertEquals(0, $obj->getSize());
	}

	/**
	 * Tests setType() method.
	 *
	 * @return void
	 */
	public function testSetType() {

		$obj = new Document();

		$obj->setType(-1);
		$this->assertEquals(null, $obj->getType());

		$obj->setType(Document::TYPE_DIRECTORY);
		$this->assertEquals(Document::TYPE_DIRECTORY, $obj->getType());

		$obj->setType(Document::TYPE_DOCUMENT);
		$this->assertEquals(Document::TYPE_DOCUMENT, $obj->getType());
	}

	/**
	 * Tests setUpdatedAt() method.
	 *
	 * @return void
	 */
	public function testSetUpdatedAt() {

		$obj = new Document();
		$arg = new DateTime();

		$obj->setUpdatedAt($arg);
		$this->assertEquals($arg, $obj->getUpdatedAt());
	}

	/**
	 * Tests the setUpload() method.
	 *
	 * @return void.
	 */
	public function testSetUplaod() {

		$obj = new Document();
		$arg = new UploadedFile(getcwd() . "/Tests/Entity/DocumentTest.php", "");

		$obj->setUpload($arg);
		$this->assertEquals($arg, $obj->getUpload());
	}

}
