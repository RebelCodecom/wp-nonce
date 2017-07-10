<?php

namespace RebelCode\WordPress\Nonce\Block;

use Dhii\Block\BlockInterface;
use RebelCode\WordPress\Nonce\NonceAwareInterface;
use RebelCode\WordPress\Nonce\NonceInterface;

/**
 * The simple, default implementation of a block that renders a nonce hidden field.
 *
 * @since [*next-version*]
 */
class NonceFieldBlock extends AbstractNonceFieldBlock implements BlockInterface, NonceAwareInterface
{
    /**
     * The default value for the field's name attribute.
     *
     * @since [*next-version*]
     */
    const DEFAULT_FIELD_NAME = '_wpnonce';

    /**
     * The name of the referer field.
     */
    const REFERER_FIELD_NAME = '_wp_http_referer';

    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param NonceInterface $nonce
     * @param string         $fieldName
     * @param string|null    $refererUrl
     */
    public function __construct(
        NonceInterface $nonce,
        $fieldName = self::DEFAULT_FIELD_NAME,
        $refererUrl = null
    ) {
        $this->_setNonce($nonce)
            ->_setFieldName($fieldName)
            ->_setRefererUrl($refererUrl)
            ->_setRefererFieldName(static::REFERER_FIELD_NAME);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _getRefererUrl()
    {
        return \wp_unslash(parent::_getRefererUrl());
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getNonce()
    {
        return $this->_getNonce();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function render()
    {
        return $this->_render();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function __toString()
    {
        return $this->render();
    }
}
