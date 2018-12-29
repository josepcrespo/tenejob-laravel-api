<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateShiftAPIRequest;
use App\Http\Requests\API\UpdateShiftAPIRequest;
use App\Models\Shift;
use App\Repositories\ShiftRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ShiftController
 * @package App\Http\Controllers\API
 */

class ShiftAPIController extends AppBaseController
{
    /** @var  ShiftRepository */
    private $shiftRepository;

    public function __construct(ShiftRepository $shiftRepo)
    {
        $this->shiftRepository = $shiftRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/shifts",
     *      summary="Get a listing of the Shifts.",
     *      tags={"Shift"},
     *      description="Get all Shifts",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Shift")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->shiftRepository->pushCriteria(new RequestCriteria($request));
        $this->shiftRepository->pushCriteria(new LimitOffsetCriteria($request));
        $shifts = $this->shiftRepository->with('days')->all();

        return $this->sendResponse($shifts->toArray(), 'Shifts retrieved successfully');
    }

    /**
     * @param CreateShiftAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/shifts",
     *      summary="Store a newly created Shift in storage",
     *      tags={"Shift"},
     *      description="Store Shift",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Shift that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Shift")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Shift"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateShiftAPIRequest $request)
    {
        $input = $request->all();

        $shifts = $this->shiftRepository->create($input);

        return $this->sendResponse($shifts->toArray(), 'Shift saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/shifts/{id}",
     *      summary="Display the specified Shift",
     *      tags={"Shift"},
     *      description="Get Shift",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Shift",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Shift"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Shift $shift */
        $shift = $this->shiftRepository->with('days')->findWithoutFail($id);

        if (empty($shift)) {
            return $this->sendError('Shift not found');
        }

        return $this->sendResponse($shift->toArray(), 'Shift retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateShiftAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/shifts/{id}",
     *      summary="Update the specified Shift in storage",
     *      tags={"Shift"},
     *      description="Update Shift",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Shift",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Shift that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Shift")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Shift"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateShiftAPIRequest $request)
    {
        $input = $request->all();

        /** @var Shift $shift */
        $shift = $this->shiftRepository->findWithoutFail($id);

        if (empty($shift)) {
            return $this->sendError('Shift not found');
        }

        $shift = $this->shiftRepository->update($input, $id);

        return $this->sendResponse($shift->toArray(), 'Shift updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/shifts/{id}",
     *      summary="Remove the specified Shift from storage",
     *      tags={"Shift"},
     *      description="Delete Shift",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Shift",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Shift $shift */
        $shift = $this->shiftRepository->findWithoutFail($id);

        if (empty($shift)) {
            return $this->sendError('Shift not found');
        }

        $shift->delete();

        return $this->sendResponse($id, 'Shift deleted successfully');
    }
}
