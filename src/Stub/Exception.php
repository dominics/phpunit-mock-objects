<?php
/*
 * This file is part of the phpunit-mock-objects package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\MockObject\Invocation;
use SebastianBergmann\Exporter\Exporter;

/**
 * Stubs a method by raising a user-defined exception.
 */
class PHPUnit_Framework_MockObject_Stub_Exception implements PHPUnit_Framework_MockObject_Stub
{
    protected $exception;

    public function __construct($exception)
    {
        // TODO Replace check with type declaration when support for PHP 5 is dropped
        if (!$exception instanceof Throwable && !$exception instanceof Exception) {
            throw new PHPUnit_Framework_MockObject_RuntimeException(
                'Exception must be an instance of Throwable (PHP 7) or Exception (PHP 5)'
            );
        }

        $this->exception = $exception;
    }

    public function invoke(Invocation $invocation)
    {
        throw $this->exception;
    }

    public function toString()
    {
        $exporter = new Exporter;

        return sprintf(
            'raise user-specified exception %s',
            $exporter->export($this->exception)
        );
    }
}
