@extends('../template/modal')
@section('title','Detail')

<!-- 編集のポップアップ -->
@section('form-title','編集')
@section('form-action','/poseicon/update/'. $poseicons->icons_id .'')
@section('icon-edit-modal')
                <div id="display">
                    <input type="hidden" name="icons_id" id="icons_id" value="{{$poseicons->icons_id}}" readonly> 
                    <input type="hidden" name="old_name" id="old_name" value="{{$poseicons->icons}}" readonly>   
                    <label>ポーズアイコンネーム:</label>
                    <input type="text" name="names" id="names" value="{{$poseicons->name}}" class="form-control">
                    <label>ポーズアイコンファイル:</label>
                    <input type="file" name="icons" id="icons" class="">
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
                    <img src="{{ asset('storage/img/'. $poseicons->icons .'') }}" class="rounded img-fluid" />
                    </div>
                    <h1>{{$poseicons->name}}</h1>
                    <div class="info box">
                        <h4 class="mini-title">ICON 情報</h4>
                        <ul>
                            <li>ICON ID : {{$poseicons->icons_id}}</li>
                            <li>ICON ネーム: {{$poseicons->name}}</li>
                            <li>ファイルネーム: {{$poseicons->icons}}</li>
                        </ul>
                    </div>

                    <div class="update-info box">
                        <h4 class="mini-title">更新情報</h4>
                        <ul>
                            <li>登録日 : {{$poseicons->created_at}}</li>
                            <li>更新日 : {{$poseicons->updated_at}}</li>
                        </ul>
                    </div>
                    <div class="buttons-box">
                        <form action="/poseicon/{{$poseicons->icons_id}}" method="post">
                            @method('delete')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="削除" onclick="return confirm('削除してもよろしいですか？');">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">編集</button>
                            <a href="/config"><button type="button" class="btn btn-info shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">前のページに戻る</button></a>
                        </form>

                        
                    </div>

            </div>  
        </div>
</div>
@endsection


