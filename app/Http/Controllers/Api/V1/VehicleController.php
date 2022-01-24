<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends BaseController
{
    /**
     * Holen Sie sich alle Fahrzeuge
     *
     * Dadurch werden alle Fahrzeugdaten aus der Datenbank ausgewählt und abgerufen
     * @header Authorization Bearer <token>
     * @header Content-Type application/json
     * @authenticated
     * @response 200{{
     * "success": true,
     * "message": "Abgeholte Fahrzeuge",
     * "code": 200,
     * "data": [
     * {
     * "id": 2,
     * "herstellerin": "27575",
     * "modell": "28588",
     * "fin": "45678d",
     * "erste_registrierung": "0222-01-20",
     * "kilometerstand": 654564,
     * "erstellt_am": "2022-01-20T09:44:16.000000Z",
     * "aktualisiert_am": "2022-01-20T10:03:33.000000Z"
     * },
     * {
     * "id": 3,
     * "herstellerin": "Toyota",
     * "modell": "285TC",
     * "fin": "96876",
     * "erste_registrierung": "1997-01-20",
     * "kilometerstand": 40,
     * "erstellt_am": "2022-01-20T09:44:32.000000Z",
     * "aktualisiert_am": "2022-01-20T09:44:32.000000Z"
     * },
     * {
     * "id": 4,
     * "herstellerin": "BMW",
     * "modell": "BM54",
     * "fin": "78654F",
     * "erste_registrierung": "1997-01-20",
     * "kilometerstand": 140,
     * "erstellt_am": "2022-01-20T09:44:55.000000Z",
     * "aktualisiert_am": "2022-01-20T09:44:55.000000Z"
     * },
     * {
     * "id": 5,
     * "herstellerin": "BMW",
     * "modell": "BM754",
     * "fin": "23456B",
     * "erste_registrierung": "2022-01-20",
     * "kilometerstand": 180,
     * "erstellt_am": "2022-01-20T09:45:18.000000Z",
     * "aktualisiert_am": "2022-01-20T09:45:18.000000Z"
     * },
     * {
     * "id": 6,
     * "herstellerin": "Audi",
     * "modell": "AUD78541",
     * "fin": "854694",
     * "erste_registrierung": "2022-01-20",
     * "kilometerstand": 180,
     * "erstellt_am": "2022-01-20T09:45:32.000000Z",
     * "aktualisiert_am": "2022-01-20T09:45:32.000000Z"
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
            return $this->sendResponse($vehicles, 'Abgeholte Fahrzeuge');
        }
    }

    /**
     * Neues Fahrzeug hinzufügen
     *
     * Dadurch wird der Datenbank ein neues Fahrzeug hinzugefügt
     * @bodyParam herstellerin string required Name der Herstellerin. Example: Toyota
     * @bodyParam modell string required modell Nummer des Fahrzeugs. Example: 74CUG
     * @bodyParam fin string required Identifikationsnummer des Fahrzeugs. Example: 754454
     * @bodyParam erste_registrierung date Das Datumsformat sollte JJJJ-MM-TT sein Example: 2020-12-12
     * @bodyParam kilometerstand int Wie viele Fahrzeuge sind gefahren. Example: 40
     * @header Authorization Bearer <token>
     * @header Content-Type application/json
     * @authenticated
     * @response {
     *  "success": true,
     *  "message": "Fahrzeugadresse erfolgreich hinzugefügt",
     *  "code": 201,
     *  "data": []
     *  }
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'herstellerin' => 'required',
            'modell' => 'required|unique:vehicles',
            'fin' => 'required|unique:vehicles',
            'erste_registrierung' => 'sometimes',
            'kilometerstand' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Datenüberprüfungsfehler', $validator->errors(), 210);
        }


        $data = $validator->validated();
        $data['erstellt_am'] = Carbon::now();
        $data['aktualisiert_am'] = Carbon::now();
        if (Vehicle::create($data)) {
            return $this->sendResponse([], 'Fahrzeugadresse erfolgreich hinzugefügt', 201);
        } else {
            return $this->sendError([], 'Fehler beim Einfügen');
        }
    }

    /**
     * Einzelfahrzeug anzeigen
     *
     * Dies zeigt ein einzelnes Fahrzeug
     * @urlParam id int required Es wird die ID des Fahrzeugs in der Datenbank sein. Example: 1
     * @header Authorization Bearer <token>
     * @header Content-Type application/json
     * @authenticated
     * @response 200 {
     * "success": true,
     * "message": "Fahrzeug abgeholt",
     * "code": 200,
     * "data": {
     * "id": 2,
     * "herstellerin": "27575",
     * "modell": "28588",
     * "fin": "45678d",
     * "erste_registrierung": "0222-01-20",
     */
    public function view(Request $request, $id)
    {

        try {
            $vehicle = Vehicle::where([
                'id' => $id,
            ])->first();
            return $this->sendResponse($vehicle, 'Fahrzeug abgeholt', 200);
        } catch (QueryException $e) {

            return $this->sendError([], 'Fehler beim Aktualisieren' . $e->getMessage(), 400);
        }


    }

    /**
     * Fahrzeug bearbeiten
     *
     * Dadurch werden Fahrzeugdaten bearbeitet
     * @urlParam id int required Es wird die ID des Fahrzeugs in der Datenbank sein. Example: 1
     * @bodyParam herstellerin string required Name der Herstellerin. Example: Toyota
     * @bodyParam modell string required modell Nummer des Fahrzeugs. Example: 74CUG
     * @bodyParam fin string required Identifikationsnummer des Fahrzeugs. Example: 754454
     * @bodyParam erste_registrierung date Das Datumsformat sollte JJJJ-MM-TT sein Example: 2020-12-12
     * @bodyParam kilometerstand int Wie viele Fahrzeuge sind gefahren. Example: 40
     * @header Authorization Bearer <token>
     * @header Content-Type application/json
     * @authenticated
     * @response {
     * "success": true,
     * "message": "Fahrzeug erfolgreich aktualisiert",
     * "code": 200,
     * "data": []
     * }
     */
    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'herstellerin' => 'required',
            'modell' => 'required|unique:users,modell,' . $id,
            'fin' => 'required|unique:users,fin,' . $id,
            'erste_registrierung' => 'sometimes',
            'kilometerstand' => 'sometimes',
        ]);

        try {
            $data = $request->all();
            $data['aktualisiert_am'] = Carbon::now();
            Vehicle::where([
                'id' => $id,
            ])->update($data);
            return $this->sendResponse([], 'Fahrzeug erfolgreich aktualisiert', 200);
        } catch (QueryException $e) {

            return $this->sendError([], 'Fehler beim Aktualisieren' . $e->getMessage(), 400);
        }


    }

    /**
     * Fahrzeug löschen
     *
     * Dadurch werden Daten aus der Datenbank gelöscht
     * @urlParam id int required Es wird die ID des Fahrzeugs in der Datenbank sein. Example: 1
     * @header Authorization Bearer <token>
     * @header Content-Type application/json
     * @authenticated
     * @response {
     * "success": true,
     * "message": "Fahrzeug erfolgreich gelöscht",
     * "code": 200,
     * "data": []
     * }
     */
    public function delete(Request $request, $id)
    {
        Vehicle::where([
            'id' => $id,
        ])->update([
            'ist_gelöscht' => 1
        ]);

        return $this->sendResponse([], 'Fahrzeug erfolgreich gelöscht');

    }
}
