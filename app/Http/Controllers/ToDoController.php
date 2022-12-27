<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Todo;
//use Yajra\DataTables\DataTables;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
//        if ($request->ajax()) {
//            $data = Todo::select('*');
//
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('action', function($row){
//
//                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
//
//                    return $btn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//
//        return view('todos.index');


        $todos=Todo::paginate(20);

        return view('todos.index',compact(['todos']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get json data from API

        $client = new Client();
        $api_response = $client->get('https://jsonplaceholder.typicode.com/todos')->getBody();
        $responses = json_decode($api_response);

        foreach ($responses as $response){
            $data['id'] = $response->id;
            $data['user_id'] = $response->userId;
            $data['title'] = $response->title;
            $data['completed'] = $response->completed;

            Todo::create($data);
        }

        return redirect("/todos")->withSuccess('API data Successfully imported to Database.');



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}