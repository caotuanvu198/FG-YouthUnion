<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Repositories\LCDoanHoatDongRepository;
use App\Http\Requests\LCDoanHoatDongStoreRequest;
use App\Http\Requests\LCDoanHoatDongUpdateRequest;

class LCDoanHoatDongController extends Controller
{
    /**
     * The repository instance.
     *
     * @var ObjectRepository
     */
    protected $respository;


    /**
     * Create a new controller instance.
     *
     * @param  ObjectRepository  $objects
     * @return void
     */
    public function __construct(LCDoanHoatDongRepository $respository)
    {
        $this->respository = $respository;
    }

    /**
     * Get all of the objects for a given model.
     *
     * @return Collection
     */
    public function index()
    {
        $entries = Input::has('entries') ? Input::get('entries') : 10;
        if (Input::has('searchText'))
            return  $this->respository->collectionSearch($entries, Input::get('searchText'));
        return $this->respository->collection($entries);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->respository->show($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LCDoanHoatDongStoreRequest $request)
    {
        $request->validated();
        return $this->respository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  $request | $id
     * @return \Illuminate\Http\Response
     */
    public function update(LCDoanHoatDongUpdateRequest $request, $id)
    {
        $request->validated();
        return $this->respository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->respository->destroy($id);
    }
}
