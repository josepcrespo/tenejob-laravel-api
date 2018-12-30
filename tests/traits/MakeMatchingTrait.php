<?php

namespace Tests;

use Faker\Factory as Faker;
use App\Models\Matching;
use App\Repositories\MatchingRepository;

trait MakeMatchingTrait
{
    /**
     * Create fake instance of Matching and save it in database
     *
     * @param array $matchingFields
     * @return Matching
     */
    public function makeMatching($matchingFields = [])
    {
        /** @var MatchingRepository $matchingRepo */
        $matchingRepo = App::make(MatchingRepository::class);
        $theme = $this->fakeMatchingData($matchingFields);
        return $matchingRepo->create($theme);
    }

    /**
     * Get fake instance of Matching
     *
     * @param array $matchingFields
     * @return Matching
     */
    public function fakeMatching($matchingFields = [])
    {
        return new Matching($this->fakeMatchingData($matchingFields));
    }

    /**
     * Get fake data of Matching
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMatchingData($matchingFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $matchingFields);
    }
}
