// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
// var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// When the user clicks on <span> (x), close the modal
function close_pd() {
  document.getElementById("myModal").style.width = "0";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.width = "0";
  }
}

  function menu() {

    document.getElementById("menu").style.width="300px";
}

function close_menu() {
  document.getElementById("menu").style.width="0";
}


function showmodal(pid) {
    if (pid=="0") {

  document.getElementById("del").style.display="none";
  document.getElementById("pid").value=pid;
  document.getElementById("result").innerHTML="";
  document.getElementById("name").value="";
  document.getElementById("images").value="";
  document.getElementById("imgstr").value="";
  document.getElementById("style").value=1;
  document.getElementById("graph").value=2;
  document.getElementById("craft").value=1;
  document.getElementById("spec").value="";
  document.getElementById("price").value="0";
  getname();
}
else {
fetch(myweb+"product.php?pid="+pid).then(function(response) {
  response.text().then(function(text) {
    var jsonstr=JSON.parse(text);
		var modal = document.getElementById("modal-content");
		modal.innerHTML="";
    var btn=document.getElementById("del");
    if (btn) btn.style.display="block";
    if(btn) {
      btn.setAttribute('onclick', "del_product("+jsonstr[0].pid+",'"+jsonstr[0].image+"')");
    }
		var pid = document.getElementById("pid");
		var name = document.getElementById("name");
		var imgstr= document.getElementById("imgstr");
		// var images = document.getElementById("images");
		var result = document.getElementById("result");
		var craft = document.getElementById("craft");
		var graph = document.getElementById("graph");
		var style = document.getElementById("style");
		var spec = document.getElementById("spec");
		var price = document.getElementById("price");

		pid.value=jsonstr[0].pid;
		name.value=jsonstr[0].name;
		imgstr.value=jsonstr[0].image;
		// images.file[0].filename=jsonstr[0].image;
		result.innerHTML="";
  				var img = document.createElement("img");
  				img.src=myweb+"../thumbnail/"+jsonstr[0].image;
  				img.style.width="100px";
  				img.style.height="100px";
  				
  				result.appendChild(img);			
		craft.value=jsonstr[0].cid;
		graph.value=jsonstr[0].gid;
		style.value=jsonstr[0].sid;
		spec.value=jsonstr[0].spec;
		price.value=jsonstr[0].price;




	

  });
});	
}
	modal.style.width = '400px';
}

    function handleFileSelect() {
    //Check File API support
    if (window.File && window.FileList && window.FileReader) {

        var files = event.target.files; //FileList object
        var output = document.getElementById("result");
        var imgs=document.getElementById("imgstr");
        imgs.value="";
        output.innerHTML="";
        var len=files.length;
        for (var i = 0; i < len; i++) {
            var file = files[i];
            //Only pics
            // if (!file.type.match('image')) continue;
            
            const maxAllowedSize = 2 * 1024 * 1024;
              if (file.size > maxAllowedSize) {
                alert('文件大小超出限制！');
                event.target.value ='';
                break;
                // Here you can ask your users to load correct file
                // alert("文件大小超出限制！")；
                // exit(0);
              }
            var picReader = new FileReader();
            picReader.addEventListener("load", function (event) {
                var picFile = event.target;
                var div = document.createElement("div");
                // div.style="display:inline";
                div.innerHTML = "<img class='pd' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>";
                output.insertBefore(div, null);
            });
            //Read the image
            picReader.readAsDataURL(file);
            imgs.value+=file.name+(i==(len-1)?"":"|");
        }
        // imgs.value=imgs.value.substr(0,(len-1));

    } else {
        console.log("Your browser does not support File API");
    }
}

document.getElementById('images').addEventListener('change', handleFileSelect, false);

  function getname() {
      var craft=document.getElementById('craft');
      var c=craft.options[craft.selectedIndex].text;

      var graph=document.getElementById('graph');
      var g=graph.options[graph.selectedIndex].text;

       var style=document.getElementById('style');
      var s=style.options[style.selectedIndex].text;     
      document.getElementById('name').value=c+g+s;
  }


  /* Sending the formData object as payload using Fetch */
 
