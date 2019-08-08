<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Dictionary;
use EmailValidator;

/**
 * Class DictionaryController.
 * @desc Dictionary Api end point CRUD operation
 */
class DictionaryController extends Controller
{
	/**
    * List all the resources for Dictionary
    *
    * @param null
    *
    * @return mix
    */
    public function index()
    {
        return Dictionary::all();
    }

    /**
    * List particluar resource of Dictionary
    *
    * @param Obj Dictionary
    *
    * @return mix
    */
    public function show(Dictionary $word)
    {
        return $word;
    }

    /**
    * Store data for a particluar resource of Dictionary
    *
    * @param Obj Request 
    *
    * @return json
    */
    public function store(Request $request)
    {
    	//Check for valid Email address
    	if ($request->input('email_address')) {
    		if( !EmailValidator::verify($request->input('email_address'))->isValid()[0]){
    			return response()->json(['email' => 'Email address is not valid.'], 422);
    		}
    	} else {
    		return response()->json(['email' => 'The email field is required!'], 422);
    	}
    	

        $Dictionary = Dictionary::create($request->all());

        return response()->json($Dictionary, 201);
    }

    /**
    * Upadte data for a particluar resource of Dictionary
    *
    * @param Obj Request 
    * @param Obj Dictionary 
    *
    * @return json
    */
    public function update(Request $request, Dictionary $Dictionary)
    {
    	//Check for valid Email address
    	if ($request->input('email_address')) {
    		if( !EmailValidator::verify($request->input('email_address'))->isValid()[0]){
    			return response()->json(['email' => 'Email address is not valid.'], 422);
    		}
    	} else {
    		return response()->json(['email' => 'The email field is required!'], 422);
    	}

        $Dictionary->update($request->all());

        return response()->json($Dictionary, 200);
    }

    /**
    * Delete a particluar resource of Dictionary
    *
    * @param Obj Dictionary 
    *
    * @return json
    */
    public function delete(Dictionary $Dictionary)
    {
        $Dictionary->delete();

        return response()->json(null, 204);
    }
}
