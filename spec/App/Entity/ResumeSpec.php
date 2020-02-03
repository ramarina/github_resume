<?php

namespace spec\App\Entity;

use App\Entity\Resume;
use PhpSpec\ObjectBehavior;

class ResumeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Resume::class);
    }

    function it_gets_id()
    {
        $this->getId()->shouldBeEqualTo(null);
    }

    function it_sets_username()
    {
        $this->setUsername('Name');
        $this->getUsername()->shouldReturn('Name');
    }

    function it_sets_website()
    {
        $this->setWebsite('www.google.com');
        $this->getWebsite()->shouldReturn('www.google.com');
    }

    function it_sets_repos_amount()
    {
        $this->setReposAmount(1);
        $this->getReposAmount()->shouldReturn(1);
    }

    function it_sets_language_stats()
    {
        $this->setLanguageStats([1, 2]);
        $this->getLanguageStats()->shouldReturn([1, 2]);
    }
}
