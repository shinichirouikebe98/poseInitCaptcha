<?php

namespace App\Http\Controllers;

use App\Models\Predata;
use App\Models\Poseicon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class PredatasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('config.config');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
                'predata_cat_name' => 'required|unique:predatas|max:10',
                'predata' => 'required',
                'number' => 'required',
                'pose1' => 'required',
                'pose2' => 'nullable',
                'pose3' => 'nullable',
            ]);
             
            $file = $request->file('predata');
            $filename = 'predata-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/predata', $filename,'public_store');
            
            if($request->pose2 == null){
                $request->pose2 = '-';
                $request->pose3 = '-';
            }
            else if($request->pose3 == null){
                $request->pose3 = '-';
            }

            Predata::create([
                'predata_cat_name' => $request->predata_cat_name,
                'predata_name' => $filename,
                'number' => $request->number,
                'pose_one' => $request->pose1,
                'pose_two' => $request->pose2,
                'pose_three' => $request->pose3,
            ]);
            
            return redirect('/config')->with('predata_status','学習の登録はできませんでした！');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Predata  $predata
     * @return \Illuminate\Http\Response
     */
    public function show(Predata $predata)
    {
        $poseicon = Poseicon::all();
        return view('config.detail.predata_detail',[ 'predatas' => $predata,'poseicons' => $poseicon ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Predata  $predata
     * @return \Illuminate\Http\Response
     */
    public function edit(Predata $predata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Predata  $predata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Predata $predata)
    {
        $request->validate([
            'predata_id' => 'required',
            'predata_cat_name' => 'required|max:10',
            'predata' => 'sometimes|nullable|max:120000|file|mimetypes:application/json,text/plain',
            'number' => 'required',
            'pose1' => 'required',
            'pose2' => 'required',
            'pose3' => 'required',
            'old_name' => 'required',
        ]);
        //null かどうかをチェック
        if($request->file('predata') == !null){
            $file = $request->file('predata');
            $filename = 'predata-' . time() . '.' . $file->getClientOriginalExtension();//
            $file->storeAs('/predata', $filename, 'public_store');//名前変更で保存

            $path = '/predata/'.$request->old_name.''; //急ファイルのパス
            //ファイルがあるかどいうかチェック
            if(Storage::disk('public_store')->exists($path)){
                Storage::disk('public_store')->delete($path); 
            }else{
                return redirect('/predata/'.$request->predata_id)->with('predata_error_status','学習データの更新はできませんでした！');
            }
        }
        else{
            $filename = $request->old_name;
        }
        //データを更新
        Predata::where('predata_id', $request->predata_id)
            ->update([
                'predata_cat_name' => $request->predata_cat_name,
                'predata_name' => $filename,
                'number' => $request->number,
                'pose_one' => $request->pose1,
                'pose_two' => $request->pose2,
                'pose_three' => $request->pose3,           
         ]);
         return redirect('/config')->with('predata_status','学習データの更新が完了しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Predata  $predata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Predata $predata)
    {
        $path = '/predata/'.$predata->predata_name;
        //削除    
        if(Storage::disk('public_store')->exists($path)){
            if(Storage::disk('public_store')->delete($path)){
                //画像情報を削除
                Predata::destroy($predata->predata_id);
            } else{
                return redirect('/predata/'.$predata->predata_id)->with('predata_error_status','学習データの削除ができませんでした！');
            }
        }
        return redirect('/config')->with('predata_status','学習データの削除は完了しました！');
    }

    //train
    /**
     * @param  \App\Models\Predata  $predata
     * @return \Illuminate\Http\Response
     */
    public function train(Predata $predata){
        return $predata;
    }
    public function search($request){
        $predata = Predata::where('predata_id','LIKE','%'.$request.'%')
        ->orwhere('predata_cat_name','LIKE','%'.$request.'%')->get();
        return $predata;
    }
    public function getPredata(){
        $predata = Predata::all();
        return $predata;
    }
}
