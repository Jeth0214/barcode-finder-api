<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Transfer;
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
        $items = Item::where('lot', 'LIKE', '%' . $request->lot . '%')->get();
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
             $transfer = Transfer::with('items')->where('id', 'LIKE', '%' . $item->transfer_id . '%')->get();
            array_push($transfers, $transfer);
        }

        return response( [
            'status' => 'success',
            'message' => 'ok',
            'data' => $transfers
        ], 200);
    }
}
