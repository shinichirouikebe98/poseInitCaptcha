<?php

namespace App\Http\Controllers;

use App\Models\Metadata;
use Illuminate\Http\Request;
use App\Models\Predata;
use Illuminate\Support\Facades\Storage;

class MetadatasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'metadata_name' => 'required|unique:metadatas|max:10',
            'predata_id' => 'required',
            'num' => 'required',
            'meta-model' => 'required|max:12000|file|mimetypes:application/json,text/plain',
            'meta-weight' => 'required|max:12000|file|mimetypes:application/octet-stream',
            'model' => 'required|max:12000|file|mimetypes:application/json,text/plain',
        ]);  
    
        $file = array($request->file('meta-model'),$request->file('model'),$request->file('meta-weight'));
        $renamedFile = array();        
        //ファイル分け
        for ($i = 0; $i < count($file); $i++) {
            $ext = $file[$i]->getClientOriginalExtension();
            $folder = 'lost';

            if ($ext === 'bin') {
                $filename = 'meta-weight-'. time() . '.' . $ext;
                $folder = 'weight';
            } elseif ($ext == 'json') {
                if ($file[$i]->getClientOriginalName() === 'model.json') {
                    $filename = 'model-'. time() . '.' . $ext;
                    $folder = 'model';
                } else {
                    $filename = 'meta-model-'. time() . '.' . $ext;
                    $folder = 'meta';
                }
            } 
            else {
                return redirect('/config')->with('metadata_error_status','モデルデータの登録はできませんでした！');
            }

            $path = '/metadata/'.$folder;
            $file[$i]->storeAs($path,$filename,'public_store');
            array_push($renamedFile,$filename);
        }
        
        
        Metadata::create([
            'metadata_name' => $request->name,
            'predata' => $request->predata_id,
            'number' => $request->num,
            'meta_model' => $renamedFile[0],
            'model' => $renamedFile[1],
            'model_weight' => $renamedFile[2],
            'active' => $active = 'not_active',
        ]);
        
        return redirect('/config')->with('metadata_status','モデルデータの登録が完了しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function show(Metadata $metadata)
    {
        $predata = Predata::all();
        $predata_id = Predata::select('predata_cat_name')->where('predata_id',$metadata->predata)->get();
        
        return view('config.detail.metadata_detail',[ 'metadatas' => $metadata,'predatas' => $predata , 'name' => $predata_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function edit(Metadata $metadata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metadata $metadata)
    {
        $request->validate([
            'id' => 'required',
            'metadata_name' => 'required|max:10',
            'predata_id' => 'required',
            'num' => 'required',
            'meta-model' => 'sometimes|nullable|max:12000|file|mimetypes:application/json,text/plain',
            'meta-weight' => 'sometimes|nullable|max:12000|file|mimetypes:application/octet-stream',
            'model' => 'sometimes|nullable|max:12000|file|mimetypes:application/json,text/plain',
        ]);  

    
        $file = array($request->file('meta-model'),$request->file('model'),$request->file('meta-weight'));
        $old_file = array($request->old_meta_model,$request->old_model,$request->old_weight);
        $checkedFile = array(); 
        //ファイル分け
        for($j=0; $j < count($file); $j++){
            if($file[$j] == null){
                array_push($checkedFile,$old_file[$j]);
            }
            else{
                $ext = $file[$j]->getClientOriginalExtension();
                $folder = 'lost';
    
                if ($ext === 'bin') {
                    $filename = 'meta-weight-'. time() . '.' . $ext;
                    $folder = 'weight';
                    $old_name = $request->old_weight;
                } elseif ($ext == 'json') {
                    if ($file[$j]->getClientOriginalName() === 'model.json') {
                        $filename = 'model-'. time() . '.' . $ext;
                        $folder = 'model';
                        $old_name =$request->old_model;
                    } else {
                        $filename = 'meta-model-'. time() . '.' . $ext;
                        $folder = 'meta';
                        $old_name = $request->old_meta_model;
                    }
                }
                $path = '/metadata/'.$folder.'/'.$old_name;
                $storePath = '/metadata/'.$folder;  

                if (Storage::disk('public_store')->exists($path)) {
                        Storage::disk('public_store')->delete($path);
                }
                else{
                    return redirect('/metadata/'.$request->id)->with('metadata_error_status','モデルデータの登録はできませんでした！');
                } 
                $file[$j]->storeAs($storePath,$filename,'public_store');
                array_push($checkedFile,$filename);

                
            }

        }      
        
        Metadata::where('metadata_id',$request->id)->update([
            'metadata_name' => $request->name,
            'predata' => $request->predata_id,
            'number' => $request->num,
            'meta_model' => $checkedFile[0],
            'model' => $checkedFile[1],
            'model_weight' => $checkedFile[2],
        ]);
        
        return redirect('/metadata/'.$request->id)->with('metadata_status','モデルの更新が完了しました！');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metadata $metadata)
    {
        $filename = array($metadata->meta_model,$metadata->model_weight,$metadata->model);
        $folder = array('meta','weight','model');
        $feedback = '';
        for($i = 0; $i < count($filename); $i++ ){
            $path = '/metadata/'.$folder[$i].'/'.$filename[$i];
            //削除 
            if(Storage::disk('public_store')->exists($path)){
                if(Storage::disk('public_store')->delete($path)){
                    //Metadata情報を削除
                    Metadata::destroy($metadata->metadata_id);
                } else{
                    return redirect('/metadata/'.$metadata->metadata_id)->with('metadata_error_status','モデルデータの削除はできませんでした！'); 
                }
            }
            else{
                return redirect('/metadata/'.$metadata->metadata_id)->with('metadata_error_status','モデルデータの削除はできませんでした！');
            }
        }     
      return redirect('/config')->with('metadata_status','モデルデータの削除は完了しました！');
    }

    public function getNum($predata){

        $nums = Predata::select('number')->where('predata_id',$predata)->get();
        return $nums;
       
    }

    public function active(Request $request){

       if(Metadata::query()->update([ 'active' => 'not_active'])){
            Metadata::where('metadata_id',$request->metadata)->update([ 'active' => 'active' ]);
       }
       else{
        return redirect('/config')->with('metadata_error_status','モデルデータの仕使用変更はできませんでした！');
       }
       return redirect('/config')->with('metadata_status','モデルの使用変更完了しました！');

    }
    public function search($metadata){
        $meta = Metadata::where('metadata_id','LIKE','%'.$metadata.'%')->orwhere('metadata_name','LIKE','%'.$metadata.'%')
        ->orwhere('number','LIKE','%'.$metadata.'%')->get();
        return $meta;
    }
    public function getMeta()
    {
        $metadata = Metadata::all();
        return $metadata;
    }
}
