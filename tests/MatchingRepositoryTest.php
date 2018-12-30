<?php

namespace Tests;

use App\Models\Matching;
use App\Repositories\MatchingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MatchingRepositoryTest extends TestCase
{
    use MakeMatchingTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MatchingRepository
     */
    protected $matchingRepo;

    public function setUp()
    {
        parent::setUp();
        $this->matchingRepo = App::make(MatchingRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMatching()
    {
        $matching = $this->fakeMatchingData();
        $createdMatching = $this->matchingRepo->create($matching);
        $createdMatching = $createdMatching->toArray();
        $this->assertArrayHasKey('id', $createdMatching);
        $this->assertNotNull($createdMatching['id'], 'Created Matching must have id specified');
        $this->assertNotNull(Matching::find($createdMatching['id']), 'Matching with given id must be in DB');
        $this->assertModelData($matching, $createdMatching);
    }

    /**
     * @test read
     */
    public function testReadMatching()
    {
        $matching = $this->makeMatching();
        $dbMatching = $this->matchingRepo->find($matching->id);
        $dbMatching = $dbMatching->toArray();
        $this->assertModelData($matching->toArray(), $dbMatching);
    }

    /**
     * @test update
     */
    public function testUpdateMatching()
    {
        $matching = $this->makeMatching();
        $fakeMatching = $this->fakeMatchingData();
        $updatedMatching = $this->matchingRepo->update($fakeMatching, $matching->id);
        $this->assertModelData($fakeMatching, $updatedMatching->toArray());
        $dbMatching = $this->matchingRepo->find($matching->id);
        $this->assertModelData($fakeMatching, $dbMatching->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMatching()
    {
        $matching = $this->makeMatching();
        $resp = $this->matchingRepo->delete($matching->id);
        $this->assertTrue($resp);
        $this->assertNull(Matching::find($matching->id), 'Matching should not exist in DB');
    }
}
