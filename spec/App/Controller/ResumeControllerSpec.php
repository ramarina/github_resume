<?php

namespace spec\App\Controller;

use App\Controller\ResumeController;
use PhpSpec\ObjectBehavior;

class ResumeControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ResumeController::class);
    }
}
