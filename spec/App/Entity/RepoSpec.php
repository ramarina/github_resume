<?php

namespace spec\App\Entity;

use App\Entity\Repo;
use App\Entity\Resume;
use PhpSpec\ObjectBehavior;

class RepoSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Repo::class);
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

    function it_sets_link()
    {
        $this->setLink('www.google.com');
        $this->getLink()->shouldReturn('www.google.com');
    }

    function it_sets_description()
    {
        $this->setDescription('desc');
        $this->getDescription()->shouldReturn('desc');
    }

    function it_sets_resume()
    {
        $resume = new Resume();
        $this->setResume($resume);
        $this->getResume()->shouldBeAnInstanceOf(Resume::class);
    }
}
