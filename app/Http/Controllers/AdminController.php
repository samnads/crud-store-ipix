<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function home(Request $request)
    {
        return view('admin.home', []);
    }
    public function user_home(Request $request)
    {
        return view('user.home', []);
    }

    public function getStores()
    {
        return DataTables::of(Store::select(['id', 'name', 'location','latitude','longitude'])->orderByDesc('id'))
            ->addIndexColumn()
            ->addColumn('action', function ($store) {
                return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-success" data-id="' . $store->id . '" data-name="' . $store->name . '" data-location="' . $store->location . '" data-latitude="' . $store->latitude . '" data-longitude="' . $store->longitude . '" data-action="show"><i class="bi bi-eye-fill"></i></button>
                            <button type="button" class="btn btn-warning" data-id="' . $store->id . '" data-action="edit"><i class="bi bi-pencil"></i></button>
                            <button type="button" class="btn btn-danger" data-id="' . $store->id . '" data-action="delete"><i class="bi bi-trash"></i></button>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getStoresSorted(Request $request)
    {
        $source = Store::select(['id', 'name', 'location', 'latitude', 'longitude',DB::raw("
        ROUND(
            ( 6371 * acos( cos( radians($request->latitude) ) 
            * cos( radians( latitude ) ) 
            * cos( radians( longitude ) - radians($request->longitude) ) 
            + sin( radians($request->latitude) ) 
            * sin( radians( latitude ) ) ) ),2) AS distance
        ")])->orderBy('distance','asc');
        return DataTables::of($source)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
    public function newStore()
    {
        return view('admin.new-store', []);
    }
    public function editStore(Request $request,$id)
    {
        $data['store'] = Store::findOrFail($id);
        return view('admin.edit-store', $data);
    }
    public function saveStore(Request $request)
    {
        try {
            $validator = Validator::make(
                (array) $request->all(),
                [
                    'name' => 'required|string',
                    'location' => 'required|string',
                    'latitude' => 'required',
                    'longitude' => 'required',
                ],
                [],
                [
                    'name' => 'Store Name',
                    'location' => 'Location',
                    'latitude' => 'Latitude',
                    'longitude' => 'Longitude',
                ]
            );
            if ($validator->fails()) {
                $response = [
                    'status' => false,
                    'error' => [
                        'type' => 'error',
                        'title' => 'Error !',
                        'content' => $validator->errors()->first()
                    ]
                ];
                return response()->json($response, 200, [], JSON_PRETTY_PRINT);
            }
            /***************************************************************************** */
            DB::beginTransaction();
            $store = new Store();
            $store->name = $request->name;
            $store->location = $request->location;
            $store->latitude = $request->latitude;
            $store->longitude = $request->longitude;
            $store->created_by = Auth::guard('admin')->user()->id;
            $store->save();
            DB::commit();
            $response = [
                'status' => true,
                'message' => [
                    'type' => 'success',
                    'title' => 'Saved !',
                    'content' => 'Store saved successfully.'
                ]
            ];
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollback();
            }
            $response = [
                'status' => false,
                'error' => [
                    'type' => 'error',
                    'title' => 'Error !',
                    'content' => $e->getMessage()
                ]
            ];
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        }
    }
    public function updateStore(Request $request)
    {
        try {
            $validator = Validator::make(
                (array) $request->all(),
                [
                    'id' => 'required',
                    'name' => 'required|string',
                    'location' => 'required|string',
                    'latitude' => 'required',
                    'longitude' => 'required',
                ],
                [],
                [
                    'name' => 'Store Name',
                    'location' => 'Location',
                    'latitude' => 'Latitude',
                    'longitude' => 'Longitude',
                ]
            );
            if ($validator->fails()) {
                $response = [
                    'status' => false,
                    'error' => [
                        'type' => 'error',
                        'title' => 'Error !',
                        'content' => $validator->errors()->first()
                    ]
                ];
                return response()->json($response, 200, [], JSON_PRETTY_PRINT);
            }
            /***************************************************************************** */
            DB::beginTransaction();
            $store = Store::findOrFail($request->id);
            $store->name = $request->name;
            $store->location = $request->location;
            $store->latitude = $request->latitude;
            $store->longitude = $request->longitude;
            $store->save();
            DB::commit();
            $response = [
                'status' => true,
                'message' => [
                    'type' => 'success',
                    'title' => 'Updated !',
                    'content' => 'Store updated successfully.'
                ]
            ];
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollback();
            }
            $response = [
                'status' => false,
                'error' => [
                    'type' => 'error',
                    'title' => 'Error !',
                    'content' => $e->getMessage()
                ]
            ];
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        }
    }
    public function deleteStore(Request $request)
    {
        Store::find($request->id)->delete();
        $response = [
            'status' => true,
            'message' => [
                'type' => 'success',
                'title' => 'Deleted !',
                'content' => 'Store deleted successfully.'
            ]
        ];
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }
}
