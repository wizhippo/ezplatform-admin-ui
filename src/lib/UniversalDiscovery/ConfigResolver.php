<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\EzPlatformAdminUi\UniversalDiscovery;

use eZ\Publish\Core\MVC\ConfigResolverInterface;
use EzSystems\EzPlatformAdminUi\UniversalDiscovery\Event\ConfigResolveEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ConfigResolver
{
    /** @var EventDispatcher */
    protected $eventDispatcher;

    /** @var ConfigResolverInterface */
    protected $configResolver;

    /** @var array */
    protected $udwConfiguration;

    /**
     * @param ConfigResolverInterface $configResolver
     * @param EventDispatcher $eventDispatcher
     * @param array $udwConfiguration
     */
    public function __construct(
        ConfigResolverInterface $configResolver,
        EventDispatcher $eventDispatcher,
        array $udwConfiguration
    ) {
        $this->configResolver = $configResolver;
        $this->eventDispatcher = $eventDispatcher;
        $this->udwConfiguration = $udwConfiguration;
    }

    /**
     * @param string $configName
     * @param array $context
     *
     * @return array
     */
    public function getConfig(string $configName, array $context = []): array
    {
        $config = $this->udwConfiguration[$configName] ?? [];
        $defaults = $this->udwConfiguration['default'] ?? [];

        $config = array_replace_recursive($defaults, $config);

        $configResolveEvent = new ConfigResolveEvent();

        $configResolveEvent->setConfigName($configName);
        $configResolveEvent->setContext($context);
        $configResolveEvent->setConfig($config);

        /** @var ConfigResolveEvent $event */
        $event = $this->eventDispatcher->dispatch(ConfigResolveEvent::NAME, $configResolveEvent);

        return $event->getConfig();
    }
}
