<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
     /**
     * search for  resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search( Request $request)
    {
        $items = Item::with('transfer')->where('lot', 'LIKE', '%' . $request->lot . '%')->get();
        if($items->isEmpty()) {
            $data = [
                'status' => 'danger',
                'message' => 'No results found.',
                'data' => []
            ];
            return response($data, 404);
        };

        $transfers = array();

        foreach( $items as $item ) {
            array_push($transfers, $item->transfer);
        }

        return response( [
            'status' => 'success',
            'message' => 'ok',
            'data' => $transfers
        ], 200);
    }
}
