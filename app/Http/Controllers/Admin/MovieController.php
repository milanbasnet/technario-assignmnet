<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use App\Http\Controllers\Controller;
use App\Http\Repository\MovieRepository;

class MovieController extends Controller
{
     private $movieRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()
     {
        $this->movieRepository = new MovieRepository;
        
     }

    public function index()
    {
        $movies = $this->movieRepository->getPublishMoviesPaginagte(20);
        return view('backend.movies.index', compact('movies'));
    }

    public function allMovies()
    {
        $movies = $this->movieRepository->getAllMoviesPaginagte(20);
        return view('backend.movies.all-movies', compact('movies'));
    }

    public function userMovies()
    {
        $users = $this->movieRepository->getUserWithMoviesPaginagte(20);
        return view('backend.movies.user-movies', compact('users'));
    }

    public function moviePublish($id)
    {
        try {
            $this->movieRepository->publish($id);
        } catch (\Throwable $th) {
            return back()->with('error_message', $th->getMessage());
        }
        return back()->with('success_message', 'Movie Published Successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        try {
            $this->movieRepository->store($request);
        } catch (\Throwable $th) {
            return back()->with('error_message', $th->getMessage());
        }
        return redirect()->route('movies')->with('success_message', ' Movie stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
