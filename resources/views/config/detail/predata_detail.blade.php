@extends('../template/modal')
@section('title','Detail')

<!-- 編集のポップアップ -->
@section('form-title','編集')
@section('form-action','/predata/update/'. $predatas->predata_id .'')
@section('icon-edit-modal')

            <div id="display">
            <input type="hidden" name="predata_id" id="predata_id" value="{{$predatas->predata_id}}">  
            <input type="hidden" name="old_name" id="old_name" value="{{$predatas->predata_name}}">

            <label>カテゴリーネーム:</label>
            <input type="text" name="name" id="name" value="{{$predatas->name}}" class="form-control">

            <label>ポーズデータ:</label>
            <input type="file" name="predata" id="predata" class="form-control"> 

           <label>ポーズ数:</label>
           <select name="number" id="number" class="select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="{{$predatas->number}}" selected>{{$predatas->number}}</option>
            </select>
            

            <label>ポーズ1:</label>
            <select name="pose1" id="pose1" class="select">
                @foreach($poseicons as $poseicon)
                    <option value="{{$poseicon->name}}">{{$poseicon->name}}</option>
                @endforeach
                    <option value="{{$predatas->pose_one}}" selected>{{$predatas->pose_one}}</option>
            </select>
             
            <label>ポーズ2:</label>
            <select name="pose2" id="pose2" class="select">
                @foreach($poseicons as $poseicon)
                    <option value="{{$poseicon->name}}">{{$poseicon->name}}</option>
                @endforeach
                    <option value="{{$predatas->pose_two}}" selected>{{$predatas->pose_two}}</option>
            </select>

            <label>ポーズ3:</label>
            <select name="pose3" id="pose3" class="select">
                @foreach($poseicons as $poseicon)
                    <option value="{{$poseicon->name}}">{{$poseicon->name}}</option>
                @endforeach
                    <option value="{{$predatas->pose_three}}" selected>{{$predatas->pose_three}}</option>
            </select> 
            </div>
                    
@endsection

@section('info')
<div class="container">
        <div class="icons">
        @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
        @endif
            <div class="big-boxes center neumophism">
                    <div class="icons-frame">
                        <img src="{{ asset('storage/img/logo.png') }}" class="rounded img-fluid" style="padding:30px;" />
                    </div>
                    <h1>{{$predatas->name}}</h1>
                    <div class="info box">
                        <h4 class="mini-title">ICON 情報</h4>
                        <ul>
                            <li>PREDATA ID : {{$predatas->predata_id}}</li>
                            <li>PREDATA ネーム: {{$predatas->name}}</li>
                            <li>ファイルネーム: {{$predatas->predata_name}}</li>
                            <li>ポーズ数: {{$predatas->number}}</li>
                            <li>ポーズ１: {{$predatas->pose_one}}</li>
                            <li>ポーズ２: {{$predatas->pose_two}}</li>
                            <li>ポーズ３: {{$predatas->pose_three}}</li>
                        </ul>
                    </div>

                    <div class="update-info box">
                        <h4 class="mini-title">更新情報</h4>
                        <ul>
                            <li>登録日 : {{$predatas->created_at}}</li>
                            <li>更新日 : {{$predatas->updated_at}}</li>
                        </ul>
                    </div>
                    <div class="buttons-box">
                        <form action="/predata/{{$predatas->predata_id}}" method="post">
                            @method('delete')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="削除"　onclick="return confirm('削除してもよろしいですか？');">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">編集</button>
                            <a href="/config"><button type="button" class="btn btn-info shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">前のページに戻る</button></a>
                        </form>

                        
                    </div>

            </div>  
        </div>
</div>
@endsection