<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DayApiTest extends TestCase
{
    use MakeDayTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDay()
    {
        $day = $this->fakeDayData();
        $this->json('POST', '/api/v1/days', $day);

        $this->assertApiResponse($day);
    }

    /**
     * @test
     */
    public function testReadDay()
    {
        $day = $this->makeDay();
        $this->json('GET', '/api/v1/days/'.$day->id);

        $this->assertApiResponse($day->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDay()
    {
        $day = $this->makeDay();
        $editedDay = $this->fakeDayData();

        $this->json('PUT', '/api/v1/days/'.$day->id, $editedDay);

        $this->assertApiResponse($editedDay);
    }

    /**
     * @test
     */
    public function testDeleteDay()
    {
        $day = $this->makeDay();
        $this->json('DELETE', '/api/v1/days/'.$day->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/days/'.$day->id);

        $this->assertResponseStatus(404);
    }
}
