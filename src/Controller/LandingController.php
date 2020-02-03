<?php

namespace App\Controller;

use App\Entity\Resume;
use App\Form\ResumeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class LandingController
 */
class LandingController extends AbstractController
{

    /**
     * Displays a form to retrieve a new Resume entity.
     *
     * @Route("/", name="landing_page", methods={"GET"})
     * @Template("landing_page.html.twig")
     *
     * @return array
     *
     */
    public function landingForm()
    {
        $form = $this->createForm(ResumeType::class, new Resume(), ['action' => 'resume', 'method' => 'POST']);

        return ['form' => $form->createView()];
    }

}
