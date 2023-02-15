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
            'brand' => 'required',
            'barcode' => 'required',
            'gt' => 'required',
            'supplier_id' => 'required',
            'items' => 'required'
        ]);

        if($error->fails()) {
            $data = [
                'status' => 'danger',
                'data' => $error->errors()
            ];
            return response($data, 400);
        };


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
            return response()->json([
                'status' => 'success',
                'data' => $transfer->load('items')
            ], 200);
        }else {
            return response()->json([
                'status' => 'danger',
                'data' => []
            ], 400);
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
        if(!isset($transfer)) {
            return response()->json([
                'status' => 'error',
            ], 404);
        };
        
        return response()->json($transfer->load('items'), 200);
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
        
        $error =  Validator::make( $request->all(), [
            'brand' => 'required',
            'barcode' => 'required',
            'gt' => 'required',
            'supplier_id' => 'required',
            'items' => 'required'
        ]);

        if($error->fails()) {
            $data = [
                'status' => 'danger',
                'data' => $error->errors()
            ];
            return response($data, 400);
        };


        $transfer->update($request->all());
        if(isset($transfer)) {
            foreach($request->items as $item) { 
                Item::where("id", $item)->update([
                'qty' => $item['qty'],
                'lot' => $item['lot'],
              ]);
            };
        };


        if(isset($transfer)) {
            return response()->json([
                'status' => 'success',
                'data' => $transfer->load('items')
            ], 200);
        }else {
            return response()->json([
                'status' => 'danger',
                'data' => []
            ], 400);
        }
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
        $checkTransfer = Transfer::find($transfer->id);
        if(!is_null($checkTransfer)) {
            $data = [
                'status' => 'danger',
            ];

            return response($data, 400);
        }

        return response([
            'status' => 'success',
        ], 200);


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
