<?php

namespace Tests;

use Faker\Factory as Faker;
use App\Models\Day;
use App\Repositories\DayRepository;
use Illuminate\Support\Facades\App;

trait MakeDayTrait
{
    /**
     * Create fake instance of Day and save it in database
     *
     * @param array $dayFields
     * @return Day
     */
    public function makeDay($dayFields = [])
    {
        /** @var DayRepository $dayRepo */
        $dayRepo = App::make(DayRepository::class);
        $theme = $this->fakeDayData($dayFields);
        return $dayRepo->create($theme);
    }

    /**
     * Get fake instance of Day
     *
     * @param array $dayFields
     * @return Day
     */
    public function fakeDay($dayFields = [])
    {
        return new Day($this->fakeDayData($dayFields));
    }

    /**
     * Get fake data of Day
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDayData($dayFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'name' => $fake->randomElement(['Monday:Monday', 'Tuesday:Tuesday', 'Wednesday:Wednesday', 'Thursday:Thursday', 'Friday:Friday', 'Saturday:Saturday', 'Sunday:Sunday'])
        ], $dayFields);
    }
}
