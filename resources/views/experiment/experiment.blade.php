@extends('../template/experiment_main')
@section('experiment')
<style type="text/css">
    *{
        margin:0;
        padding: 0;
        font-family: 'Kosugi Maru', sans-serif;
        color: black;
      }   
      body{
        background-color:#f0f0f0;

      }
      .container{
        width: 100%;
        height: 100%;
        display: flex;
	      justify-content: center;
        align-items: center;
      }
      .container-captcha{
        width: auto;
        height: auto;
      }
      .size{
        font-size: 30px;
        font-family: 'Kosugi Maru', sans-serif;
        margin:20px;
      }
      .inputText{
        border-radius: 4px;
        border:none;
        height: 40px;
        width: 400px;
        padding-left: 7px;
        margin-top: 10px;
      }

      input[type=checkbox]{
        width: 40px;
        height: 40px;
        background-color: antiquewhite;
        border-radius: 8px;
        margin-top: 10px;
      }
      input[type=submit]{
        width: 120px;
        height: 30px;
        background-color: antiquewhite;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        margin-top: 10px;
      }
      input[type=submit]:hover{
        background-color: aquamarine;
        transition: 0.5s ease;
      }
      .formDisplay{
        display: grid;
        grid-template-rows: auto;
      }
      .Grid{
        display: grid;
        grid-template-rows: auto;
      }
      .box{
        display: flex;
        align-items: center;
	      justify-content: center;
        width: 500px;
        height: 500px;
        border-radius: 7px;
        background-color: aliceblue;
        -moz-box-shadow: -2px -1px 75px #808080;
        -webkit-box-shadow: -2px -1px 75px #808080;
        box-shadow: -2px -1px 75px #808080;

      }
      input[type=text]:focus{
        transition:0.3s ease;
        border-color: green solid 1px;
      }
    </style>
<div class="container">
      <form action="" method="post">
          @csrf
        <div class="box">
            
              <div class="formDisplay">
                <h1 align="center">実験用フォルム</h1>
                <div class="formGrid">
                  <input type="text" name="a" class="inputText" onclick="" placeholder="サンプル">
                </div>
                <div class="formGrid">
                  <input type="text" name="b" class="inputText" placeholder="サンプル">
                </div>
                <div class="formGrid">
                  <input type="text" name="c" class="inputText" placeholder="サンプル">
                </div>
                <div class="formGrid">
                  <input type="text" name="d" class="inputText" placeholder="サンプル">
                </div>
                
                <input type="checkbox" name="check"  id="check" onclick="captcha()"> Start Captcha
                <input type="submit" value="PUSH" id="push">
              </div>
        </div>
      </form>
    </div>
<div class="container-captcha">
    <div id="time" class="size" align="center"></div>
    <div id="data" class="size" align="center"></div>
    <div id="poses" class="size" align="center"></div>
    <div id="icons" class="size" align="center"></div>
    <div id="fail" class="size" align="center"></div>
    <div id="btn" class="size" align="center"></div>

    <div id="capture" class="size" align="center">

    </div>
</div>
@endsection