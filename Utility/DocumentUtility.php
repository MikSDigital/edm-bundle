<?php

/**
 * This file is part of the edm-bundle package.
 *
 * (c) 2017 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\EDMBundle\Utility;

use WBW\Bundle\EDMBundle\Entity\DocumentInterface;

/**
 * Document utility.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Bundle\EDMBundle\Utility
 * @final
 */
final class DocumentUtility {

    /**
     * Get a filename.
     *
     * @param DocumentInterface $document The document.
     * @return string Returns the filename.
     */
    public static function getFilename(DocumentInterface $document) {
        if ($document->isDirectory()) {
            return $document->getName();
        }
        $filename = implode(".", [$document->getName(), $document->getExtension()]);
        return "." !== $filename ? $filename : "";
    }

    /**
     * Get a pathname.
     *
     * @param DocumentInterface $document The document.
     * @return string Return the pathname.
     */
    public static function getPathname(DocumentInterface $document) {
        $path = [];
        foreach (self::getPaths($document, false) as $current) {
            $path[] = self::getFilename($current);
        }
        return implode("/", $path);
    }

    /**
     * Get the paths.
     *
     * @param DocumentInterface $document The document.
     * @param boolean $backedUp Backed up ?
     * @return DocumentInterface[] Returns the paths.
     */
    public static function getPaths(DocumentInterface $document, $backedUp = false) {

        // Initialize the path.
        $path = [];

        // Save the document.
        $current = $document;

        // Handle each parent.
        while (null !== $current) {
            array_unshift($path, $current); // Insert parent path at start.
            $current = $current === $document && true === $backedUp ? $current->getParentBackedUp() : $current->getParent();
        }

        // Return the path.
        return $path;
    }

}
