<?php

/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace BjyAuthorize\Service;

use BjyAuthorize\Provider\Identity\ZfcUserSimple;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Simple identity provider factory
 *
 * @author Ingo Walz <ingo.walz@googlemail.com>
 */
class ZfcUserSimpleServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $user = $serviceLocator->get('zfcuser_user_service');
        $simpleIdentityProvider = new ZfcUserSimple($user->getAuthService());
        $config = $serviceLocator->get('Config');
        $simpleIdentityProvider->setDefaultRole($config['bjyauthorize']['default_role']);
        $simpleIdentityProvider->setAuthenticatedRole($config['bjyauthorize']['authenticated_role']);

        return $simpleIdentityProvider;
    }
}
