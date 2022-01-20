<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Vehicle;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends BaseController
{
    /**
     * Get All Vehicles
     *
     * This will select and fetched all vehicles' data from database
     * @header Authorization Bearer <token>
     * @header Content-Type application/json
     * @authenticated
     * @response 200{{
     * "success": true,
     * "message": "Fetched vehicles",
     * "code": 200,
     * "data": [
     * {
     * "id": 2,
     * "manufacturer": "27575",
     * "model": "28588",
     * "vin": "45678d",
     * "first_registration": "0222-01-20",
     * "kilometers_stand": 654564,
     * "created_at": "2022-01-20T09:44:16.000000Z",
     * "updated_at": "2022-01-20T10:03:33.000000Z"
     * },
     * {
     * "id": 3,
     * "manufacturer": "Toyota",
     * "model": "285TC",
     * "vin": "96876",
     * "first_registration": "1997-01-20",
     * "kilometers_stand": 40,
     * "created_at": "2022-01-20T09:44:32.000000Z",
     * "updated_at": "2022-01-20T09:44:32.000000Z"
     * },
     * {
     * "id": 4,
     * "manufacturer": "BMW",
     * "model": "BM54",
     * "vin": "78654F",
     * "first_registration": "1997-01-20",
     * "kilometers_stand": 140,
     * "created_at": "2022-01-20T09:44:55.000000Z",
     * "updated_at": "2022-01-20T09:44:55.000000Z"
     * },
     * {
     * "id": 5,
     * "manufacturer": "BMW",
     * "model": "BM754",
     * "vin": "23456B",
     * "first_registration": "2022-01-20",
     * "kilometers_stand": 180,
     * "created_at": "2022-01-20T09:45:18.000000Z",
     * "updated_at": "2022-01-20T09:45:18.000000Z"
     * },
     * {
     * "id": 6,
     * "manufacturer": "Audi",
     * "model": "AUD78541",
     * "vin": "854694",
     * "first_registration": "2022-01-20",
     * "kilometers_stand": 180,
     * "created_at": "2022-01-20T09:45:32.000000Z",
     * "updated_at": "2022-01-20T09:45:32.000000Z"
     * }
     * ]
     * }
     */
    public function all(Request $request)
    {
        $vehicles = Vehicle::orderBy('id', 'asc')
            ->get();
        if ($vehicles->count() == 0) {
            return $this->sendError('No data found', []);
        } else {
            return $this->sendResponse($vehicles, 'Fetched vehicles');
        }
    }

    /**
     * Add New Vehicle
     *
     * This will add new vehicle to database
     * @bodyParam manufacturer string required Name of manufacturer. Example: Toyota
     * @bodyParam model string required Model number of vehicle. Example: 74CUG
     * @bodyParam vin string required Identification number of vehicle. Example: 754454
     * @bodyParam first_registration date first registration date. Example: 2020-12-12
     * @bodyParam kilometers_stand int How much vehicles can drive. Example: 40
     * @header Authorization Bearer <token>
     * @header Content-Type application/json
     * @authenticated
     * @response {
     *  "success": true,
     *  "message": "Vehicle address successfully added",
     *  "code": 201,
     *  "data": []
     *  }
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'manufacturer' => 'required',
            'model' => 'required|unique:vehicles',
            'vin' => 'required|unique:vehicles',
            'first_registration' => 'sometimes',
            'kilometers_stand' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors(), 210);
        }


        $data = $validator->validated();
        if (Vehicle::create($data)) {
            return $this->sendResponse([], 'Vehicle address successfully added', 201);
        } else {
            return $this->sendError([], 'Failed to insert');
        }
    }

    /**
     * Edit Vehicle
     *
     * This will edit vehicle data
     * @bodyParam manufacturer string required Name of manufacturer. Example: Toyota
     * @bodyParam model string required Model number of vehicle. Example: 74CUG
     * @bodyParam vin string required Identification number of vehicle. Example: 754454
     * @bodyParam first_registration date first registration date. Example: 2020-12-12
     * @bodyParam kilometers_stand int How much vehicles can drive. Example: 40
     * @header Authorization Bearer <token>
     * @header Content-Type application/json
     * @authenticated
     * @response {
     * "success": true,
     * "message": "User address successfully updated",
     * "code": 200,
     * "data": []
     * }
     */
    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'manufacturer' => 'required',
            'model' => 'required|unique:users,model,' . $id,
            'vin' => 'required|unique:users,vin,' . $id,
            'first_registration' => 'sometimes',
            'kilometers_stand' => 'sometimes',
        ]);

        try {
            Vehicle::where([
                'id' => $id,
            ])->update($request->all());
            return $this->sendResponse([], 'User address successfully updated', 200);
        } catch (QueryException $e) {

            return $this->sendError([], 'Failed to update' . $e->getMessage(), 400);
        }


    }

    /**
     * Delete Vehicle
     *
     * This will delete data from database
     * @header Authorization Bearer <token>
     * @header Content-Type application/json
     * @authenticated
     * @response {
     * "success": true,
     * "message": "Vehicle successfully deleted",
     * "code": 200,
     * "data": []
     * }
     */
    public function delete(Request $request, $id)
    {
        Vehicle::where([
            'id' => $id,
        ])->update([
            'is_deleted' => 1
        ]);

        return $this->sendResponse([], 'Vehicle successfully deleted');

    }
}
