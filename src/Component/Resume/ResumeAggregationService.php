<?php

namespace App\Component\Resume;

use App\Entity\Language;
use App\Entity\Repo;
use App\Entity\Resume;
use Doctrine\Common\Collections\Collection;

/**
 * Class ResumeAggregationService
 */
class ResumeAggregationService
{
    /**
     * Percentages of programming languages for the account (Aggregated by primary language of
     * the repository in ratio to the size of the repository)
     *
     * @param Resume $resume
     */
    public function setLanguageStats(Resume &$resume): void
    {
        $primaryLanguages = [];
        $allRepoSizes = 0;
        foreach ($resume->getRepo() as $repo) {
            $primary = $this->getPrimaryRepoLanguage($repo);
            if (!$primary) {
                continue;
            }
            $primaryLanguages[] = $primary;
            $allRepoSizes += $this->getSumAllLangBytes($repo->getLanguages());
        }
        $primaryCombLanguages = $this->getPrimaryCombinedLanguage($primaryLanguages);
        $this->addPercentage($primaryCombLanguages, $allRepoSizes);
        array_multisort(array_column($primaryCombLanguages, "percent"), SORT_DESC, $primaryCombLanguages);
        $resume->setLanguageStats($primaryCombLanguages);
    }

    /**
     * Get repo language with maximum bytes size
     *
     * @param Repo $repo
     * @return array
     */
    private function getPrimaryRepoLanguage(Repo $repo)
    {
        /** @var Language $primary */
        $primary = null;

        foreach ($repo->getLanguages() as $language) {
            /** @var Language $language */
            if ((isset($primary) && $primary->getBytes() < $language->getBytes())
                || !isset($primary)) {
                $primary = $language;
            }
        }
        if ($primary) {
            return [
                'name' => $primary->getName(),
                'bytes' => $primary->getBytes(),
            ];
        }

        return [];
    }

    /**
     * Sum all language bytes that have the same name
     *
     * @param array $primaryLanguages
     * @return array|mixed
     */
    private function getPrimaryCombinedLanguage(array $primaryLanguages)
    {
        $totals = [];
        foreach ($primaryLanguages as $row) {
            $lang = $row['name'];
            $bytes = $row['bytes'];
            if (!isset($totals[$lang])) {
                $totals[$lang] = 0;
            }
            $totals[$lang] += $bytes;
        }

        $temp = array();
        foreach ($totals as $lang => $bytes) {
            $temp[] = array('name' => $lang, 'bytes' => $bytes);
        }

        return $temp;
    }

    /**
     * @param array $primaryLanguages
     * @param int   $allRepoSizes
     */
    private function addPercentage(array &$primaryLanguages, int $allRepoSizes)
    {
        foreach ($primaryLanguages as $key => $val) {
            $primaryLanguages[$key]['percent'] = round($val['bytes'] / $allRepoSizes * 100, 2);
        }
    }

    /**
     * Get size of the repository, by SUM all language bytes
     *
     * @param Collection $languages
     * @return int
     */
    private function getSumAllLangBytes(Collection $languages)
    {
        $total = 0;
        foreach ($languages as $lang) {
            $total += $lang->getBytes();
        }

        return $total;
    }
}