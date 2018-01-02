<?php

/**
 * This file is part of the edm-bundle package.
 *
 * (c) 2017 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\EDMBundle\Form\Type\Document;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;

/**
 * Abstract document type.
 *
 * @author NdC/WBW <https://github.com/webeweb/>
 * @package WBW\Bundle\EDMBundle\Form\Type\Document
 * @abstract
 */
abstract class AbstractDocumentType extends AbstractType {

	/**
	 * Pre set data.
	 *
	 * @param FormEvent $event The form event.
	 * @return void
	 */
	final public function preSetData(FormEvent $event) {

		// Get the entity.
		$document = $event->getData();

		// Backup the necessary fields.
		$document->setParentBackedUp($document->getParent());
	}

}
