<?php

namespace App\Repositories;

use App\Models\HoatDongType;
use App\Http\Resources\HoatDongTypeResource;

class HoatDongTypeRepository
{
    /**
     * Get all of the objects for a given model.
     *
     * @return Collection
     */
    public function all()
    {
        // Return collection of objects as a resource
        return HoatDongTypeResource::collection(HoatDongType::orderBy('id')->get());
    }

    /**
     * Get all of the objects for a given model.
     *
     * @return Collection
     */
    public function collection($entries, $sort)
    {
        // Return collection of objects as a resource
        return HoatDongTypeResource::collection(HoatDongType::orderBy('id', $sort)->paginate($entries));
    }

    /**
     * Get search of the objects for a given model.
     *
     * @return Collection
     */
    public function collectionSearch($entries, $searchText, $sort)
    {
        $query = HoatDongType::where('id', $searchText)
                     ->orWhere('type', 'LIKE', '%'.$searchText.'%');
        // Return collection of objects as a resource
        return HoatDongTypeResource::collection($query->orderBy('id', $sort)->paginate($entries));
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
        return new HoatDongTypeResource(HoatDongType::findOrFail($id));
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
        return new HoatDongTypeResource(HoatDongType::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $request | $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        $hoatdong_type = HoatDongType::findOrFail($id);
        $hoatdong_type->update($request->only(['type']));
        // Return object
        return new HoatDongTypeResource($hoatdong_type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $hoatdong_type = HoatDongType::findOrFail($id);
      $hoatdong_type->delete();
      return response()->json(null, 204);
    }
}
