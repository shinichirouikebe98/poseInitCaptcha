<?php

namespace App\Http\Controllers;

use App\Models\Poseicon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class PoseiconsController extends Controller
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
            'icons_name' => 'required|unique:poseicons|max:10',
            'icons' => 'required|max:12000|mimes:png,jpg',
        ]);
    
        $file = $request->file('icons');
        $filename = 'pose-photo-' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('/img', $filename,'public_store');
        Poseicon::create([
            'icons_name' => $request->icons_name,
            'icons' => $filename
        ]);
        return redirect('/config')->with('icons_status','アイコンデータの登録は完了しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poseicon  $poseicon
     * @return \Illuminate\Http\Response
     */
    public function show(Poseicon $poseicon)
    {
        return view('config.detail.icon_detail',[ 'poseicons' => $poseicon ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poseicon  $poseicon
     * @return \Illuminate\Http\Response
     */
    public function edit(Poseicon $poseicon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poseicon  $poseicon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poseicon $poseicon)
    {
       
        // validate
        $request->validate([
            'icons_name' => 'required|max:10',
            'icons' => 'max:12000|mimes:png,jpg|sometimes|nullable',
            'old_name' => 'required',
        ]);
    
        //null かどうかをチェック
        if($request->file('icons') == !null){
            $file = $request->file('icons');
            $filename = 'pose-photo-' . time() . '.' . $file->getClientOriginalExtension();//
            $file->storeAs('/img', $filename,'public_store');//名前変更で保存

            $path = '/img/'.$request->old_name.''; //急ファイルのパス
            //ファイルがあるかどいうかチェック
            if(Storage::disk('public_store')->exists($path)){
                Storage::disk('public_store')->delete($path); 
            }else{
                return redirect('/poseicon/'.$request->icons_id.'')->with('icons_error_status','アイコンデータの削除はできませんでした！');
            }
        }
        else{
            $filename = $request->old_name;
        }
        //データを更新
        Poseicon::where('icons_id', $request->icons_id)
            ->update([
                'icons_name' => $request->icons_name,
                'icons' => $filename,
            ]);
        
        return redirect('/poseicon/'.$request->icons_id.'')->with('icons_status','アイコンデータの更新は完了しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poseicon  $poseicon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poseicon $poseicon)
    {

        $path = '/img/'.$poseicon->icons;
          //削除    
        if(Storage::disk('public_store')->exists($path)){
            if(Storage::disk('public_store')->delete($path)){
                 //画像情報を削除
                 Poseicon::destroy($poseicon->icons_id);
            } else{
                return redirect('/poseicons/'.$poseicon->icons_id)->with('icons_error_status','アイコンデータの削除はできませんでした！');
            }
        }

        
        return redirect('/config')->with('icons_status','アイコンデータの削除は完了しました！');
    }
    public function search($request){
        $poseicon = Poseicon::where('icons_id','LIKE','%'.$request.'%')->orwhere('icons_name','LIKE','%'.$request.'%')->orwhere('icons','LIKE','%'.$request.'%')->get();
        return $poseicon;
    }
    public function getIcons(){
        $icons = Poseicon::select('icons_name','icons')->get();
        return $icons;
    }
}

