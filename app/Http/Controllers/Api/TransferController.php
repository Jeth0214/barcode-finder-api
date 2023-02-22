<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transfers = Transfer::with('items')->get();

        return response()->json($transfers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
        $error =  Validator::make( $request->all(), [
            'branch_id' => 'required',
            'gt' => 'required|min:6',
            'supplier_id' => 'required',
            'items' => 'required'
        ]);

        $transfer = Transfer::create($request->all());
        $allItems = array();
        if(isset($transfer)) {
            foreach($request->items as $item) { 
                $transfer_id = [
                    'transfer_id' => $transfer->id
                ];
                $itemToSave= array_merge($transfer_id, $item);
                $savedItem = Item::create($itemToSave);
            };
        };

        if(isset($savedItem) && isset($transfer)) {
            return response($transfer->load('items'), 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        
        $data = [
            'transfer' => $transfer,
            'branch' => $transfer->branch,
            'items' => $transfer->items
        ];
        return response($transfer ,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {

        $request->validate([
            'branch_id' => 'required',
            'gt' => 'required|min:6',
            'supplier_id' => 'required',
            'items' => 'required'
        ]);


      $transfer->update($request->all());
        if(isset($transfer)) {
            $transfer->items()->delete(); 
            foreach($request->items as $item) { 
                    $transfer->items()->create(['qty'=>$item['qty'], 'lot'=>$item['lot']]);
            };
        };

        return response()->json($transfer->load('items'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        $transfer->delete();

        return response($transfer, 200);


    }

    public function search(Request $request) {
        $transfers = Transfer::with('items')->where('gt', 'LIKE', '%' . $request->gt . '%')->get();
        if($transfers->isEmpty()) {
            $data = [
                'status' => 'danger',
                'message' => 'No results found.',
                'data' => []
            ];
            return response($data, 404);
        };

        return response( [
            'status' => 'success',
            'message' => 'ok',
            'data' => $transfers
        ], 200);
    }
}
