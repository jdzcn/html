<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>我的笔记</title>
        <link rel="stylesheet" type="text/css" href="../css/default_full.css">
        <link rel="stylesheet" type="text/css" href="../css/header_black.css">
        <link rel="stylesheet" type="text/css" href="../css/sidebar.css">
        <link rel="stylesheet" type="text/css" href="../css/snackbar.css">
        <link rel="stylesheet" type="text/css" href="../css/lightform.css">
    </head>
    <style type="text/css">
        body {
            font-size: 1.2em;
        }
        fieldset {
            margin-top: 20px;
        }
        article ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        div ul {
            list-style-type: none;
            padding: 20px;

        }
        div li {
            padding: 10px;
        }
        article li {
            padding: 5px;
            
        }

    </style>
    <body>
        <header>
        	<h3>
        		<span onclick="document.getElementById('category').style.width='360px'" >&#9776;&nbsp;</span>
        		<script type="text/javascript">document.write(document.title)</script>
                <span onclick="add()" style="text-align:right;width:15px;float: right;">&#8285;</span>

        		<input type="search" name="search" style="float: right;"  onkeyup="upblog('key='+this.value)">
        	</h3>
        </header>

        <div id="category" class="sidebar_left">
            <span class="close" onclick="this.parentElement.style.width = '0';">&times;</span>
            <ul id="ca"></ul>
        </div>

        <div id="editblog" class="sidebar_right">
            <span class="close" onclick="this.parentElement.style.width = '0';">&times;</span>
                    <fieldset>
                    <legend>编辑笔记</legend>
                    <form id="form">
                    <!--    
                    <select id="sel" onchange="getblog()" >
                        <option value="0" selected>新建笔记</option>
                    </select>
                    -->

                    <input type="number" id="id" name="id" value="0" readonly >
                    <select id="cid" name="cid" >
                        <!-- <option value="0" selected>选择分类</option> -->
                    </select>
                    <a href="#" onclick="add_category()"  style="float: right;">新建分类</a>
                    
                    

                    <input type="text" id="title" name="title" placeholder=标题 onFocus="this.select()">
                    <textarea id="blog" name="blog" rows="18" placeholder=内容 onFocus="this.select()"></textarea>

                    <a href="#" onclick="toclipboard()"  style="float: right;">Copy to clipboard</a>
                    <a href="#" onclick="document.querySelector('textarea').value=''">Clear all</a>

                    <input type="submit" value="提交">
                    </form>
                    </fieldset>
                    
        </div> 

        <div id="sidebar_bottom" class="sidebar_bottom">
            <span class="close" onclick="this.parentElement.style.height = '0';">&times;</span>
        </div> 

        <div id="dialog" class="dialog">
            <span class="close" onclick="this.parentElement.style.display = 'none';">&times;</span>
        </div> 

        <main>
        	<article>
                <ul id="blog_list"></ul>
            </article>
        </main>
        <!--
        <footer>
            <a href="mailto:jdzcn@qq.com" >联系我们</a>
        </footer>
		-->


        <div id="snackbar"></div>

        <script type="text/javascript">

            window.onload=function() {upblog('');upca();}

            const form = document.getElementById("form");
 
            form.addEventListener('submit', function(e) {
                let v=document.getElementById("title").value;
                if(v!=null) {
                // Prevent default behavior:
                e.preventDefault();
                // Create payload as new FormData object:
                const payload = new FormData(form);
                // Post the payload using Fetch:
                fetch('blog.php', {
                method: 'POST',
                body: payload,
                })
            .then(response => response.text())
            .then(result => {
              console.log('Success:', result);
              upblog('');
              show_msg("更新成功！");
            })
            .catch(error => {
              console.error('Error:', error);
              // show_msg("Update error.");
            });
            document.getElementById("editblog").style.width = "0";
                }
                else
                    show_msg("标题不能为空!");
              });

            function upblog(str) {

              fetch("blog.php?"+str).then(function(response) {
              response.text().then(function(text) {

                    var jsonstr=JSON.parse(text);
                    // console.log(text);
                    var myul = document.getElementById("blog_list");
                    myul.innerHTML="";
                        for(var i = 0;i<jsonstr.length;i++){

                            let li=document.createElement("li");

                            let a=document.createElement("a");
                            a.href="#";
                            a.setAttribute("onclick","openblog("+jsonstr[i].id+")");
                            a.innerHTML=atob(jsonstr[i].title);
                            li.appendChild(a);

                            let d=document.createElement("a");
                            d.href="#";
                            d.setAttribute("onclick","delblog("+jsonstr[i].id+")");
                            d.setAttribute("style","float:right");
                            d.innerHTML="删除";
                            li.appendChild(d);
                            myul.appendChild(li);

                        }
              });
            });


            }

            function add() {
                document.getElementById('id').value='0';
                document.getElementById('cid').value='0';
                document.getElementById('title').value='';
                document.getElementById('blog').value='';

                document.getElementById('editblog').style.width='360px'

            }

            function toclipboard()  {
                document.querySelector("textarea").select();
                document.execCommand('copy');
                show_msg("Copy sccessfully.");
            }

            function delblog(id) {
                if(confirm('确定要删除这条笔记(id:'+id+')吗？')) {
                    fetch('blog.php?id='+id, { method: 'DELETE' })
                    .then(response => response.text())
                .then(result => {
                  console.log("delete sccessfully.",result);
                  upblog('');
                })
                .catch(error => {
                  console.log('Error:', error);
                  // show_msg("Update error.");
                });
                  }
            }

            function openblog(id) {

              fetch("blog.php?id="+id).then(function(response) {
              response.text().then(function(text) {

                var jsonstr=JSON.parse(text);
                for(var i = 0;i<jsonstr.length;i++){
                    document.getElementById("id").value=jsonstr[i].id;
                    document.getElementById("cid").value=jsonstr[i].cid;
                    document.getElementById("title").value=atob(jsonstr[i].title);
                    document.getElementById("blog").value=atob(jsonstr[i].blog);
                    document.getElementById("editblog").style.width="360px";
                }

              });
            });

            }

            function upca()
            {
                
            fetch("category.php").then(function(response) {
              response.text().then(function(text) {

                    let ca=JSON.parse(text);

                    let sel = document.getElementById("cid");
                    sel.innerHTML="";
                    let ul = document.getElementById("ca");
                    ul.innerHTML="";

                    let o=document.createElement('option');

                    o.text="选择分类";
                    o.value="0";
                    sel.appendChild(o);

                        for(var i = 0;i<ca.length;i++){

                            let option=document.createElement('option');
                            option.text=ca[i].name;
                            option.value=ca[i].cid;
                            sel.appendChild(option);

                            let li=document.createElement("li");
                            let a=document.createElement("a");
                            a.href="#";
                            a.setAttribute("onclick","document.getElementById('category').style.width='0px';upblog('cid="+ca[i].cid+"');");
                            a.innerHTML=ca[i].name;
                            li.appendChild(a);
                            ul.appendChild(li);
                        }
              });
            });

            }

            function add_category() {
                let ca = prompt("请输入新的分类名称", "");

                if (ca != null) {
                        fetch('category.php?name='+ca, {
                            method: 'POST',
                            })
                        .then(response => response.text())
                        .then(result => {
                          console.log('Success:', result);
                          upca();
                          // show_msg("更新成功！");
                        })
                        .catch(error => {
                          console.error('Error:', error);
                          // show_msg("Update error.");
                        });

                }
            }

            function show_msg(msg) {
              var x = document.getElementById("snackbar");

              // Add the "show" class to DIV
              x.className = "show";
              x.innerHTML=msg;
              // After 3 seconds, remove the show class from DIV
              setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }
        </script>
    </body>
</html>