let poseNet;
let camera;
let pose;
let skeleton;
let brain;
let targetLabel;
let state ='waiting';
let count = 0;
let record_times = 0;


//pose情報記録
function getData(){
	targetLabel = document.getElementById('label').value;
	document.getElementById('label').value='';
	
	setTimeout(function(){
		console.log('姿勢データ収得開始');
		document.getElementById('start').innerHTML='姿勢データ収得開始';
		state='collecting';
		
		if(state == 'collecting'){
			let stop = setInterval(function(){
				count += 1;
				console.log(count);
				document.getElementById('timer').innerHTML = count;
				if(count == '10'){
					clearInterval(stop);
					document.getElementById('timer').innerHTML ='';	
					count = 0;
					record_times += 1;
					if(record_times === 3){
						savesPoses();
						location.reload();
					}
				}
			},1000)
		}
		setTimeout(function(){
			console.log('姿勢データ収得終了');
			document.getElementById('start').innerHTML='姿勢データ収得終了';
			setTimeout(function(){
				document.getElementById('start').innerHTML='';
			},3000);

			state = 'waiting';
		},10000);

	},2000);
}

function savesPoses(){
	brain.saveData();
}


function poseNetReady(){
	console.log('ready!');
}
//pose収得
function gotPoses(poses){
	//console.log(poses);
	if(poses.length > 0){
		pose = poses[0].pose;
		skeleton = poses[0].skeleton;

		if(state == 'collecting'){
			let inputs = [];
			for(let i = 0; i < pose.keypoints.length; i++){
			let x = pose.keypoints[i].position.x;
			let y = pose.keypoints[i].position.y;
			inputs.push(x);
			inputs.push(y);
			}
			
			let targets=[targetLabel];
			brain.addData(inputs,targets);

		}
		
	
	}
}
//表示
function draw(){
	translate(camera.width, 0);
    scale(-1, 1);
    image(camera, 0, 0, camera.width, camera.height);
	// image(camera,0,0);
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
}
//setup
function setup(){
	let canvas = createCanvas(640,480);
	canvas.parent('vid');
	background(0);
	camera = createCapture(VIDEO);
	camera.hide();
	poseNet = ml5.poseNet(camera,poseNetReady);
	poseNet.on('pose', gotPoses);

	let option ={
		inputs:34,
		outputs: 4,
		status:'classification',
		debug:true
	}
	brain = ml5.neuralNetwork(option);
}


//学習
function fetchData(){
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const trainBtn = document.querySelectorAll('#train');

		 trainBtn.forEach(btn => {
			  btn.addEventListener('click',function(){
				  const id = this.getAttribute('data-id');
				  console.log(id);
				  const url = `/predata/train/${id}`;
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
						method: 'GET',
						credentials: "same-origin"
					})
					.then(response => response.json()).then(response => {
						console.log(response);
						let predata = response.predata_name;
						let numbers = response.number;
						let path = '/predata/'+ predata;
						console.log(path);
						train(path,numbers);


					})
			  })
		 });
}

function train(path,numbers){
	let option ={
		inputs:34,
		outputs:numbers,
		status:'classification',
		debug:true
	}
	brain = ml5.neuralNetwork(option);
	brain.loadData(path,dataReady);
}

function dataReady(){
	brain.normalizeData();
	brain.train({epochs:100},finished);
	console.log('data ready');

}

function finished(){
	console.log('model trained');
	brain.save();
}

//DOM
// let url = window.location.pathname;
// if(url = '/config'){
	
// }
	document.getElementById('record').addEventListener("click",getData);
	document.getElementById('save').addEventListener("click",savesPoses);
	document.getElementById('train').addEventListener("click",fetchData);
 