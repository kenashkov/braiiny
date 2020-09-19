<?php

declare(strict_types=1);

namespace Kenashkov\Braiiny\Application;

use Guzaba2\Base\Exceptions\RunTimeException;
use Guzaba2\Base\Interfaces\BaseInterface;
use Guzaba2\Base\Traits\BaseTrait;
use Guzaba2\Translator\Translator as t;

/**
 * Class BillyDk
 * @package Kenashkov\Braiiny\Application
 *
 * A class extending the main API class \Kenashkov\BillyDk\BillyDk is needed in order to store safely the api_token.
 * If the main API class is used directly in the registry/dev.php in DI dependencies section
 * the API token will be exposed.
 * While if it is in a separate class this class can have its config in the ENV of in registry/local.php
 * which is not committed to Git.
 *
 * The BaseInterface and BaseTrait provide the class with all the functionality otherwise provided by the Base class.
 */
class BillyDk extends \Kenashkov\BillyDk\BillyDk implements BaseInterface
{

    use BaseTrait;

    protected const CONFIG_DEFAULTS = [
        'api_token'     => '',
    ];

    protected const CONFIG_RUNTIME = [];

    /**
     * BillyDk constructor.
     * Provides the api_token from the config of the class to the parent class.
     * @param string $api_url
     * @throws RunTimeException
     * @throws \Azonmedia\Exceptions\InvalidArgumentException
     * @throws \Guzaba2\Coroutine\Exceptions\ContextDestroyedException
     * @throws \ReflectionException
     */
    public function __construct(string $api_url = self::API_URL)
    {
        if (!self::CONFIG_RUNTIME['api_token']) {
            throw new RunTimeException(sprintf(t::_('The api_token is not set in the configuration.')));
        }
        parent::__construct(self::CONFIG_RUNTIME['api_token'], $api_url);
    }

}