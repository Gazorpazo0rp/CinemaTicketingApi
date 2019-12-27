<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use App\Movie;
use App\Screen;
use App\Screenings;
use App\Reservation;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies=Movie::all();
        $images=array();
        foreach($movies as $movie){
            $image=Storage::disk('local')->get($movie->imagepath);
            $image=base64_encode($image);
            array_push($images,$image);
        }
        

        return response()->json([
            'movies' =>$movies,
            'images' =>$images
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $Movie= new Movie;
        $Movie->name=$request->input('name');
        $Movie->genre=$request->input('genre');
        $Movie->length=(int)$request->input('length');
        $image=$request->file('image');
            try{
           
            $extension = $image->getClientOriginalExtension();
            //Storage::disk('public')->put($request->input('name').'.'.$extension,  File::get($image));
            $Movie->imagepath= $request->input('name').'.'.$extension;
            Storage::disk('local')->put($request->input('name').'.'.$extension,  File::get($image));    
           

            
        }
        catch(\Exception $e){
            
            return $e;
        }

        //return $request->input('password');
        try{
            $Movie->save();
            return 1;
        }
        catch(\Exception $e){
            // do task when error
            return $e->getMessage();   // insert query
         }
        return 0;
    }
    public function getMovie($id){
        $movie= Movie::find($id);
        $image=Storage::disk('local')->get($movie->imagepath);
        $image=base64_encode($image);
        
        return response()->json([
            'movie' =>$movie,
            'image' =>$image
        ]);


    }
    public function addScreen(Request $request){
        $screen= new Screen;
        $screen->rows=(int)$request->input('rows');
        $screen->columns=(int)$request->input('columns');
        try{
            $screen->save();
            return 1;
        } catch(\Exception $e){
            return $e->getMessage(); 
        }
       

    }

    public function getAllScreens(){
        return Screen::all();
    }
    public function getMovieScreenings($id){
        return Screenings::where('movieId',$id)->get();
    }
    public function getTakenChairs($screeningId){
        $takenSeats=Reservation::where('screeningId',$screeningId)->get();
        $screeningData=array();
        $screening=Screenings::find($screeningId);
        $screen= Screen::find($screening->screenId);
        $screeningData['rows']=$screen['rows'];
        $screeningData['columns']=$screen['columns'];
        $takenSeatsArray=array();
        $temp=array();
        foreach($takenSeats as $seat){
            $temp['row']=$seat->row;
            $temp['column']=$seat->column;
            array_push($takenSeatsArray,$temp);
        }
        $screeningData['takenSeats']=$takenSeatsArray;
        return $screeningData;
    }
    public function addScreening(Request $request){
        $screening= new Screenings;
        $screening->movieId=$request->input('movieId');
        $screening->screenId=$request->input('screenId');
        
        $screening->setting =$request->input('setting');
        try{
            $screening->save();
            return 1;
        }
        catch(\Exception $e){
            return $e->getMessage(); 
        }
    }
    public function makeReservation(Request $request){
        $screeningId=$request->input('screeningId');
        foreach($request->input('seats') as $seat){
            
            $res= new Reservation;
            $res->screeningId= $screeningId;
            $screening=Screenings::find($screeningId);
            $screen = Screen::find($screening->screenId);
            $rows=$screen->rows;
            $columns=$screen->columns;
            $col=(int)$seat% $columns;
            $row=intdiv((int)$seat,$columns);
            $res->row=$row;
            $res->column=$col;
            $res->userId=$request->input('userId');
            try {
                //check noone reserved the seat after the rendering
                if(Reservation::where('row',$row)->where('column',$col)->where('screeningId',$screeningId)->count()>0){
                    return 0;
                }
                $res->save();
                return $res->id;
                
            }
            catch(\Exception $e){
                return $e->getMessage(); 
            }
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
