<?php

namespace App\Http\Controllers\Rounds;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Round;
use Illuminate\Http\Request;

class RoundsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;


        if (!empty($keyword)) {
            $rounds = Round::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('pol_1_op1', 'LIKE', "%$keyword%")
                ->orWhere('pol_2_op1', 'LIKE', "%$keyword%")
                ->orWhere('pol_3_op1', 'LIKE', "%$keyword%")
                ->orWhere('pol_4_op1', 'LIKE', "%$keyword%")
                ->orWhere('pol_1_op2', 'LIKE', "%$keyword%")
                ->orWhere('pol_2_op2', 'LIKE', "%$keyword%")
                ->orWhere('pol_3_op2', 'LIKE', "%$keyword%")
                ->orWhere('pol_4_op2', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $rounds = Round::paginate($perPage);
        }
        $data = array('rounds' => $rounds, 'hiddemenu' => $this->validateuser(),);
        return view('rounds.rounds.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('rounds.rounds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Round::create($requestData);

        return redirect('rounds/rounds')->with('flash_message', 'Round added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $round = Round::findOrFail($id);
        $data = array('round' => $round, 'hiddemenu' => $this->validateuser(),);
        return view('rounds.rounds.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $round = Round::findOrFail($id);
        $data = array('round' => $round, 'hiddemenu' => $this->validateuser(),);
        return view('rounds.rounds.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $round = Round::findOrFail($id);
        $round->update($requestData);

        return redirect('rounds/rounds')->with('flash_message', 'Round updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Round::destroy($id);

        return redirect('rounds/rounds')->with('flash_message', 'Round deleted!');
    }
}