<?php

use App\Models\Shift;
use App\Repositories\ShiftRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShiftRepositoryTest extends TestCase
{
    use MakeShiftTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ShiftRepository
     */
    protected $shiftRepo;

    public function setUp()
    {
        parent::setUp();
        $this->shiftRepo = App::make(ShiftRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateShift()
    {
        $shift = $this->fakeShiftData();
        $createdShift = $this->shiftRepo->create($shift);
        $createdShift = $createdShift->toArray();
        $this->assertArrayHasKey('id', $createdShift);
        $this->assertNotNull($createdShift['id'], 'Created Shift must have id specified');
        $this->assertNotNull(Shift::find($createdShift['id']), 'Shift with given id must be in DB');
        $this->assertModelData($shift, $createdShift);
    }

    /**
     * @test read
     */
    public function testReadShift()
    {
        $shift = $this->makeShift();
        $dbShift = $this->shiftRepo->find($shift->id);
        $dbShift = $dbShift->toArray();
        $this->assertModelData($shift->toArray(), $dbShift);
    }

    /**
     * @test update
     */
    public function testUpdateShift()
    {
        $shift = $this->makeShift();
        $fakeShift = $this->fakeShiftData();
        $updatedShift = $this->shiftRepo->update($fakeShift, $shift->id);
        $this->assertModelData($fakeShift, $updatedShift->toArray());
        $dbShift = $this->shiftRepo->find($shift->id);
        $this->assertModelData($fakeShift, $dbShift->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteShift()
    {
        $shift = $this->makeShift();
        $resp = $this->shiftRepo->delete($shift->id);
        $this->assertTrue($resp);
        $this->assertNull(Shift::find($shift->id), 'Shift should not exist in DB');
    }
}
