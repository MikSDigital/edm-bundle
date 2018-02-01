<?php

/**
 * This file is part of the edm-bundle package.
 *
 * (c) 2017 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\EDMBundle\Tests\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use WBW\Bundle\EDMBundle\Tests\FunctionalTest;

/**
 * Dropzone controller test.
 *
 * @author NdC/WBW <https://github.com/webeweb/>
 * @package WBW\Bundle\EDMBundle\Tests\Controller
 * @final
 */
final class DropzoneControllerTest extends FunctionalTest {

    /**
     * Tests the newAction() method.
     *
     * @return void
     */
    public function testUploadAction() {

        $upload = new UploadedFile(getcwd() . "/Tests/Fixtures/App/TestDocument.php", "TestDocument.php", "application/php", 604);

        $client = static::createClient();

        $crawler = $client->request("GET", "/dropzone/upload");
        echo $client->getResponse()->getContent();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals("Uploading a document into /", $crawler->filter("h3")->text());

        $submit = $crawler->filter("form");
        $form   = $submit->form([
            "edmbundle_upload_document[upload]" => $upload,
        ]);
        $client->submit($form);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}