<?php

namespace Tests;

use Faker\Factory as Faker;
use App\Models\Shift;
use App\Repositories\ShiftRepository;

trait MakeShiftTrait
{
    /**
     * Create fake instance of Shift and save it in database
     *
     * @param array $shiftFields
     * @return Shift
     */
    public function makeShift($shiftFields = [])
    {
        /** @var ShiftRepository $shiftRepo */
        $shiftRepo = App::make(ShiftRepository::class);
        $theme = $this->fakeShiftData($shiftFields);
        return $shiftRepo->create($theme);
    }

    /**
     * Get fake instance of Shift
     *
     * @param array $shiftFields
     * @return Shift
     */
    public function fakeShift($shiftFields = [])
    {
        return new Shift($this->fakeShiftData($shiftFields));
    }

    /**
     * Get fake data of Shift
     *
     * @param array $postFields
     * @return array
     */
    public function fakeShiftData($shiftFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $shiftFields);
    }
}
