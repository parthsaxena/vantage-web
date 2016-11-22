<?php
    include "header.php";
?>
<br>
<center>
            <div id="question_box" class="modal" style="position: absolute; background-color: rgba(0, 0, 0, 0.4); bottom: 20px;">
                 <div style="positon: relative; bottom: 50px;" id="contents">
                 <div class="card-p" style="box-shadow: none; border: none;"><a onclick="close_q();" style="float: right; position: relative; bottom: 12px; font-weight: 600; color: black;">x</a></div>
                    <div id="inq"></div>
                     <div id="answers2"></div>
                 </div>
                <br>
            </div>
<script>



    function close_ask(){
        $("#asking_box").toggle();
    }

    function close_q(){
        $("#question_box").toggle();
    }

    function test(id){
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
                        console.log("DATA INCOMING: " + data[post]);
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

                           document.getElementById("inq").innerHTML = "";

                           document.getElementById("inq").innerHTML += "<div class='card-p' id='post-"+post.id+"' style='padding-bottom: -20px;'><div style='text-align: left; padding-left: 2%; text-align: left;'><div style='float: right; padding-right: 2%; font-size: 14px;'><i>"+ display_ts(post.createdAt) +"</i></div><div style='font-size: 20px; max-width: 400px;'>"+ post.title +"<br><p style='font-size: 16px;'>"+ post.content +"</p></div><center><div id='load'><i>Loading...</i></div><br><br>"


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

                           document.getElementById("inq").innerHTML += "</center><br><a id='num_answers' href='question.php?id="+ post.id +"' style='padding-top: 10px; font-size: 14px; color: green; position: relative; top: 5px;'></a></div></div>";

                           //$('#answers').show();

                        });

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

                            answers = [];

                        });


                        function a_refreshUI(answers){
                            answers.forEach(function(answer){

                                var storageRef = firebase.storage().ref();

                                var imageRef = storageRef.child('images/'+ answer.image);

                                imageRef.getDownloadURL().then(function(url){
                                var image = url;

                                console.log(user.uid);

                                      //document.getElementById("answers").innerHTML = "";
                                      document.getElementById("answers2").innerHTML = "<div class='card-p' style='padding-bottom: -20px;'><div style='text-align: left; padding-left: 2%; text-align: left;'><div style='float: right; padding-right: 2%; font-size: 14px;'><i>"+ display_ts(answer.createdAt) +"</i></div><div style='font-size: 20px; max-width: 400px;'><br><p style='font-size: 16px;'>"+ answer.content +"</p><div id='load_a' style='font-size: 15px;'><i>Loading...</i></div><br>";


                                       setTimeout(
                                      function()
                                      {

                                        if (image == "https://firebasestorage.googleapis.com/v0/b/vantage-e9003.appspot.com/o/images%2FNO_IMAGE_WHITE.jpg?alt=media&token=ccaafe7a-6ed8-4f57-a4c2-7e7b9f5365d1"){
                                            document.getElementById("load_a").innerHTML = "";
                                        }
                                        else {
                                            document.getElementById("load_a").innerHTML = "<a href='"+image+"' target='_blank' style='font-size: 15px; color: green;'>View Image</a>";
                                        }

                                      }, 1000);

                                       document.getElementById("answers2").innerHTML += "</div></div>";

                                      console.log(answer.content);
                                      //document.getElementById("num_answers").innerHTML = answers.length;

                                });
                               });
                            }

                        });

                    });
                }
            });

        $("#question_box").show();
    }

    firebase.auth().onAuthStateChanged(function(user) {
                        var current_user = firebase.auth().currentUser;
                        var email = current_user.email;
                        var uid = current_user.uid;

                        //.orderByChild("username").equalTo(uid)

                        var postsRef = firebase.database().ref('posts');
                        postsRef.orderByChild("username").equalTo(uid).on('value', function(snapshot) {
                        var posts = [];
                        var data = snapshot.val();
                        for (post in data) {
                            posts.push(data[post]);
                            console.log(postsRef.parent.toString());
                        }
                        posts.reverse();
                        refreshUI(posts);
                    });



                    function refreshUI(posts) {

                        document.getElementById("user_posts").innerHTML = "";

                        console.log(JSON.stringify(posts, null, 2));
                        /*document.getElementById("user_posts").innerHTML = "<div class='card_light_shadow' style='font-size: 15px; height: 25px;'><div style='float: left; padding-left: 2%;'>Your Inquiries</div></div><br>";*/

                        for (i=0; i<posts.length; i++){
                            post = posts[i];
                            //var post_key = snapshot.name();
                            //document.getElementById("user_posts").innerHTML = "";
                            document.getElementById("user_posts").innerHTML += "<button class='card' id='post-"+post.id+"' onclick=\"test('" + post.id + "')\"><div style='text-align: left; padding-left: 2%; text-align: left;'><div style='float: right; padding-right: 2%; font-size: 14px;'><i>"+ display_ts(post.createdAt) +"</i></div><div style='font-size: 20px; max-width: 400px;'>"+ post.title +"</div><a id='num_answers_"+  post.id +"' style='padding-top: 10px; font-size: 14px; color: green; position: relative; top: 5px;'>0 Answers</a></div></button><!--<a style='padding-top: 10px; font-size: 14px; color: red; position: relative; top: 5px; right: 10px;' onClick=\"delete_post('" + post.id + "')\">Discard</a>--><br>";
                        }

                        if (posts.length <1){
                            document.getElementById("user_posts").innerHTML = "<div class='card' style='position: relative; bottom: 5px;'>You have asked no questions.</div>";
                        }

                        posts.forEach(function(post) {

                            var storageRef = firebase.storage().ref();

                            var imageRef = storageRef.child('images/'+ post.image);

                            imageRef.getDownloadURL().then(function(url){
                            var image = url;
                            console.log(image);

                            console.log("Post id: " + post.id);

                            var answersRef = firebase.database().ref('answers');
                            answersRef.orderByChild("inquiryID").equalTo(post.id).on('value', function(snapshot) {
                                var answers = [];
                                var data = snapshot.val();

                                for (answer in data) {
                                    answers.push(data[answer]);
                                }

                                var num_answers = answers.length;
                                console.log(answers.length + "," + post.id);

                                if (num_answers == 1) {
                                    document.getElementById("num_answers_"+ post.id).innerHTML = "1 Answer";
                                } else {
                                    document.getElementById("num_answers_"+ post.id).innerHTML = num_answers + " Answers";
                                }

                            });

                            });
                            //go();


                            console.log("Number of inq: "+ posts.length);

                        });
                        }
                    });
</script>

            <div id="asking_box" class="modal">
                <div class="card-p" style="box-shadow: none; border: none;"><a onclick="close_ask();" style="float: right; position: relative; bottom: 12px; font-weight: 600; color: black;">x</a></div>
                <div class="card-p" style="box-shadow: none;" style="position: absolute; background-color: rgba(0, 0, 0, 0.4); bottom: 20px;">
                    <center>Download the iOS or Android app to ask questions!</center>
                </div>
                <br>
                <br>
            </div>

            <div style="position: relative; left: 9%;">
                <button style="font-size: 18px; text-align: left;" class="none">Your Questions</button>
                <div id="user_posts">
                <button class="card" style="font-size: 15px;">Loading...</button>
                </div>
            </div><br><br>
            </div>
        </center>

        <style>
.none {
    width: 40%;
    height: auto;
    padding: 10px;
    border: none;
    box-shadow: 0px 1px 2px #424242;
    background-color: lightgrey;
    opacity: 0.6;
    border-radius: 0px;
    z-index: 0;
    border-bottom: 0.5px solid #E0E0E0;
    font-family: Roboto;
}
</style>
    </body>
</html>
