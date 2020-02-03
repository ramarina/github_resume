<?php

namespace App\Controller;

use App\Component\Resume\ResumeGenerationService;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\TagAwareAdapterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ResumeController
 */
class ResumeController extends AbstractController
{
    private $resumeGenerationService;
    private $tagAwareAdapter;

    /**
     * LandingController constructor.
     * @param ResumeGenerationService  $resumeGenerationService
     * @param TagAwareAdapterInterface $tagAwareAdapter
     */
    public function __construct(
        ResumeGenerationService $resumeGenerationService,
        TagAwareAdapterInterface $tagAwareAdapter
    ) {
        $this->resumeGenerationService = $resumeGenerationService;
        $this->tagAwareAdapter = $tagAwareAdapter;
    }

    /**
     * @Route("/resume", name="resume")
     *
     * @Template("resume_page.html.twig")
     *
     * @param Request $request
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function resume(Request $request)
    {
        try {
            $userName = $request->request->get('resume')['username'];
            if (!$userName) {
                return $this->redirectToRoute('landing_page');
            }
            $resumeDataCache = $this->tagAwareAdapter->getItem("resume_".$userName);

            if (!$resumeDataCache->isHit()) {
                $resume = $this->resumeGenerationService->getResume($userName);
                $resumeDataCache->set($resume);
                $this->tagAwareAdapter->save($resumeDataCache);
            }

            return ['resume' => $resumeDataCache->get()];

        } catch (\Exception $e) {
            //TODO implement logger and add error message to it

            return new JsonResponse(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}