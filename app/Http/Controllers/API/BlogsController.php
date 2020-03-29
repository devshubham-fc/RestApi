<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Contact;
use Validator;

class BlogsController extends Controller
{
    public function contact(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $book = Contact::create($input);
        $data = $book->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Your record stored successfully.'
        ];

        return response()->json($response, 200);
    }
}
