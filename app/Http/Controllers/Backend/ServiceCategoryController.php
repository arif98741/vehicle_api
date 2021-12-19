<?php
/*
 * Copyright (c) 2021.
 * This file is originally created and maintained by Ariful Islam.
 * You are not allowed to modify any parts of this code or copy or even redistribute
 * full or small portion to anywhere. If you have any question
 * fee free to ask me at arif98741@gmail.com.
 * Ariful Islam
 * Software Engineer
 * https://github.com/arif98741
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class ServiceCategoryController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'service_categories' => ServiceCategory::orderby('category_name')->get()
        ];
        return view('backend.setting.service_category.index')->with($data);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'category_name' => 'required|unique:service_categories',
        ]);

        if (ServiceCategory::create($data)) {
            return response()->json([
                'message' => 'Service Category added successfully',
                'alert-type' => 'success'
            ], 200);

        }

        return response()->json([

            'message' => 'Failed to save',
            'alert-type' => 'error'
        ]);

    }


    /**
     * @param Request $request
     * @param ServiceCategory $lab
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'category_name' => 'required',
        ]);

        $cat = ServiceCategory::find($id);
        $cat->category_name = $request->category_name;


        if ($cat->save($data)) {
            return response()->json([
                'message' => 'Service Category saved successfully',
                'alert-type' => 'success'
            ], 200);

        }

        return response()->json([

            'message' => 'Failed to update',
            'alert-type' => 'error'
        ]);
    }


    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return response()->json([
            'message' => 'Fetched successfully',
            'alert-type' => 'success',
            'data' => ServiceCategory::find($id)
        ], 200);
    }

    /**
     * @param ServiceCategory $lab
     * @return RedirectResponse
     */
    public function destroy(ServiceCategory $lab)
    {

        if ($lab->delete()) {
            return redirect()->route('admin.setting.service_category.index')->with(['message' => 'ServiceCategory deleted successfully',

                'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => 'Failed to delete lab',

            'alert-type' => 'error']);
    }


}
