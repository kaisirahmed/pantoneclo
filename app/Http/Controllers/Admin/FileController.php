<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SaveMultipleFiles;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::latest()->simplepaginate(20);
        return view('admin.files.index',compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $inputFileCount = count($request->files);
        if($inputFileCount > 0){
            $uploadFileCount = 0;
            $inputFiles = $request->file('files'); 
            if($inputFileCount <= 10){
                foreach($inputFiles as $key => $inputFile) {
                    
                    $rules = array('files' => 'required|unique:files,file|mimes:jpg,jpeg,png,bmp,tiff,gif|max:2048'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                    $validator = Validator::make(array('files'=> $inputFile), $rules);
        
                    if ($validator->fails()) {
                        return $validator->validate();
                    } else {
                        $image = $inputFile;  
                        $input['mime'] = $image->getClientOriginalExtension();
                        $fileName = $image->getClientOriginalName();
                        $input['name'] = Str::of($fileName)->basename('.'.$input['mime']);
                        $destination = 'uploads/files/'.$fileName;
                        $createImage = Image::make($image)->save($destination);
                        $input['file'] = $destination;
                        $input['dimension'] = $createImage->width().' X '.$createImage->height();
                        // get file size
                        $input['size'] = number_format($createImage->filesize()/1024,2).' KB';
                        $input['date'] = date('Y-m-d');
                        if(File::create($input)){
                            $uploadFileCount++;
                        }  
                    }              
                    
                }
            } else {
                Session::flash('limit','Files upload limit only 10 item at a time.');
            }
 
            if($inputFileCount == $uploadFileCount) {
                Session::flash('success',$uploadFileCount.' Files has been uploaded successfully.');
            } else {
                Session::flash('warning','Something is wrong when creating file upload.');
            }
        } else {
            Session::flash('warning','No files are selected!');
        }

        return redirect()->route('admin.files.index');
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
    public function destroy(File $file)
    {
        $file->delete();
        return redirect()->back()->with('success','File has been deleted successfully!');
    }
}
