<?php

namespace spec\App\Controller;

use App\Controller\LandingController;
use PhpSpec\ObjectBehavior;

class LandingControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LandingController::class);
    }
}
