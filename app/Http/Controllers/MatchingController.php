<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMatchingRequest;
use App\Http\Requests\UpdateMatchingRequest;
use App\Models\Matching;
use App\Models\Shift;
use App\Models\Worker;
use App\Repositories\MatchingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MatchingController extends AppBaseController
{
    /** @var  MatchingRepository */
    private $matchingRepository;

    public function __construct(MatchingRepository $matchingRepo)
    {
        $this->matchingRepository = $matchingRepo;
    }

    /**
     * Display a listing of the Matching.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->matchingRepository->pushCriteria(new RequestCriteria($request));
        $matchings = $this->matchingRepository->all();

        return view('matchings.index')
            ->with('matchings', $matchings);
    }

    /**
     * Show the form for creating a new Matching.
     *
     * @return Response
     */
    public function create()
    {
        $relations = array();
        $relations['shifts'] = Shift::all()->pluck('id', 'id');
        $relations['workers'] = Worker::all()->pluck('id', 'id');

        return view('matchings.create')
            ->with('relations', $relations);
    }

    /**
     * Store a newly created Matching in storage.
     *
     * @param CreateMatchingRequest $request
     *
     * @return Response
     */
    public function store(CreateMatchingRequest $request)
    {
        $input = $request->all();

        $matching = $this->matchingRepository->create($input);

        Flash::success('Matching saved successfully.');

        return redirect(route('matchings.index'));
    }

    /**
     * Display the specified Matching.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $matching = $this->matchingRepository->findWithoutFail($id);

        if (empty($matching)) {
            Flash::error('Matching not found');

            return redirect(route('matchings.index'));
        }

        return view('matchings.show')->with('matching', $matching);
    }

    /**
     * Show the form for editing the specified Matching.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $matching            = $this->matchingRepository->findWithoutFail($id);
        $relations           = array();
        $relations['shifts'] = Shift::all()->pluck('id', 'id');
        $relations['workers'] = Worker::all()->pluck('id', 'id');

        if (empty($matching)) {
            Flash::error('Matching not found');

            return redirect(route('matchings.index'));
        }

        //dump($matching);die();

        return view('matchings.edit')
            ->with('matching', $matching)
            ->with('relations', $relations);
    }

    /**
     * Update the specified Matching in storage.
     *
     * @param  int              $id
     * @param UpdateMatchingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMatchingRequest $request)
    {
        $matching = $this->matchingRepository->findWithoutFail($id);

        if (empty($matching)) {
            Flash::error('Matching not found');

            return redirect(route('matchings.index'));
        }

        $matching = $this->matchingRepository->update($request->all(), $id);

        Flash::success('Matching updated successfully.');

        return redirect(route('matchings.index'));
    }

    /**
     * Remove the specified Matching from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $matching = $this->matchingRepository->findWithoutFail($id);

        if (empty($matching)) {
            Flash::error('Matching not found');

            return redirect(route('matchings.index'));
        }

        $this->matchingRepository->delete($id);

        Flash::success('Matching deleted successfully.');

        return redirect(route('matchings.index'));
    }

    /**
     * Initialize the `matchings` table.
     */
    public function truncateTable() {
        Matching::truncate();

        Flash::success('The table for the `Matchings` has been reset successfully.');

        return redirect(route('matchings.index'));
    }
}
