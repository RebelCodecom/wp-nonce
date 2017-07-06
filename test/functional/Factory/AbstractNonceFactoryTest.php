<?php

namespace RebelCode\WordPress\Nonce\Factory\FuncTest;

use Xpmock\TestCase;
use RebelCode\WordPress\Nonce\Factory\AbstractNonceFactory;

/**
 * Tests {@see RebelCode\WordPress\Nonce\Factory\AbstractNonceFactory}.
 *
 * @since [*next-version*]
 */
class AbstractNonceFactoryTest extends TestCase
{
    /**
     * The classname of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\WordPress\Nonce\Factory\AbstractNonceFactory';

    /**
     * The class name of the nonce class to use for testing.
     *
     * @since [*next-version*]
     */
    const NONCE_CLASSNAME = 'RebelCode\\WordPress\\Nonce\\NonceInterface';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return AbstractNonceFactory
     */
    public function createInstance()
    {
        $me = $this;

        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_createNonce(function($id, $code) use ($me) {
                return $me->createNonce($id, $code);
            })
            ->new();

        return $mock;
    }

    /**
     * Creates a nonce for testing purposes.
     *
     * @since [*next-version*]
     *
     * @param string $id   The nonce ID.
     * @param string $code The nonce code.
     *
     * @return NonceInterface
     */
    public function createNonce($id = '', $code = '')
    {
        return $this->mock(static::NONCE_CLASSNAME)
            ->getId($id)
            ->getCode($code)
            ->new();
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(
            static::TEST_SUBJECT_CLASSNAME, $subject,
            'Subject is not a valid instance'
        );
    }

    /**
     * Tests the nonce creation method to ensure that a valid nonce instance is created.
     *
     * @since [*next-version*]
     */
    public function testMake()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $nonce = $reflect->_make($id = 'test_nonce');

        $this->assertInstanceOf(
            static::NONCE_CLASSNAME, $nonce,
            'Created instance is not a valid nonce.'
        );

        $this->assertEquals($id, $nonce->getId(), 'Created nonce does not have the given ID.');
    }
}