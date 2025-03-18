<?php

use App\Models\StockSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/stock-sub-categories', function(Request $request){
    $company_id = $request->get('company_id');
    if ($company_id == null) {
        # code...
        return response()->json([
            'message' => 'Company Id is required!'
        ], 400);
    }
    $q = $request->get('q');
    $sub_categories = StockSubCategory::where('company_id', $company_id)
    ->where('name', 'like', "%$q%")
    ->orderBy('name', 'asc')
    ->get();

    $data = [];
    foreach ($sub_categories as $key => $value) {
        # code...
        $data[]=[
            'id' => $value->id,
            'text' => $value->name_text
        ];
    }

    return response()->json([
        'data' => $data
    ]);
});
