<?php

namespace spec\App\Entity;

use App\Entity\Language;
use App\Entity\Repo;
use PhpSpec\ObjectBehavior;

class LanguageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Language::class);
    }

    function it_gets_id()
    {
        $this->getId()->shouldBeEqualTo(null);
    }

    function it_sets_name()
    {
        $this->setName('Name');
        $this->getName()->shouldReturn('Name');
    }

    function it_sets_bytes()
    {
        $this->setBytes(1);
        $this->getBytes()->shouldReturn(1);
    }

    function it_sets_repo()
    {
        $repo = new Repo();
        $this->setRepo($repo);
        $this->getRepo()->shouldBeAnInstanceOf(Repo::class);
    }
}
