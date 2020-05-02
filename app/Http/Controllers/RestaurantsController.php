<?php

namespace App\Http\Controllers;
use App\Http\Requests\RestaurantRequest;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = \App\Restaurant::all();
        return response() ->json([
            'restaurants' => $restaurants
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantRequest $request)
    { 
            $restaurant = new Restaurant();
            $restaurant->restaurantName = request("restaurantName");
            $restaurant->address = request("address");
            $restaurant->phone = request("phone");
            $restaurant->deal = request("deal");
            $restaurant->image = request("image");
            
            $restaurant->save();

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
        $request -> validate([
            'restaurantName' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'deal' => 'required',
            'image' => 'required',
        ]);

        $restaurant = $request->restaurants()->whereId($id)->update($request->all());
        return response([
            'restaurant' => $restaurant,
            'message' => 'Restaurant has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return response()->json([
            'restaurant' => $restaurant,
            'message' => 'Restaurant has been deleted'
        ]);
    }
}
