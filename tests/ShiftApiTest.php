<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShiftApiTest extends TestCase
{
    use MakeShiftTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateShift()
    {
        $shift = $this->fakeShiftData();
        $this->json('POST', '/api/v1/shifts', $shift);

        $this->assertApiResponse($shift);
    }

    /**
     * @test
     */
    public function testReadShift()
    {
        $shift = $this->makeShift();
        $this->json('GET', '/api/v1/shifts/'.$shift->id);

        $this->assertApiResponse($shift->toArray());
    }

    /**
     * @test
     */
    public function testUpdateShift()
    {
        $shift = $this->makeShift();
        $editedShift = $this->fakeShiftData();

        $this->json('PUT', '/api/v1/shifts/'.$shift->id, $editedShift);

        $this->assertApiResponse($editedShift);
    }

    /**
     * @test
     */
    public function testDeleteShift()
    {
        $shift = $this->makeShift();
        $this->json('DELETE', '/api/v1/shifts/'.$shift->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/shifts/'.$shift->id);

        $this->assertResponseStatus(404);
    }
}
