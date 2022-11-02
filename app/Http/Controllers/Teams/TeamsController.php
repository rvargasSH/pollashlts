<?php

namespace App\Http\Controllers\Teams;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
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
            $teams = Team::where('name', 'LIKE', "%$keyword%")
                ->orWhere('file_flag', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $teams = Team::paginate($perPage);
        }
        $data = array('teams' => $teams, 'hiddemenu' => $this->validateuser(),);
        return view('teams.teams.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('teams.teams.create');
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

        Team::create($requestData);

        return redirect('teams/teams')->with('flash_message', 'Team added!');
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
        $team = Team::findOrFail($id);
        $data = array('team' => $team, 'hiddemenu' => $this->validateuser(),);
        return view('teams.teams.show')->with($data);
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
        $team = Team::findOrFail($id);
        $data = array('team' => $team, 'hiddemenu' => $this->validateuser(),);
        return view('teams.teams.edit')->with($data);
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

        $team = Team::findOrFail($id);
        $team->update($requestData);

        return redirect('teams/teams')->with('flash_message', 'Team updated!');
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
        Team::destroy($id);

        return redirect('teams/teams')->with('flash_message', 'Team deleted!');
    }
}