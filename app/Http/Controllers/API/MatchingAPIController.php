<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMatchingAPIRequest;
use App\Http\Requests\API\UpdateMatchingAPIRequest;
use App\Models\Matching;
use App\Models\Shift;
use App\Models\Worker;
use App\Repositories\MatchingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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

    /**
     * Checks if the input values of a shift match with the ones into our database.
     *
     * @param array                                      $input
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateShiftValues(
        Array $input,
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        if (isset($input['shifts'])) {
            $errors = [];
            foreach ($input['shifts'] as $shift) {
                if (isset($shift['id']) && isset($shift['day'])) {
                    $shiftObj = Shift::find($shift['id']);
                    if (
                        $shiftObj !== NULL &&
                        $shiftObj->days[0]->name !== $shift['day'][0]
                    ) {
                        $message = 'Shift ID `' . $shiftObj->id .
                            '`: the value provided (' . $shift['day'][0] .
                            ') for the `day` property does not match with the ' .
                            'value stored in our database.';
                        array_push($errors, $message);
                    }
                }
            }
            if (count($errors)) {
                $validator->errors()->add(
                    'shift_values', $errors
                );
            }
        }

        return $validator;
    }

    /**
     * Checks if the input values of a worker match with the ones into our database.
     *
     * @param array                                      $input
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateWorkerValues(
        Array $input,
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        if (isset($input['workers'])) {
            $errors = [];
            foreach ($input['workers'] as $worker) {
                if (isset($worker['id'])) {
                    $workerObj = Worker::find($worker['id']);
                    if ($workerObj !== NULL) {
                        if (
                            isset($worker['payrate']) &&
                            $workerObj->payrate !== $worker['payrate']
                        ) {
                            $message = 'Worker ID `' . $workerObj->id .
                                '`: the value provided (' . $worker['payrate'] .
                                ') for the `payrate` property does not match with the ' .
                                'value stored in our database (' . $workerObj->payrate . ')';
                            array_push($errors, $message);
                        }
                        $workerObjDaysArray = $workerObj->days->pluck('name')->toArray();
                        if (isset($worker['availability'])) {
                            if (count($workerObjDaysArray) < count($worker['availability'])) {
                                $message = 'Worker ID `' . $workerObj->id .
                                    '`: the number of available days provided (' .
                                    count($worker['availability']) .
                                    ') for the `availability` property is greater than ' .
                                    ' the stored available days for this worker in our database (' .
                                    count($workerObjDaysArray) . ')';
                                array_push($errors, $message);
                            } else {
                                $diffResult = array_diff($workerObjDaysArray, $worker['availability']);
                                if (count($diffResult)) {
                                    $message = 'Worker ID `' . $workerObj->id .
                                        '`: the values provided [' .
                                        implode(', ', $worker['availability']) .
                                        '] for the `availability` property does not match with the ' .
                                        'value stored for this worker in our database [' .
                                        implode(', ', $workerObjDaysArray) . ']';
                                    array_push($errors, $message);
                                }
                            }
                        }
                    }
                }
            }
            if (count($errors)) {
                $validator->errors()->add(
                    'shift_values', $errors
                );
            }
        }

        return $validator;
    }

    /**
     * Checks if the shift IDs exists into our database.
     *
     * @param array                                      $input
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateShiftIds(
        Array $input,
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        if (isset($input['shifts'])) {
            $errors = [];
            foreach ($input['shifts'] as $shift) {
                if (isset($shift['id'])) {
                    $shiftObj = Shift::find($shift['id']);
                    if ($shiftObj === NULL) {
                        array_push(
                            $errors,
                            'Shift ID `' . $shift['id'] . '` does not exist in our database.'
                        );
                    }
                }
            }
            if (count($errors)) {
                $validator->errors()->add(
                    'shift_ids', $errors
                );
            }
        }

        return $validator;
    }

    /**
     * Checks if the worker IDs exists into our database.
     *
     * @param array                                      $input
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateWorkerIds(
        Array $input,
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        if (isset($input['workers'])) {
            $errors = [];
            foreach ($input['workers'] as $worker) {
                if (isset($worker['id'])) {
                    $workerObj = Worker::find($worker['id']);
                    if ($workerObj === NULL) {
                        array_push(
                            $errors,
                            'Worker ID `' . $worker['id'] . '` does not exist in our database.'
                        );
                    }
                }
            }
            if (count($errors)) {
                $validator->errors()->add(
                    'worker_ids', $errors
                );
            }
        }

        return $validator;
    }

    /**
     * Validates the `shifts` data sent to the /api/matchings/auto-generate endpoint.
     *
     * @param array                                      $input
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateAutoGenerateInputShifts(
        Array $input,
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        if (isset($input['shifts'])) {
            foreach ($input['shifts'] as $shift) {
                $shiftsValidator = Validator::make($shift, [
                    'id'    => 'bail|required|numeric',
                    'day'   => 'bail|required|array|min:1',
                    'day.*' => 'bail|required|string'
                ]);
                if ($shiftsValidator->fails()) {
                    $validator->errors()->merge(
                        ['shifts' => [$shiftsValidator->errors()]]
                    );
                }
            }
        }

        return $validator;
    }

    /**
     * Validates the `workers` data sent to the /api/matchings/auto-generate endpoint.
     *
     * @link https://stackoverflow.com/a/42258677/2332731
     *
     * @param array                                      $input
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateAutoGenerateInputWorkers(
        Array $input,
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        if (isset($input['workers'])) {
            foreach ($input['workers'] as $worker) {
                $workersValidator = Validator::make($worker, [
                    'id'             => 'bail|required|numeric',
                    'availability'   => 'bail|required|array|min:1',
                    'availability.*' => 'bail|required|string',
                    'payrate'        => 'bail|required|numeric'
                ]);
                if ($workersValidator->fails()) {
                    $validator->errors()->merge(
                        ['workers' => [$workersValidator->errors()]]
                    );
                }
            }
        }

        return $validator;
    }

    /**
     * Validates data sent to the /api/matchings/auto-generate endpoint.
     *
     * @link https://stackoverflow.com/a/42258677/2332731
     *
     * @param array                                      $input
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateAutoGenerateInput(Array $input)
    {
        $validator = Validator::make($input, [
            'shifts'  => 'bail|required|array|min:1',
            'workers' => 'bail|required|array|min:1'
        ]);

        $validator->after(function ($validator) use ($input) {
            $validator = $this->validateAutoGenerateInputShifts($input, $validator);
            $validator = $this->validateAutoGenerateInputWorkers($input, $validator);
        });

        return $validator;
    }

    /**
     * Checks the auto-generated matchings list and,
     * returns an appropriate message depending on the results obtained.
     *
     * @param $numOfInputWorkers
     *
     * @return string
     */
    private function checkMatchingList($numOfInputWorkers)
    {
        $message             = 'We have got an optimal solution. ' .
                               'All workers have at least one matching with a `shift`.';
        $numOfWorkersMatched = DB::table('matchings')
                                ->distinct('worker_id')
                                ->count('worker_id');

        if ($numOfInputWorkers > $numOfWorkersMatched) {
            $message = 'The algorithm was not able to get an optimal solution. ' .
                       'There are some workers without a matching with a `shift`.';
        }

        return $message;
    }

    /**
     * Automatically generates the bests possible matchings
     * using an array of `shifts` and, an array of `workers`.
     *
     * Rules:
     * - A shift can only be matched with one worker.
     * - A worker can only work on one shift during the same day.
     * - A list of matchings is optimal if each worker is paired with at least one shift.
     *
     * @param array $shifts
     * @param array $workers
     * @param bool  $saveFirstOnly
     */
    private function autoMatchings(
        Array $shifts,
        Array $workers,
        bool $saveFirstOnly = TRUE
    ) {
        foreach ($workers as $workerKey => $workerValue) {
            foreach ($shifts as $shiftKey => $shiftValue) {
                $availabilityKey = array_search(
                    $shiftValue['day'][0],
                    $workerValue['availability']
                );
                if (FALSE !== $availabilityKey) {
                    $shiftAlreadySaved = count(Matching::where(
                        'shift_id', '=', $shiftValue['id'])->get()
                    );
                    if ((bool)$shiftAlreadySaved === FALSE) {
                        $newMatching = Matching::create([
                            'shift_id'  => $shiftValue['id'],
                            'worker_id' => $workerValue['id']
                        ]);
                        $newMatching->save();
                        unset($shifts[$shiftKey]);
                        unset($workers[$workerKey]['availability'][$availabilityKey]);
                        if ($saveFirstOnly) {
                            break;
                        }
                    }
                }
            }
        }

    }

    /**
     * Callback function to be used when calling to `usort` inside the
     * sortWorkersByNumOfAvailableDays() method in this class.
     *
     * @param $a
     * @param $b
     *
     * @return int
     */
    private static function compareNumOfAvailableDays($a, $b)
    {
        if (
            count($a['availability']) ==
            count($b['availability'])
        ) {
            return 0;
        }

        return (count($a['availability']) < count($b['availability'])) ? -1 : 1;
    }

    /**
     * Sort (ascending) the workers array, by the number
     * of available days that each worker has.
     *
     * @param array $workers
     *
     * @return array
     */
    private function sortWorkersByNumOfAvailableDays(Array $workers)
    {
        usort($workers, [$this, 'compareNumOfAvailableDays']);

        return $workers;
    }

    /**
     * After passing all validations and, in consequence we should have
     * a valid array of `shifts` and a valid array of `workers`,
     * we try to generate the best possible list of matchings.
     *
     * @param array $input
     *
     * @return string
     */
    private function generateBestPossibleMatchings(Array $input)
    {
        // First, drop all rows of the `matchings` DB table.
        DB::table('matchings')->truncate();

        // Second, sort the array of workers by the number of available days (ascending).
        // This way, we can assign the workers with less available days in the first place.
        $workers = $this->sortWorkersByNumOfAvailableDays($input['workers']);

        // Third, save the total number of workers
        // to check if we did an `optimal` matchings list.
        $numOfInputWorkers = count($workers);

        // Fourth, iterate two times in a double foreach loop.

        // The first iteration loops the worker array,
        // comparing all available days against all shifts,
        // until we get one viable match or,
        // until we had iterated all shifts array.
        $this->autoMatchings($input['shifts'], $workers, TRUE);

        // The second iteration loops the worker array,
        // comparing all available days against all shifts, does not matter
        // if we have a previous match with the same worker or not.
        $this->autoMatchings($input['shifts'], $workers, FALSE);

        return $this->checkMatchingList($numOfInputWorkers);
    }

    /**
     * Generates a new set of `matchings` after receiving input data of `shifts` and `workers`.
     *
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/matchings/auto-generate",
     *      summary="Generates a new set of `matchings` after receiving input data of `shifts` and `workers`",
     *      tags={"Matching"},
     *      description="Drop the current `matchings` and automatically generates new ones.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="A collection of shifts and, a collection of workers",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(property="workers", type="array",  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="id", type="integer", example="1"),
     *                      @SWG\Property(
     *                          property="availability",
     *                          type="array",
     *                          example={"Monday","Wednesday"},
     *                          minItems=1,
     *                          maxItems=7,
     *                          uniqueItems=true,
     *                          @SWG\Items(
     *                              type="string",
     *                              @SWG\Items(type="string", enum="[
     *                                  Monday,
     *                                  Tuesday,
     *                                  Wednesday,
     *                                  Thursday,
     *                                  Friday,
     *                                  Saturday,
     *                                  Sunday
     *                              ]")
     *                          )
     *                      ),
     *                      @SWG\Property(property="payrate", type="number", example="7.50")
     *                  )
     *              ),
     *              @SWG\Property(property="shifts", type="array",  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="id", type="integer", example="1"),
     *                      @SWG\Property(
     *                          property="day",
     *                          type="array",
     *                          example={"Monday"},
     *                          minItems=1,
     *                          maxItems=1,
     *                          uniqueItems=true,
     *                          @SWG\Items(
     *                              type="string"
     *                          )
     *                      )
     *                  )
     *              )
     *          )
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
    public function autoGenerate(Request $request)
    {
        $input = $request->json()->all();

        $validator = $this->validateAutoGenerateInput($input);
        $validator = $this->validateShiftIds($input, $validator);
        $validator = $this->validateShiftValues($input, $validator);
        $validator = $this->validateWorkerIds($input, $validator);
        $validator = $this->validateWorkerValues($input, $validator);

        if (count($validator->errors())) {
            return $this->sendResponse(
                $validator->errors(),
                'Invalid data input.'
            );
        }

        $resultMessage = $this->generateBestPossibleMatchings($input);

        $matchings = $this->matchingRepository->autoGeneratOutput();

        return $this->sendResponse(
            $matchings,
            'Auto-generated matchings. The matchings also have been stored into the DB. ' .
            $resultMessage
        );
    }
}
