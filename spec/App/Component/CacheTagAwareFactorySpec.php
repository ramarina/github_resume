<?php

namespace spec\App\Component;

use App\Component\CacheTagAwareFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Prophet;
use Symfony\Component\Cache\Adapter\TagAwareAdapterInterface;
use Symfony\Component\Cache\Adapter\TraceableAdapter;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CacheTagAwareFactorySpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $prophet = new Prophet();
        $cacheApp = $prophet->prophesize(TraceableAdapter::class);

        $container->get('cache.app')->willReturn($cacheApp);
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CacheTagAwareFactory::class);
    }

    function it_should_create_tag_aware_adapter()
    {
        $this->create()->shouldBeAnInstanceOf(TagAwareAdapterInterface::class);
    }
}
