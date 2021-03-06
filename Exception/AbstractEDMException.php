<?php

/**
 * This file is part of the edm-bundle package.
 *
 * (c) 2018 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\EDMBundle\Exception;

use Exception;
use WBW\Library\Core\Exception\AbstractWBWException;

/**
 * Abstract EDM exception.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Bundle\EDMBundle\Exception
 * @abstract
 */
abstract class AbstractEDMException extends AbstractWBWException {

    /**
     * Constructor.
     *
     * @param string $message The message.
     * @param Exception $previous The previous exception.
     */
    public function __construct($message, Exception $previous = null) {
        parent::__construct($message, $previous);
    }

}
