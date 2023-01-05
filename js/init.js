window.onload=function() {upcategory();upcraft();upgraph();updatedata('');}

const myweb="http://172.96.193.223/";


function showmodal(){modal.style.display = 'block';}

function updatedata(str)
{
	
fetch(myweb+"product.php"+str).then(function(response) {
  response.text().then(function(text) {
    var jsonstr=JSON.parse(text);

			var mydiv = document.querySelector("main");
			mydiv.textContent="";
			for(var i = 0;i<jsonstr.length;i++){
				
				let d=document.createElement("div");
				
				d.setAttribute('class', "img");
				let a=document.createElement("a");
				// a.href="view.php?pid="+jsonstr[i].pid;
				// a.setAttribute('onclick', "alert('"+jsonstr[i].pid+"')");
				a.setAttribute('onclick', "showmodal('"+jsonstr[i].pid+"')");

				a.href="#"
				// a.target="_blank";
  				var img = document.createElement("img");
  				img.src=myweb+"thumbnail/"+jsonstr[i].image;
  				img.alt=jsonstr[i].image;
  				a.appendChild(img);
  				
  				let desc=document.createElement("a");
  				//desc.setAttribute('class', "desc");
  				desc.href="images/"+jsonstr[i].image;
  				desc.textContent=jsonstr[i].name;
  				d.appendChild(a);
  				d.appendChild(desc);

  				mydiv.appendChild(d);
  				//console.log(jsonstr[i].name);
 
			}
  });
});

}


function upgraph()
{
fetch(myweb+"list.php?table=graph").then(function(response) {
  response.text().then(function(text) {
    var jsonstr=JSON.parse(text);

			// var aside= document.querySelector("aside");
			// let ul=document.createElement("ul");
			var list = document.getElementById('keylist');
			var graph = document.getElementById('graph');
			for(var i = 0;i<jsonstr.length;i++){
				

  			// 	var li = document.createElement("li");
					// let a=document.createElement("a");
					// a.href="#";
					
					
					
					// a.setAttribute('onclick', "updatedata('?sid=" + jsonstr[i].sid + "')");
  			// 	a.textContent=jsonstr[i].name;
  			// 	li.appendChild(a);
  			// 	ul.appendChild(li);
  			   var option = document.createElement('option');
  			   var dl_option = document.createElement('option');
				   option.text = jsonstr[i].name;
				   option.value = jsonstr[i].gid;
				   dl_option.value=jsonstr[i].name;
				   list.appendChild(dl_option);
  					graph.appendChild(option);
 
			}
			// aside.appendChild(ul);
  });
});

}

function upcraft()
{
fetch(myweb+"list.php?table=craft").then(function(response) {
  response.text().then(function(text) {
    var jsonstr=JSON.parse(text);

			// var aside= document.querySelector("aside");
			// let ul=document.createElement("ul");
			var list = document.getElementById('keylist');
			var craft = document.getElementById('craft');
			for(var i = 0;i<jsonstr.length;i++){
				

  			// 	var li = document.createElement("li");
					// let a=document.createElement("a");
					// a.href="#";
					
					
					
					// a.setAttribute('onclick', "updatedata('?sid=" + jsonstr[i].sid + "')");
  			// 	a.textContent=jsonstr[i].name;
  			// 	li.appendChild(a);
  			// 	ul.appendChild(li);
  			   var option = document.createElement('option');
  			   var dl_option = document.createElement('option');
  			   
				   option.value = jsonstr[i].cid;
				   option.text = jsonstr[i].name;
				   dl_option.value=jsonstr[i].name;
				   list.appendChild(dl_option);
				   craft.appendChild(option);
  				
 
			}
			// aside.appendChild(ul);
  });
});

}

function upcategory()
{
fetch(myweb+"list.php?table=style").then(function(response) {
  response.text().then(function(text) {
    var jsonstr=JSON.parse(text);

			var aside= document.querySelector("aside");
			var list = document.getElementById('keylist');
			var ul = document.getElementById('category');
			var style = document.getElementById('style');
			for(var i = 0;i<jsonstr.length;i++){
				

  				var li = document.createElement("li");
					let a=document.createElement("a");
					a.href="#";
					
					
					
					a.setAttribute('onclick', "updatedata('?sid=" + jsonstr[i].sid + "')");
  				a.textContent=jsonstr[i].name;
  				li.appendChild(a);
  				ul.appendChild(li);
  			   var option = document.createElement('option');
  			     var dl_option = document.createElement('option');
				   option.text = jsonstr[i].name;
				   option.value = jsonstr[i].sid;
				   dl_option.value=jsonstr[i].name;
				   list.appendChild(dl_option);
				   style.appendChild(option);
  				
 
			}
			// aside.appendChild(ul);
  });
});

}



