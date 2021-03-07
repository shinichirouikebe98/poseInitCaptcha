{
    let el = document.getElementById('number');
    let el2 = document.getElementById('predata_id');
    
    if(el){
       el.addEventListener('change',hideandseek);
    }
    if(el2){
        document.getElementById('predata_id').addEventListener("change",fetchNum);
    }

    let select = document.getElementById('pose1');
    let select2 = document.getElementById('pose2');
    let select3 = document.getElementById('pose3');
    let label = document.getElementById('pose1label');
    let label2 = document.getElementById('pose2label');
    let label3 = document.getElementById('pose3label');
    let array = [select,select2,select3];
    let labels = [label,label2,label3];
    let url = window.location.pathname;

    if(url == '/predata/'){
        document.getElementById('number').addEventListener('load',hideandseek);
    }
    //このURLであれば実行してください
    if(url == '/config'){
        //配列中の要素を隠す
        for(let i = 0; i < array.length; i++){
            array[i].style.display = 'none';
            labels[i].style.display = 'none';
        }
    }

    //COMBOBOXの表示非表示
    function hideandseek(){
        let value = document.getElementById('number').value;
        
        if(value  == 1){
            select.style.display = 'block';
            select2.style.display = 'none';
            select3.style.display = 'none';
            label.style.display = 'block';
            label2.style.display = 'none';
            label3.style.display = 'none';
            addOption(value);
        }
        else if(value == 2){
            select.style.display = 'block';
            select2.style.display = 'block';
            select3.style.display = 'none';
            label.style.display = 'block';
            label2.style.display = 'block';
            label3.style.display = 'none';
            addOption(value);

        }
        else if(value == 3){
            for(let i = 0; i < array.length; i++){
                array[i].style.display = 'block';
                labels[i].style.display = 'block';
            }
        }
        else{
            for(let i = 0; i < array.length; i++){
                array[i].style.display = 'none';
            }
        }
        
    }

    //コンボボックス内容追加
    function addOption(value){
        let option = document.createElement("option");
        option.text = "一つ選んでください！";
        option.value = "-";
        
        for(let i = array.length; i > value ; i-- ){
            if(optionExists('-', array[1]) == false){
                array[1].appendChild(option);
            }
            else if(optionExists('-', array[2]) == false){
                array[2].appendChild(option);
            }
            else {
                console.log('exist');
            }
            
        }
        option.selected = true;
        
    }
    //特定のoptionを探す
    function optionExists ( needle, haystack )
    {
        let optionExists = false, optionsLength = haystack.length;

        while ( optionsLength-- )
        {
            if ( haystack.options[ optionsLength ].value === needle )
            {
                optionExists = true;
                break;
            }
        }
        return optionExists;
    }

    function fetchNum(){
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let predata_id = document.getElementById('predata_id').value;
        const url = `/metadata/nums/${predata_id}`;
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
                                document.getElementById('num').value = response[0].number;
                            }    
                        )
    }

    //metadata live 検索
    document.getElementById('meta_search').addEventListener("keyup", 
            function fetchMetaSearch(){
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let meta_search = document.getElementById('meta_search').value;
                let url;

                //url 設定
                if(meta_search !== ''){
                    url = `/metadata/search/${meta_search}`;
                }
                else if(meta_search === ''){
                    url = `/metadata/req`;
                }
                                // xhrリクエスト
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
                                        let table='';
                                        let i = 0;
                                        while(i < response.length){
                                            table += "<tr>";
                                            table += "<th scope='row'>"+(i+1)+"</th>";
                                            table += "<td>"+response[i].metadata_id+"</td>";
                                            table += "<td>"+response[i].name+"</td>";
                                            table +="<td><a href='/metadata/"+response[i].metadata_id+"' class='badge bg-info rounded-pill'>詳細を見る！</a></td>";
                                            table += "</tr>";
                                            i++;
                                        }   
                                        document.getElementById('metadata_tbody').innerHTML = table;
                                    })
             }     
    );

    //predata live 検索
    document.getElementById('predata_search').addEventListener("keyup", 
            function fetchMetaSearch(){
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let predata_search = document.getElementById('predata_search').value;
                let url;
                if(predata_search !== ''){
                    url = `/predata/search/${predata_search}`;
                }
                else if(predata_search === ''){
                    url = `/predata/req`;
                }
                console.log(url);
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
                                        let table='';
                                        let i = 0;
                                        while(i < response.length){
                                            table += "<tr>";
                                            table += "<th scope='row'>"+(i+1)+"</th>";
                                            table += "<td>"+response[i].predata_id+"</td>";
                                            table += "<td>"+response[i].name+"</td>";
                                            table +="<td><a href='/predata/"+response[i].predata_id+"' class='badge bg-info rounded-pill'>詳細を見る！</a></td>";
                                            table +="<td><button id='train' value='学習する！' class='btn btn-primary neumobtn' data-id="+response[i].predata_id+">学習する！</button></td>";
                                            table += "</tr>";
                                            i++;
                                        }   
                                        document.getElementById('predata_tbody').innerHTML = table;
                                    })
             }     
    );

    // //icons 検索
    document.getElementById('icons_search').addEventListener("keyup", 
    function fetchSearch(){
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let icons_search = document.getElementById('icons_search').value;
        let url;
        if(icons_search !== ''){
            url = `/poseicon/search/${icons_search}`;
        }
        else if(icons_search === ''){
            url = `/poseicon/req`;
        }
        console.log(url);
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
                                let table='';
                                let i = 0;
                                while(i < response.length){
                                    table += "<tr>";
                                    table += "<th scope='row'>"+(i+1)+"</th>";
                                    table += "<td>"+response[i].icons_id+"</td>";
                                    table += "<td>"+response[i].name+"</td>";
                                    table +="<td><a href='/poseicon/"+response[i].icons_id+"' class='badge bg-info rounded-pill'>詳細を見る！</a></td>";
                                    table += "</tr>";
                                    i++;
                                }   
                                document.getElementById('icons_tbody').innerHTML = table;
                            })
    }     
    );
    




}

