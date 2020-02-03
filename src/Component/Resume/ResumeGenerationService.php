<?php

namespace App\Component\Resume;

use App\Component\Resume\ResumeAggregationService;
use App\Entity\Language;
use App\Entity\Repo;
use App\Entity\Resume;
use Github\Client;

/**
 * Class ResumeGenerationService
 */
class ResumeGenerationService
{
    private $client;
    private $aggregationHelper;

    /**
     * ResumeGenerationService constructor.
     * @param Client                   $client
     * @param ResumeAggregationService $aggregationHelper
     */
    public function __construct(Client $client, ResumeAggregationService $aggregationHelper)
    {
        $this->client = $client;
        $this->aggregationHelper = $aggregationHelper;
    }

    /**
     * @param string $userName
     * @return Resume
     */
    public function getResume(string $userName){
        $resume = new Resume();
        $resume->setUsername($userName);
        $resume->setWebsite($this->client->api('user')->show($userName)['blog']);
        $repos = $this->client->api('user')->repositories($userName);
        foreach ($repos as $rep){
            $repo = new Repo();
            $repo->setName($rep['name']);
            $repo->setLink($rep['html_url']);
            $repo->setDescription($rep['description']);

            $languages = $this->client->api('repo')->languages($userName, $repo->getName());
            foreach (array_keys($languages) as $lang){
                $language = new Language();
                $language->setName($lang);
                $language->setBytes($languages[$lang]);
                $repo->addLanguage($language);
            }
            $resume->addRepo($repo);
        }
        $resume->setReposAmount(count($resume->getRepo()));
        $this->aggregationHelper->setLanguageStats($resume);

        return $resume;
    }

}