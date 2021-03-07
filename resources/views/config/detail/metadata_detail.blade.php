@extends('../template/modal')
@section('title','Detail')
<!-- 編集のポップアップ -->
@section('form-title','編集')
@section('form-action','/metadata/update/'. $metadatas->metadata_id .'')
@section('icon-edit-modal')

                <div class="display">
                    <input type="hidden" name="id" id="id" value="{{$metadatas->metadata_id}}">
                    <input type="hidden" name="old_meta_model" id="old_meta_model" value="{{$metadatas->meta_model}}">
                    <input type="hidden" name="old_model" id="old_model" value="{{$metadatas->model}}">
                    <input type="hidden" name="old_weight" id="old_weight" value="{{$metadatas->model_weight}}">  
                    <label>ポーズモデル名:</label>
                    <input type="text" name="name" id="name" value="{{$metadatas->metadata_name}}" class="form-control">

                    <label>カテゴリー</label>
                    <select name="predata_id" id="predata_id" class="select">
                        @foreach($predatas as $predata)
                            <option value="{{$predata->predata_id}}">{{$predata->predata_cat_name}}</option>
                        @endforeach
                        <option value="{{$metadatas->predata}}" selected>
                            @foreach($name as $name)
                                 {{$name->predata_cat_name}}
                            @endforeach
                        </option>
                    </select>

                    <label>ポーズ数</label>
                    <input type="text" name="num" id="num" value="{{$metadatas->number}}" size="5" readonly>
                    <label>メタ・モデル:</label>
                    <input type="file" name="meta-model" id="meta-model" class="">
                    <label>モデル・ウェイト:</label>
                    <input type="file" name="meta-weight" id="meta-weight" class="">
                    <label>モデル:</label>
                    <input type="file" name="model" id="model" class="">         
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
         @section('uses')
        @if (session('metadata_status'))
            <div class="alert alert-success">
                {{ session('metadata_status') }}
            </div>
        @endif
        @if (session('metadata_error_status'))
            <div class="alert alert-success">
                {{ session('metadata_error_status') }}
            </div>
        @endif
        
            <div class="big-boxes center neumophism">
                    <div class="icons-frame">
                        <img src="{{ asset('/img/logo.png') }}" class="rounded img-fluid" style="padding:30px;" />
                    </div>
                    <h1>{{$metadatas->name}}</h1>
                    <div class="info box">
                        <h4 class="mini-title">ICON 情報</h4>
                        <ul>
                            <li>METADATA ID : {{$metadatas->metadata_id}}</li>
                            <li>METADATA ネーム: {{$metadatas->metadata_name}}</li>
                            <li>PREDATA ID: {{$metadatas->predata}}</li>
                            <li>ポーズ数: {{$metadatas->number}}</li>
                            <li>メタ・モデル: {{$metadatas->meta_model}}</li>
                            <li>モデル・ウェイト: {{$metadatas->model_weight}}</li>
                            <li>モデル: {{$metadatas->model}}</li>
                            <li>状況:{{$metadatas->active}}</li>
                        </ul>
                    </div>

                    <div class="update-info box">
                        <h4 class="mini-title">更新情報</h4>
                        <ul>
                            <li>登録日 : {{$metadatas->created_at}}</li>
                            <li>更新日 : {{$metadatas->updated_at}}</li>
                        </ul>
                    </div>
                    <div class="buttons-box">
                        <form action="/metadata/{{$metadatas->metadata_id}}" method="post">
                            @method('delete')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="削除">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"　onclick="return confirm('削除してもよろしいですか？');">編集</button>
                            <a href="/config"><button type="button" class="btn btn-info shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">前のページに戻る</button></a>
                        </form>

                        
                    </div>

            </div>  
        </div>
</div>

@endsection