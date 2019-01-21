<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Day;
use App\Repositories\WorkerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class WorkerController extends AppBaseController
{
    /** @var  WorkerRepository */
    private $workerRepository;

    public function __construct(WorkerRepository $workerRepo)
    {
        $this->workerRepository = $workerRepo;
    }

    /**
     * Display a listing of the Worker.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->workerRepository->pushCriteria(new RequestCriteria($request));
        $workers = $this->workerRepository->all();

        return view('workers.index')
            ->with('workers', $workers);
    }

    /**
     * Show the form for creating a new Worker.
     *
     * @return Response
     */
    public function create()
    {
        $relations = array();
        $relations['days'] = Day::all()->pluck('name', 'id');

        return view('workers.create')
            ->with('relations', $relations);
    }

    /**
     * Store a newly created Worker in storage.
     *
     * @param CreateWorkerRequest $request
     *
     * @return Response
     */
    public function store(CreateWorkerRequest $request)
    {
        $input = $request->all();

        $worker = $this->workerRepository->create($input);

        Flash::success('Worker saved successfully.');

        return redirect(route('workers.index'));
    }

    /**
     * Display the specified Worker.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $worker = $this->workerRepository->findWithoutFail($id);

        if (empty($worker)) {
            Flash::error('Worker not found');

            return redirect(route('workers.index'));
        }

        return view('workers.show')->with('worker', $worker);
    }

    /**
     * Show the form for editing the specified Worker.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $worker            = $this->workerRepository->findWithoutFail($id);
        $relations         = array();
        $relations['days'] = Day::all()->pluck('name', 'id');

        if (empty($worker)) {
            Flash::error('Worker not found');

            return redirect(route('workers.index'));
        }

        return view('workers.edit')
            ->with('worker', $worker)
            ->with('relations', $relations);
    }

    /**
     * Update the specified Worker in storage.
     *
     * @param  int              $id
     * @param UpdateWorkerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWorkerRequest $request)
    {
        $worker = $this->workerRepository->findWithoutFail($id);

        if (empty($worker)) {
            Flash::error('Worker not found');

            return redirect(route('workers.index'));
        }

        $worker = $this->workerRepository->update($request->all(), $id);

        Flash::success('Worker updated successfully.');

        return redirect(route('workers.index'));
    }

    /**
     * Remove the specified Worker from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $worker = $this->workerRepository->findWithoutFail($id);

        if (empty($worker)) {
            Flash::error('Worker not found');

            return redirect(route('workers.index'));
        }

        $this->workerRepository->delete($id);

        Flash::success('Worker deleted successfully.');

        return redirect(route('workers.index'));
    }

    /**
     * Initialize the `worker` table.
     */
    public function truncateTable() {
        Worker::truncate();

        Flash::success('The table for the `Workers` has been reset successfully.');

        return redirect(route('workers.index'));
    }
}
