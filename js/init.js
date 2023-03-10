window.onload=function() {upmenu();updatedata('');}

const myweb="";


function showmodal(){modal.style.width = '400px';}
const str=['style','graph','craft'];
const des=['造型','画面','工艺'];
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
        let imgfile=myweb+"images/"+jsonstr[i].image;
				//a.setAttribute('onclick', "showmodal('"+jsonstr[i].pid+"')");
        a.setAttribute('onclick', "showimg('"+imgfile+"')");

				a.href="#"

  				var img = document.createElement("img");
          img.setAttribute('class','pd');
  				img.src=myweb+"thumbnail/"+jsonstr[i].image;
  				img.alt=jsonstr[i].image;
  				a.appendChild(img);
  				
  				let desc=document.createElement("a");
          desc.href="#";
          desc.setAttribute('onclick', "showmodal('"+jsonstr[i].pid+"')");
  				//desc.href="images/"+jsonstr[i].image;
  				desc.textContent=jsonstr[i].name;
  				d.appendChild(a);
  				d.appendChild(desc);

  				mydiv.appendChild(d);

			}
  });
});

}

function upmenu()	{
	    
    
    let menu=document.getElementById('category');
    for(let i=0;i<3;i++)  {

      let li = document.createElement("li");
      let det=document.createElement("details");
      let sum=document.createElement("summary");

      sum.appendChild(document.createTextNode("按"+des[i]+"分类")); 
      if(i==0) det.open=true;
      det.appendChild(sum);
      li.setAttribute('class','toggle');
      li.appendChild(det);
      menu.appendChild(li);

      let sel = document.getElementById(str[i]);
      fetch(myweb+"list.php?table="+str[i]).then(function(response) {
        response.text().then(function(text) {
         var jsonstr=JSON.parse(text);

       let ul=document.createElement("ul");

      for(let j = 0;j<jsonstr.length;j++){
        
            let li = document.createElement("li");
           let a=document.createElement("a");
           a.href="#";
           a.setAttribute('onclick', "updatedata('?key=" + jsonstr[j].name + "')");
          a.textContent=jsonstr[j].name;
          li.appendChild(a);
          ul.appendChild(li);
           let option = document.createElement('option');
           //let dl_option = document.createElement('option');
           option.text = jsonstr[j].name;
           let value;

           if(i==0) value=jsonstr[j].sid;
           if(i==1) value=jsonstr[j].gid;
           if(i==2) value=jsonstr[j].cid;

          option.value =value;
          sel.appendChild(option); 
      }
       
       det.appendChild(ul);
        });
      });
      
    }
}
