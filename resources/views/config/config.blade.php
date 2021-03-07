@extends('../template/main')

@section('title','Captcha Config')
@section('brand')
    <img src="{{ asset('storage/img/gear.jpg') }}" width="25" height="25">&nbsp; CONFIGURATION
@endsection

@section('record')

<div class="container">
<h1>RECORD</h1>
    <div class="frame">
        <div class="display neumophism">
            <label>ポーズラベル:</label>
            <input type="text" name="label" id="label" maxlength="20" class="form-control" placeholder="Label">
            <div class="buttons">
                <input type="button" name="record" id="record" value="レコード" class="btn btn-danger neumobtn">
                &nbsp;
                <input type="Button" name="save" id="save" value="データ保存" class="btn btn-success neumobtn">
            </div>
            
        </div>
        <div class="cam">
            <div class="start" id="start" align="center">　</div>
            <div class="timer" id="timer" align="center">　</div>
            <div class="vid" id="vid" align="center"></div>
        </div>

    </div>   
</div>
<hr>

@endsection

@section('train')

<div class="container">
<h1>TRAIN</h1>

    <div class="frame">
            <form action="/predata" method="post" enctype="multipart/form-data">
            @csrf
                <div class="display neumophism">
                    <label>カテゴリーネーム:</label>
                    <input type="text" name="name" id="name" value="" class="form-control @error('name') is-invalid @enderror" placeholder="Category">
                    @error('name')<div class="invalid-feedback">{{$message}}</div>@enderror
                    

                    <label>ポーズデータ:</label>
                    <input type="file" name="predata" id="predata" class="@error('predata') is-invalid @enderror"> 
                    @error('predata')<div class="invalid-feedback">{{$message}}</div>@enderror

                    <label>ポーズ数:</label>
                    <select name="number" id="number" class="select @error('number') is-invalid @enderror">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="" disabled selected>選んでください</option>
                    </select>
                    @error('number')<div class="invalid-feedback">{{$message}}</div>@enderror

                    <label id="pose1label">ポーズ1:</label>
                    <select name="pose1" id="pose1" class="select @error('pose1') is-invalid @enderror">
                        @foreach($poseicons as $poseicon)
                            <option value="{{$poseicon->name}}">{{$poseicon->name}}</option>
                        @endforeach
                        <option value="" selected>選んでください</option>
                    </select>
                    @error('pose1')<div class="invalid-feedback">{{$message}}</div>@enderror
                    
                    <label id="pose2label">ポーズ2:</label>
                    <select name="pose2" id="pose2" class="select @error('pose2') is-invalid @enderror">
                        @foreach($poseicons as $poseicon)
                            <option value="{{$poseicon->name}}">{{$poseicon->name}}</option>
                        @endforeach
                            <option value="" selected>選んでください</option>
                    </select>
                    @error('pose2')<div class="invalid-feedback">{{$message}}</div>@enderror

                    <label id="pose3label">ポーズ3:</label>
                    <select name="pose3" id="pose3" class="select @error('pose3') is-invalid @enderror">
                        @foreach($poseicons as $poseicon)
                            <option value="{{$poseicon->name}}">{{$poseicon->name}}</option>
                        @endforeach
                            <option value="" selected>選んでください</option>
                    </select> 
                    @error('pose3')<div class="invalid-feedback">{{$message}}</div>@enderror
                    
                    <input type="submit" value="送信" class="btn btn-primary">
                </div>
        </form> 
            <div class="block">
                <h2>学習データリスト</h2>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">@</span>
                    <input type="text" class="form-control" placeholder="検索" id="predata_search"　name="predata_search" aria-describedby="addon-wrapping">
                </div>
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">ポーズカテゴリー名</th>
                            <th scope="col">アクション</th>
                            <th scope="col">学習（TRAIN）</th>
                            </tr>
                        </thead>

                            <tbody id="predata_tbody">
                            @foreach($predatas as $predata)
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$predata->predata_id}}</td>
                                <td>{{$predata->name}}</td>
                                <td>
                                    <a href="/predata/{{$predata->predata_id}}" class="badge bg-info rounded-pill">詳細を見る！</a>
                                </td>
                                <td>
                                    <button id="train" value="学習する！" class="btn btn-primary neumobtn" data-id="{{$predata->predata_id}}">学習する！</button>
                                </td>
                                </tr>
                            @endforeach
                            </tbody>
                 </table>
                 <div class="d-flex justify-content-center">
                      {!! $predatas->links() !!}
                 </div>
                 
            </div>
    </div>
        
</div>
<hr>
@endsection

@section('icons')

<div class="container">
<h1 class="">ICONS</h1>
    <div class="frame">
        <form action="/poseicon" method="post" enctype="multipart/form-data">
        @csrf
            <div class="display neumophism">
            
                <label>ポーズアイコンネーム:</label>
                <input type="text" name="name" id="name" value="" class="form-control @error('name') is-invalid @enderror" placeholder="Pose Icons Name">
                @error('name')<div class="invalid-feedback">{{$message}}</div>@enderror
                <label>ポーズアイコンファイル:</label>
                <input type="file" name="icons" id="icons" class="@error('icons') is-invalid @enderror">
                @error('icons')<div class="invalid-feedback">{{$message}}</div>@enderror
                
                <input type="submit" value="送信" class="btn btn-primary">

            </div>
        </form> 

        <div class="block">
            <h2>ポーズアイコンリスト</h2>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">@</span>
                 <input type="text" class="form-control" placeholder="検索" id="icons_search"　name="icons_search" aria-label="Username" aria-describedby="addon-wrapping">
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">ポーズアイコン名</th>
                        <th scope="col">アクション</th>
                    </tr>
                </thead>

                <tbody id="icons_tbody">
                    @foreach($poseicons as $poseicon)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$poseicon->icons_id}}</td>
                            <td>{{$poseicon->name}}</td>
                            <td><a href="/poseicon/{{$poseicon->icons_id}}" class="badge bg-info rounded-pill">詳細を見る！</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {!! $poseicons->links() !!}
             </div>
        </div>
    </div>
    

</div>
<hr>
@endsection

@section('uses')

<div class="container">
<h1>SELECT</h1>
        <div class="frame">
            <form action="/metadata" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="display neumophism">
                                <label>ポーズモデル名:</label>
                                <input type="text" name="name" id="name" value="" class="form-control @error('name') is-invalid @enderror" placeholder="Model Name">
                                @error('name')<div class="invalid-feedback">{{$message}}</div>@enderror
                                <label>カテゴリー:</label>
                                <select name="predata_id" id="predata_id" class="select @error('predata_id') is-invalid @enderror">
                                    @foreach($predatas as $predata)
                                    <option value="{{$predata->predata_id}}">{{$predata->name}}</option>
                                    @endforeach
                                    <option value="" selected disabled>選んでください</option>
                                </select>
                                @error('predata_id')<div class="invalid-feedback">{{$message}}</div>@enderror

                                <label>ポーズ数:</label>
                                <input type="text" name="num" id="num" value="" size="5" readonly class="@error('num') is-invalid @enderror">
                                @error('num')<div class="invalid-feedback">{{$message}}</div>@enderror
                                <label>メタ・モデル:</label>
                                <input type="file" name="meta-model" id="meta-model" class="@error('meta-model') is-invalid @enderror">
                                @error('meta-model')<div class="invalid-feedback">{{$message}}</div>@enderror
                                <label>モデル:</label>
                                <input type="file" name="model" id="model" class="@error('model') is-invalid @enderror">
                                @error('model')<div class="invalid-feedback">{{$message}}</div>@enderror
                                <label>モデル・ウェイト:</label>
                                <input type="file" name="meta-weight" id="meta-weight" class="@error('meta-weight') is-invalid @enderror">
                                @error('meta-weight')<div class="invalid-feedback">{{$message}}</div>@enderror
                                <input type="submit" value="送信" class="btn btn-primary">           
                            </div>
                        </form>

                        
                        <div class="block">
                            <div class="center">
                                <h1>@foreach($active_data as $active_data)<font color="salmon">{{$active_data->name}}</font>@endforeach</h1>
                                <h3>上記の姿勢推定モデルは<font color="green">使用中</font>です。変更したい場合は下のメニューから選んで更新してください。</h3>
                                <form action="/metadata/active" method="POST">
                                    @csrf
                                    @method('patch')
                                    <select name="metadata" id="metadata" class="select">
                                        @foreach($metadatas as $metadata)
                                        <option value="{{$metadata->metadata_id}}">{{$metadata->name}}</option>
                                        @endforeach
                                        <option value="" selected disabled>選んでください</option>

                                    </select>
                                    <input type="submit" value="使用する" class="btn btn-primary">
                                </form>
                            </div>
                            <hr>
                            <h2>モデルリスト</h2>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">@</span>
                                <input type="text" class="form-control" placeholder="検索" id="meta_search"　name="meta_search" aria-describedby="addon-wrapping">
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">モデル名</th>
                                    <th scope="col">アクション</th>
                                    </tr>
                                </thead>
                                <tbody id="metadata_tbody">
                                    @foreach($metadatas as $metadata)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$metadata->metadata_id}}</td>
                                            <td>{{$metadata->name}}</td>
                                            <td><a href="/metadata/{{$metadata->metadata_id}}" class="badge bg-info rounded-pill">詳細を見る！</a></td>
                                        </tr>
                                    @endforeach
                                        <tr>

                                        </tr>

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $metadatas->links() !!}
                             </div>

                        </div>
                        

        </div>



         
</div>   
@endsection


