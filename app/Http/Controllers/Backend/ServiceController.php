<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'services' => Service::with(['service_category'])->orderby('service_name')->get()
        ];

        return view('backend.service.index')->with($data);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = [
            'service_categories' => ServiceCategory::orderby('category_name')->get()
        ];
        return view('backend.service.create')->with($data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'service_name' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        if (Service::create($data)) {
            return redirect()->route('backend.service.index')->with(
                [
                    'message' => 'Lab added successfully to system',
                    'alert-type' => 'success'
                ]
            );
        }

        return redirect()->back()->with(
            [
                'message' => 'Failed to add lab',
                'alert-type' => 'error'
            ]
        );


    }

    /**
     * @param Lab $lab
     * @return Application|Factory|View
     */
    public function edit(Service $service)
    {
        $data = [
            'service' => $service,
            'service_categories' => ServiceCategory::orderby('category_name')->get()
        ];
        return view('backend.service.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param Lab $lab
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Lab $lab)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'lab_manager' => 'required',
            'manager_contact' => 'sometimes',
            'lab_director' => 'required',
            'director_contact' => 'sometimes',
            'fax' => 'sometimes',
            'phone' => 'sometimes',
            'address' => 'required',
        ]);


        if ($request->hasFile('logo')) {

            if (file_exists(public_path('uploads/lab/' . $lab->logo))) {
                unlink(public_path('uploads/lab/' . $lab->logo));
            }
            $image = $request->file('logo');
            $input['logo'] = 'lab_logo' . time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/lab');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->save($destinationPath . '/' . $input['logo']);
            $data['logo'] = $input['logo'];

        }

        if ($lab->update($data)) {
            return redirect()->route('backend.service.index')->with(['message' => 'Lab updated successfully',

                'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Failed to update lab',

            'alert-type' => 'error']);
    }

    /**
     * @param Lab $lab
     * @return RedirectResponse
     */
    public function destroy(Lab $lab)
    {

        if ($lab->delete()) {
            return redirect()->route('backend.service.index')->with(['message' => 'Lab deleted successfully',

                'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Failed to delete lab',

            'alert-type' => 'error']);
    }
}
