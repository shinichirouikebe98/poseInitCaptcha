{
    let video;
    let poseNet;
    let pose;
    let skeleton;
    let brain;
    let poseLabel = "";
    let state = 'waiting';
    let targetLabel;
    let data = [];//テスト中に取った受験者のポーズデータ用の配列。
    let test = randomize();//テスト内容
    let cooldown = 5;
    let timeleft = 10;
    let canvas;

  
    let url = window.location.pathname;
    if(url == '/experiment'){
        fetchMetadata();
    }
    //開始までのタイマー(準備)
    function on_your_mark(){
      let datas = test;
      getIcons(datas);

      
      let cd = setInterval(function(){
        document.getElementById("time").innerHTML = " 残り<span style='color:red;'>" +cooldown+ "</span>秒ごに開始";
        document.getElementById("poses").innerHTML = "カメラに向かって<span style='color:red;'>" +test+ "</span>のポーズをやってください！ ";
        cooldown -= 1;
      
        if(cooldown==0){ 
          clearInterval(cd);
          document.getElementById("time").innerHTML = "";
          timer();
          getPoseLabel();
        };

      },1000);
      
    }

    //ポーズをとる期間
    function timer(){
      document.getElementById("poses").innerHTML = "カメラに向かって<span style='color:red;'>" +test+ "</span>のポーズをやってください！ ";
      var timer = setInterval(function(){
        document.getElementById("time").innerHTML = " 残り<span style='color:red;'>" +timeleft+ "</span>秒";
        console.log(timeleft);

        timeleft -= 1;
        if(timeleft == 0){
          clearInterval(timer);
          setTimeout(function(){
            check();
          },1000);
        }

      },1000);

    }

    //main
    function setup() {
      canvas = createCanvas(640, 480);
      canvas.hide();
      canvas.parent("capture"); 
      video = createCapture(VIDEO);
      video.hide();
      document.getElementById('push').style.visibility ='hidden';

    }
    //初期化
    function resetCaptcha(){
      document.getElementById('check').style.visibility='hidden';
      document.getElementById('btn').style.visibility='hidden';
      document.getElementById("fail").innerHTML = "";
      test = randomize();
      cooldown = 5;
      timeleft = 10;
      data.length = 0;
      canvas.show();
      on_your_mark();
    }

    //モデルをロード
    function captchaModel(){

      let options = {
        inputs: 34,
        outputs: 3,
        task: 'classification',
        debug: true
      }
      brain = ml5.neuralNetwork(options);

      const modelInfo = {
        model: 'metadata/model/'+retrieveCookie('model'),
        metadata: 'metadata/meta/'+retrieveCookie('meta'),
        weights: 'metadata/weight/'+retrieveCookie('weight'),
      };

      brain.load(modelInfo, brainLoaded);

    }

    function captcha(){
          canvas.show();
          scroll('capture');
          poseNet = ml5.poseNet(video, modelLoaded);
          poseNet.on('pose', gotPoses);
          captchaModel();

    }

    function brainLoaded() {
      console.log('pose classification ready!');
      classifyPose(); 
    }

    async function getIcons(datas){
      let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      let test_icons = datas;
      console.log(test_icons);
      fetch('poseicon/req',{
        headers: {
          "Accept-Charset": "utf-8",
          "Content-Type": "application/json;charset=UTF-8",
          "Accept": "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": token,
          "Access-Control-Allow-Origin" : "*", 
          "Access-Control-Allow-Credentials" : true  
          },
        method: 'get',
        credentials: "same-origin"
      }).then(icon => icon.json()).then(icon =>{
          let data;
          data = icon.filter(x => x.icons_name === test_icons);

          let path = '/img/'+data[0].icons;
          document.getElementById('icons').innerHTML = `<img src='${path}' width='150' height'150'>`;
      })
      


    }
    

    function classifyPose() {
      if (pose) {
        let inputs = [];
        for (let i = 0; i < pose.keypoints.length; i++) {
          let x = pose.keypoints[i].position.x;
          let y = pose.keypoints[i].position.y;
          inputs.push(x);
          inputs.push(y);
        }
        brain.classify(inputs, gotResult);
      } else {
        setTimeout(classifyPose, 100);
      }
    }

    function gotResult(error, results) { 
      //テスト時間ぎれではないとき
          if (results[0].confidence > 0.97) {
            poseLabel = results[0].label.toUpperCase();
          }
          else{
            poseLabel = '';
          }
          classifyPose();
    
      }
    
    
    function getPoseLabel(){
        data.push(poseLabel);//配列にいれる
        if(timeleft>0){
          setTimeout(getPoseLabel, 10);
        }
       
    }


    function fetchMetadata(){
      let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const url = `/experiment/metadata`;
              fetch(url,
              {
                headers: {
                  "Content-Type": "application/json",
                  "Accept": "application/json, text-plain, */*",
                  "X-Requested-With": "XMLHttpRequest",
                  "X-CSRF-TOKEN": token,
                  "Access-Control-Allow-Origin" : "*", 
                  "Access-Control-Allow-Credentials" : true  
                  },
                method: 'get',
                credentials: "same-origin"
              })

              .then(response => response.json()).then(response =>{

                  console.log(response);
                  document.cookie = "model="+response[0].model;
                  document.cookie = "meta="+response[0].meta_model;
                  document.cookie = "weight="+response[0].model_weight;

                  fetch('/experiment/predata/'+response[0].predata,{
                    headers: {
                      "Content-Type": "application/json",
                      "Accept": "application/json, text-plain, */*",
                      "X-Requested-With": "XMLHttpRequest",
                      "X-CSRF-TOKEN": token,
                      "Access-Control-Allow-Origin" : "*", 
                      "Access-Control-Allow-Credentials" : true  
                      },
                    method: 'get',
                    credentials: "same-origin"
                  }).then(predata => predata.json()).then(predata => {
                    console.log(predata);
                    document.cookie = "poseNumber="+predata[0].number;
                    document.cookie = "pose1="+predata[0].pose_one;
                    document.cookie = "pose2="+predata[0].pose_two;
                    document.cookie = "pose3="+predata[0].pose_three;
                    

                  })
                })
    }

    function gotPoses(poses) {
      //console.log(poses); 
      if (poses.length > 0) {
        pose = poses[0].pose;
        skeleton = poses[0].skeleton;
        if (state == 'collecting') {
          let inputs = [];
          for (let i = 0; i < pose.keypoints.length; i++) {
            let x = pose.keypoints[i].position.x;
            let y = pose.keypoints[i].position.y;
            inputs.push(x);
            inputs.push(y);
          }
          let target = [targetLabel];
          brain.addData(inputs, target);
        }
      }
    }

    function randomize(){
       let cname = ['pose1','pose2','pose3'];
       let poseName = [];
       let x = retrieveCookie('poseNumber');
       console.log(x);
       for(let i = 0; i < cname.length; i++){
          if(cname[i] !== '-'){
            poseName.push(retrieveCookie(cname[i]));
          }
          
       }
      let num = Math.floor(Math.random() * poseName.length); 
      console.log(poseName[num]);
      return poseName[num];

    }

    function retrieveCookie(cname) {
      let name = cname + "=";
      let decodedCookie = decodeURIComponent(document.cookie);
      let splited = decodedCookie.split(';');
      for(var i = 0; i <splited.length; i++) {
        var cookie = splited[i];
        while (cookie.charAt(0) == ' ') {
          cookie = cookie.substring(1);
        }
        if (cookie.indexOf(name) == 0) {
          return cookie.substring(name.length, cookie.length);
        }
      }
      return "";
    }

    //チェック作業
    function check(){

    　let yep = 0;
      let nulls = 0;
      let nopes = 0;
      //各データのチェック
      for(var i = 0;i < data.length; i ++){
          if(data[i] == test){
              yep  += 1;
          }
          else if(data[i] === ''){
              nulls += 1;
          }
          else{
              nopes += 1;
          }
      }

        //計算
        let x = data.length/100;
        let percentages = yep/x;


        console.log('nice :'+yep);
        console.log('nothing :'+nulls);
        console.log('nopes :'+nopes);
        console.log(data);
        console.log('without nothing :'+x);
        console.log('percentages in 10 sec :' +percentages);
      //判断
      if (percentages > 80){

          //成功した場合
          document.getElementById("data").innerHTML = "成功です";
          document.getElementById("time").innerHTML = "";
          document.getElementById("poses").innerHTML = "";
          document.getElementById("icons").innerHTML = "";
          canvas.hide();
          document.getElementById('push').style.visibility ='visible';
          
      }
      else{
      
          //失敗した場合
          document.getElementById("time").innerHTML = "";
          document.getElementById("poses").innerHTML = "";
          document.getElementById("icons").innerHTML = "";
          document.getElementById("btn").visibility ="visible";
          document.getElementById("btn").innerHTML = "<input type='button' value='やり直し！' class='btn btn-primary' onclick='resetCaptcha()'>";
          document.getElementById("fail").innerHTML = "失敗です。やり直し！";
      }

    }

    //modelロードのお知らせ
    function modelLoaded() {
        console.log('poseNet ready');
        on_your_mark();//テストを受ける前に準備時間を表す関数
    }
    
    //draw
    function draw() {
        //表示設定
        push();
        translate(video.width, 0);
        scale(-1, 1);
        image(video, 0, 0, video.width, video.height);

        //スケルトンとキーポイントの表示
        if (pose) {
          for(let i = 0; i < pose.keypoints.length; i++){
            let x = pose.keypoints[i].position.x;
            let y = pose.keypoints[i].position.y;
            fill(0,250,0);
            ellipse(x,y,10,10);
          }
          for (let i = 0; i< skeleton.length; i++){
            let a = skeleton[i][0];
            let b = skeleton[i][1];
            strokeWeight(2);
            stroke(255,0,0);
            line(a.position.x,a.position.y,b.position.x,b.position.y);
          }
        }
          //poseのラベル表示
          pop();
          fill(255, 0, 255);
          noStroke();
          textSize(60);
          textAlign(CENTER, CENTER);
          text(poseLabel, width / 2, height / 2);
    }

    //DOM↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
    //オートスクロール
    function scroll(target){
      let content = document.getElementById(`${target}`); 
      content.scrollIntoView({
        behavior: "smooth",
        block: "start",
        inline: "nearest"
      });
    }

}
