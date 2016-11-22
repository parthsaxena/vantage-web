<?php 
    $id = $_GET["id"];
    $u = $_GET["u"];
?>
<html>
    
    <head>
         
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <title>Vantage</title>
        
        <script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        
        <script>
            var id = "<?php echo $id; ?>";
            var u = "<?php echo $u; ?>";
        </script>
        <script src="main.js"></script>
        
        <script>
            
            function delete_post(pid) {
                console.log("delete posts tapped");
                var postRef = firebase.database().ref("posts");
                postRef.orderByChild("id").equalTo(pid).on('value', function(snapshot) {
                    console.log("EMIT STATUS:");
                    console.log(snapshot.val());
                    var firebaseID = Object.keys(snapshot.val())
                    console.log(firebaseID[0]);
                    var deleteRef = firebase.database().ref("posts").child(firebaseID[0]).remove();
                });
            }
            
            $(document).ready(function() {
                $("#file_popup").hide();
                $('#answers').hide();
                $("#answers4").hide();
            });
            
            // Posts
            firebase.auth().onAuthStateChanged(function(user) {
            
                var postsRef = firebase.database().ref('posts');
                postsRef.orderByChild("id").equalTo(id).on('value', function(snapshot) {
                    var posts = [];
                    var data = snapshot.val();
                    for (post in data) {                       
                        posts.push(data[post]);
                    }                 
                    posts.reverse();
                    console.log(posts);
                    refreshUI(posts);
                });
                
                
                function refreshUI(posts){
                    posts.forEach(function(post){
                        
                        var storageRef = firebase.storage().ref();
                        
                        var imageRef = storageRef.child('images/'+ post.image);

                        imageRef.getDownloadURL().then(function(url){
                        var image = url; 
                            
                           document.getElementById("user_posts").innerHTML = "";
                        
                           document.getElementById("user_posts").innerHTML += "<div class='question_card' id='post-"+post.id+"' style='padding-bottom: -20px;'><div style='text-align: left; padding-left: 2%; text-align: left;'><div style='float: right; padding-right: 2%; font-size: 14px;'><i>"+ display_ts(post.createdAt) +"</i></div><div style='font-size: 20px; max-width: 400px;'>"+ post.title +"<br><p style='font-size: 16px;'>"+ post.content +"</p></div><center><div id='load'><i>Loading...</i></div><br>"
                           
                           
                           setTimeout(
                          function() 
                          {
                            document.getElementById("load").innerHTML = "<img onclick=\"popup_image('" + image + "')\" src='"+ image +"' class='post_image' style='text-align: center; max-height: 50%;'>";
                            
                            //$('#load').slideTop("slow");
                            
                          }, 1000);
                           /*document.getElementById("load").innerHTML = "<img src='"+ image +"' class='post_image' style='text-align: center;'>";*/
                           
                           document.getElementById("user_posts").innerHTML += "</center><br><a id='num_answers' href='question.php?id="+ post.id +"' style='padding-top: 10px; font-size: 14px; color: green; position: relative; top: 5px;'></a></div><hr></div>";
                           
                           $('#answers').show();
                            
                        });
                    });
                }
                
                //Answers
            firebase.auth().onAuthStateChanged(function(user) {
                var answersRef = firebase.database().ref('answers');
                answersRef.orderByChild("inquiryID").equalTo(id).on('value', function(snapshot) {
                    var answers = [];
                    var data = snapshot.val();
                    for (answer in data) {                       
                        answers.push(data[answer]);
                    }                 
                    answers.reverse();
                    console.log(answers);
                    a_refreshUI(answers);
                    
                    if (user.uid == u){
                        $("#answers4").show();
                        document.getElementById("answers").innerHTML = "";
                        document.getElementById("length").innerHTML = "Answers ("+answers.length+")";
                    }
                    
                    else {
                       document.getElementById("answers3").innerHTML = ""; 
                    }
                    
                    answers = [];
                    
                });
                
                
                function a_refreshUI(answers){
                    answers.forEach(function(answer){
                        
                        var storageRef = firebase.storage().ref();
                        
                        var imageRef = storageRef.child('images/'+ answer.image);

                        imageRef.getDownloadURL().then(function(url){
                        var image = url; 
                        
                        console.log(user.uid);
                        
                          if (user.uid == u){
                              //document.getElementById("answers").innerHTML = "";
                              document.getElementById("answers2").innerHTML = "<div class='question_card' id='post-"+answer.id+"'><div style='text-align: left; padding-left: 2%; text-align: left;'><div style='float: right; padding-right: 2%; font-size: 14px;'><i>"+ display_ts(answer.createdAt) +"</i></div><div style='font-size: 20px;'><p style='font-size: 16px;'>"+ answer.content +"</p><br><center><img src='"+ image +"' class='post_image' style='text-align: center; max-height: 50%;'></center><br></div></div><hr></div>";
                              
                              console.log(answer.content);
                              //document.getElementById("num_answers").innerHTML = answers.length;
                          }
                        
                          else {
                              console.log("Hi");
                          }
                           
                        });
                       });
                    }
                
                });
                
            });
            
            
        </script>
        
    </head>
    
    <body style="font-family: Roboto; background-color: #EEEEEE;">
        <?php include "header.php"; ?>
        <center><br><br><p style="font-size: 30px;"></p>
            <br>
            <div class="question_card" style='text-align: left;'><i>Question</i><a style='float: right; font-size: 14px; color: red; position: relative; top: 0px; right: 10px;' onClick="delete_post('<?php echo $id; ?>'); location.href = '/'; ">Discard Inquiry</a></div>
            <div id="user_posts">
                <div class="question_card"><i>Loading...</i></div>
            </div>
            
            <div id="popup"></div>
            
            <div id="answers">
                <div class="question_card" style="position: relative; bottom: 10px;">
                    <div style="font-size: 20px;">Answer the Question</div><br>
                    <textarea style="border-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;" class="textarea" placeholder="Answer with a concise, detailed explination..." id="answer_content"></textarea><br>
                    <a onclick="show_uf();" class="file_button" id="add_image" style='position: relative; top: 15px;'>Add Image</a><br><br>
                <div id="file_popup">
                <div class="modal"><a onclick="hide_uf();" style="color: white; font-size: 30px; float: right; margin-right: 50px; position: relative; bottom: 80px; font-family: Sans-serif;">x</a><br><br><div class="card_no_hover">  
                <input type="file" accept="image/*" id="upload_image">
                <br><br>
                     <button class="button" onclick="upload_file();">Upload</button><br><br>
                    <div id="g_file"></div>
                    </div></div></div>
                    <br>
                    <button class="button" onclick="save_answer();">Answer</button>
                </div><br></div><div id="after_post"></div>
            <div id="answers3"></div><div class="question_card" style="text-align: left;" id="answers4"><i id="length">Answers</i></div><div id="answers2"></div><br>
            
        </center>
    </body>
    
</html>