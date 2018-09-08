<?php

namespace App\Repositories;

use App\HocKy;
use App\Http\Resources\HocKyResource;

class HocKyRepository
{
    /**
     * Get all of the objects for a given model.
     *
     * @return Collection
     */
    public function collection($entries)
    {
        // Return collection of objects as a resource
        return HocKyResource::collection(HocKy::orderBy('created_at', 'desc')->paginate($entries));
    }

    /**
     * Get search of the objects for a given model.
     *
     * @return Collection
     */
    public function collectionSearch($entries, $searchText)
    {
        $query = HocKy::where('id', $searchText)
                     ->orWhere('hocky', 'LIKE', '%'.$searchText.'%')
                     ->orWhere('namhoc_id', 'LIKE', '%'.$searchText.'%');
        // Return collection of objects as a resource
        return HocKyResource::collection($query->orderBy('created_at', 'desc')->paginate($entries));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Return object
        return new HocKyResource(HocKy::findOrFail($id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        // Return object
        return new HocKyResource(HocKy::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $request | $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        $hocky = HocKy::findOrFail($id);
        $hocky->update($request->only(['hocky', 'namhoc_id']));
        // Return object
        return new HocKyResource($hocky);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $hocky = HocKy::findOrFail($id);
      $hocky->delete();
      return response()->json([
          'meesage' => 'Delete #' . $id . ' successful!'
      ], 200);
    }
}
