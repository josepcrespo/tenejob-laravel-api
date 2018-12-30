<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMatchingAPIRequest;
use App\Http\Requests\API\UpdateMatchingAPIRequest;
use App\Models\Matching;
use App\Repositories\MatchingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MatchingController
 * @package App\Http\Controllers\API
 */

class MatchingAPIController extends AppBaseController
{
    /** @var  MatchingRepository */
    private $matchingRepository;

    public function __construct(MatchingRepository $matchingRepo)
    {
        $this->matchingRepository = $matchingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/matchings",
     *      summary="Get a listing of the Matchings.",
     *      tags={"Matching"},
     *      description="Get all Matchings",
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
     *                  @SWG\Items(ref="#/definitions/Matching")
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
        $this->matchingRepository->pushCriteria(new RequestCriteria($request));
        $this->matchingRepository->pushCriteria(new LimitOffsetCriteria($request));
        $matchings = $this->matchingRepository->with(['shift.days', 'worker.days'])->all();

        return $this->sendResponse($matchings->toArray(), 'Matchings retrieved successfully');
    }

    /**
     * @param CreateMatchingAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/matchings",
     *      summary="Store a newly created Matching in storage",
     *      tags={"Matching"},
     *      description="Store Matching",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Matching that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Matching")
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
     *                  ref="#/definitions/Matching"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMatchingAPIRequest $request)
    {
        $input = $request->all();

        $matchings = $this->matchingRepository->create($input);

        return $this->sendResponse($matchings->toArray(), 'Matching saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/matchings/{id}",
     *      summary="Display the specified Matching",
     *      tags={"Matching"},
     *      description="Get Matching",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Matching",
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
     *                  ref="#/definitions/Matching"
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
        /** @var Matching $matching */
        $matching = $this->matchingRepository->with(['shift.days', 'worker.days'])->findWithoutFail($id);

        if (empty($matching)) {
            return $this->sendError('Matching not found');
        }

        return $this->sendResponse($matching->toArray(), 'Matching retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMatchingAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/matchings/{id}",
     *      summary="Update the specified Matching in storage",
     *      tags={"Matching"},
     *      description="Update Matching",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Matching",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Matching that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Matching")
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
     *                  ref="#/definitions/Matching"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMatchingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Matching $matching */
        $matching = $this->matchingRepository->findWithoutFail($id);

        if (empty($matching)) {
            return $this->sendError('Matching not found');
        }

        $matching = $this->matchingRepository->update($input, $id);

        return $this->sendResponse($matching->toArray(), 'Matching updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/matchings/{id}",
     *      summary="Remove the specified Matching from storage",
     *      tags={"Matching"},
     *      description="Delete Matching",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Matching",
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
        /** @var Matching $matching */
        $matching = $this->matchingRepository->findWithoutFail($id);

        if (empty($matching)) {
            return $this->sendError('Matching not found');
        }

        $matching->delete();

        return $this->sendResponse($id, 'Matching deleted successfully');
    }
}
