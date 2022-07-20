<?php

namespace App\Http\Repository;

use App\Models\User;
use App\Models\Movie;

class MovieRepository
{
    public function frontAll()
    {
        return Movie::orderBy('created_at', 'desc')->get();
    }
    public function getPublishMoviesPaginagte($paginate)
    {
        return Movie::orderBy('created_at', 'desc')->where('status', 'publish')->paginate($paginate);
    }

    public function getAllMoviesPaginagte($paginate)
    {
        return Movie::orderBy('created_at', 'desc')->paginate($paginate);
    }

    public function getUserWithMoviesPaginagte($paginate)
    {
        return User::with('like_movies')->orderBy('created_at', 'desc')->paginate($paginate);
    }

    public function publish($id)
    {
       $data = Movie::find($id)->update([
            'status' => 'publish'
        ]);
        return $data->update();
    }


    public function store($request)
    {
        $name = $request->poster->getClientOriginalExtension();
        $imagename = time() . '.' . $name;
        $request->poster->move(public_path('poster'), $imagename);

        $store = new Movie();
        $store->title = $request->title;
        $store->description = $request->description;
        $store->release_date = $request->release_date;
        $store->release_date = $request->release_date;
        $store->status = (isset($request->status) ?  $request->status : '')=='on' ? 'publish' : 'unpublish';
        // * $store->brand_image=$lastImage;
        $store->poster = $imagename;
        $store->save();
    }
}
