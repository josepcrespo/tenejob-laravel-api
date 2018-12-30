<?php

namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MatchingApiTest extends TestCase
{
    use MakeMatchingTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMatching()
    {
        $matching = $this->fakeMatchingData();
        $this->json('POST', '/api/v1/matchings', $matching);

        $this->assertApiResponse($matching);
    }

    /**
     * @test
     */
    public function testReadMatching()
    {
        $matching = $this->makeMatching();
        $this->json('GET', '/api/v1/matchings/'.$matching->id);

        $this->assertApiResponse($matching->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMatching()
    {
        $matching = $this->makeMatching();
        $editedMatching = $this->fakeMatchingData();

        $this->json('PUT', '/api/v1/matchings/'.$matching->id, $editedMatching);

        $this->assertApiResponse($editedMatching);
    }

    /**
     * @test
     */
    public function testDeleteMatching()
    {
        $matching = $this->makeMatching();
        $this->json('DELETE', '/api/v1/matchings/'.$matching->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/matchings/'.$matching->id);

        $this->assertResponseStatus(404);
    }
}
