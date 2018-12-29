<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDayAPIRequest;
use App\Http\Requests\API\UpdateDayAPIRequest;
use App\Models\Day;
use App\Repositories\DayRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DayController
 * @package App\Http\Controllers\API
 */

class DayAPIController extends AppBaseController
{
    /** @var  DayRepository */
    private $dayRepository;

    public function __construct(DayRepository $dayRepo)
    {
        $this->dayRepository = $dayRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/days",
     *      summary="Get a listing of the Days.",
     *      tags={"Day"},
     *      description="Get all Days",
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
     *                  @SWG\Items(ref="#/definitions/Day")
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
        $this->dayRepository->pushCriteria(new RequestCriteria($request));
        $this->dayRepository->pushCriteria(new LimitOffsetCriteria($request));
        $days = $this->dayRepository->all();

        return $this->sendResponse($days->toArray(), 'Days retrieved successfully');
    }

    /**
     * @param CreateDayAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/days",
     *      summary="Store a newly created Day in storage",
     *      tags={"Day"},
     *      description="Store Day",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Day that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Day")
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
     *                  ref="#/definitions/Day"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDayAPIRequest $request)
    {
        $input = $request->all();

        $days = $this->dayRepository->create($input);

        return $this->sendResponse($days->toArray(), 'Day saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/days/{id}",
     *      summary="Display the specified Day",
     *      tags={"Day"},
     *      description="Get Day",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Day",
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
     *                  ref="#/definitions/Day"
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
        /** @var Day $day */
        $day = $this->dayRepository->findWithoutFail($id);

        if (empty($day)) {
            return $this->sendError('Day not found');
        }

        return $this->sendResponse($day->toArray(), 'Day retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDayAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/days/{id}",
     *      summary="Update the specified Day in storage",
     *      tags={"Day"},
     *      description="Update Day",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Day",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Day that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Day")
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
     *                  ref="#/definitions/Day"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDayAPIRequest $request)
    {
        $input = $request->all();

        /** @var Day $day */
        $day = $this->dayRepository->findWithoutFail($id);

        if (empty($day)) {
            return $this->sendError('Day not found');
        }

        $day = $this->dayRepository->update($input, $id);

        return $this->sendResponse($day->toArray(), 'Day updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/days/{id}",
     *      summary="Remove the specified Day from storage",
     *      tags={"Day"},
     *      description="Delete Day",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Day",
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
        /** @var Day $day */
        $day = $this->dayRepository->findWithoutFail($id);

        if (empty($day)) {
            return $this->sendError('Day not found');
        }

        $day->delete();

        return $this->sendResponse($id, 'Day deleted successfully');
    }
}
