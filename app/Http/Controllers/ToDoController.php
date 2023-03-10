<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoUpdateRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Exports\TodosExport;
use Maatwebsite\Excel\Facades\Excel;


class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function export()
    {
        return Excel::download(new TodosExport(), 'todos.xlsx');
    }

    public function index()
    {
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

        try{
            $client = new Client();
            $url='https://jsonplaceholder.typicode.com/todos';
            $api_response = $client->get($url)->getBody();
            $responses = json_decode($api_response);
            foreach ($responses as $response){
                $data['id'] = $response->id;
                $data['user_id'] = $response->userId;
                $data['title'] = $response->title;
                $data['completed'] = $response->completed;

                $check=Todo::create($data);
            }
            return redirect("/todos")->with('success','API data Successfully imported to Database.');

        }catch (\Exception $e){
            return redirect("dashboard")->with('error','Could not save data from API');
        }

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
        $todo=Todo::findOrFail($id);
        $bools=[True=>'True',False=>'False'];

        return view('todos.edit',compact(['todo','bools']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoUpdateRequest $request, $id)
    {
        try{
            $data = $request->only([ 'user_id', 'title','completed']);
            if($data['completed']=="True")
                $data['completed']=True;
            else
                $data['completed']=False;
            $todo=Todo::find($id);
            $todo->update($data);
            return redirect()->route('todo.index')->with('success','Updated Successfully.');
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('error','Could Not Update.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $todo=Todo::find($id);
            $todo->delete();
            return redirect()->route('todo.index')->with('success', 'Deleted Successfully.');
        }catch (\Exception $e){
            return redirect()->route('todo.index')->with('error', 'Could Not Delete.');
        }
    }
}
