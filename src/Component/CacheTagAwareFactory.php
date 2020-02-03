<?php

namespace App\Component;

use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapterInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class CacheTagAwareFactory
 */
class CacheTagAwareFactory
{
    use ContainerAwareTrait;

    /**
     * @return TagAwareAdapterInterface
     *
     */
    public function create()
    {
        return new TagAwareAdapter($this->container->get('cache.app'));
    }
}
