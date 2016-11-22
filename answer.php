<?php 
    include "header.php";
    $subject = $_GET["subject"];
?>
<script>
    function close_q(){
        $("#question_box").hide();
        console.log("hi");
    }
    
    function open_q(id){
        $("a[href='#top']").click(function() {
          $("html, body").animate({ scrollTop: 0 }, "slow");
          return false;
        });
        
        console.log(id);       
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
                        console.log(image);    
                        
                           document.getElementById("user_posts").innerHTML = "";
                        
                           document.getElementById("user_posts").innerHTML += "<div class='card-p' id='post-"+post.id+"' style='padding-bottom: -20px;'><div style='text-align: left; padding-left: 2%; text-align: left;'><div style='float: right; padding-right: 2%; font-size: 14px;'><i>"+ display_ts(post.createdAt) +"</i></div><div style='font-size: 20px; max-width: 400px;'>"+ post.title +"<br><p style='font-size: 16px;'>"+ post.content +"</p></div><center><div id='load'><i>Loading...</i></div><br>"
                           
                           
                           setTimeout(
                          function() 
                          {
                            
                            if (image == "https://firebasestorage.googleapis.com/v0/b/vantage-e9003.appspot.com/o/images%2FNO_IMAGE_WHITE.jpg?alt=media&token=ccaafe7a-6ed8-4f57-a4c2-7e7b9f5365d1"){
                                document.getElementById("load").innerHTML = "";
                            }
                            else {
                                document.getElementById("load").innerHTML = "<img onclick=\"popup_image('" + image + "')\" src='"+ image +"' class='post_image' style='text-align: center; max-height: 300px;'>";
                            }
                            
                            //$('#load').slideTop("slow");
                            
                          }, 1000);
                           /*document.getElementById("load").innerHTML = "<img src='"+ image +"' class='post_image' style='text-align: center;'>";*/
                           
                           document.getElementById("user_posts").innerHTML += "</center><br><a id='num_answers' href='question.php?id="+ post.id +"' style='padding-top: 10px; font-size: 14px; color: green; position: relative; top: 5px;'></a></div></div>";
                           
                           //$('#answers').show();
                            
                        });
                    });
                }
            });
        
        $("#question_box").show();
    }
     
    var get_subject = "<?php echo $subject; ?>";
            console.log(get_subject);

            var postsRef = firebase.database().ref('posts');
            postsRef.orderByChild("subject").equalTo(get_subject).on('value', function(snapshot) {
                var posts = [];
                var data = snapshot.val();
                for (post in data) {                       
                    posts.push(data[post]);
                }                
                posts.reverse();
                refreshUI(posts);
            });

            function refreshUI(posts) {
                console.log(JSON.stringify(posts, null, 2));
                document.getElementById("posts").innerHTML = "";
                
                if (posts.length < 1){
                    document.getElementById("posts").innerHTML += "There are no inquiries for this subject.";
                }
                
                else {
                document.getElementById("posts").innerHTML += "<button class='card' style='text-align: left;'><div style='font-size: 20px;'>"+ get_subject +"</div></button><br>";
                }
                
                posts.forEach(function(post) {

                    var answersRef = firebase.database().ref('answers');
                            answersRef.orderByChild("inquiryId").equalTo(post.id).on('value', function(snapshot) {
                                var answers = [];
                                var data = snapshot.val();

                                for (answer in data) {
                                    answers.push(data[answer]);
                                }

                                var num_answers = answers.length;
                                console.log(num_answers + "," + post.id);

                                /*if (num_answers == 1) {
                                    document.getElementById("num_answers_"+ post.id).innerHTML = "1 Answer";
                                } else {
                                    document.getElementById("num_answers_"+ post.id).innerHTML = num_answers + " Answers";
                                }*/

                            });
                    
                    document.getElementById("posts").innerHTML += "<button class='card' onclick=\"open_q('" + post.id + "')\"><div style='float: left; padding-left: 2%; text-align: left;'><div style='font-size: 20px; max-width: 400px;'>"+ post.title +"</div></div><br><div style='float: right; padding-right: 2%; font-size: 14px;'><i>"+ display_ts(post.createdAt) +"</i></div><br><br></button><br>";
                    
                });
            }
    
</script>
<br>
        <center>
            <div id="asking_box" class="modal">
                <div class="card-p" style="box-shadow: none;"><a onclick="ask();" style="float: right;">x</a>
                    <br><center>Download the iOS or Android app to ask questions!</center>
                </div>
                <br>
            </div>
             <div id="question_box" class="modal" style="position: absolute; background-color: rgba(0, 0, 0, 0.6);">
                 <div style="positon: relative; bottom: 50px;">
                 <div class="card-p" style="box-shadow: none; border: none;"><a onclick="close_q();" style="float: right; position: relative; bottom: 12px; font-weight: 600;">x</a></div>
                     <div id="user_posts"></div><div class="card-p" style="position: relative; bottom: 21;"></div>
                 </div>
                <br>
            </div>
            
            <div style="position: relative; left: 9%;">
                <div id="posts"><button class="card" style="font-size: 15px;">Loading...</button></div><br><br>
            </div>
        </center>
    </body>
</html>