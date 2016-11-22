<html>

    <head>

        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <title>Vantage</title>

        <script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
        <script src="main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

        <style>
        </style>

        <script>

            firebase.auth().onAuthStateChanged(function(user) {
                var usersRef = firebase.database().ref('users');
                    usersRef.orderByChild("email").equalTo(user.email).on('value', function(snapshot) {
                        var users = [];
                        var data = snapshot.val();
                        for (c_user in data) {
                            users.push(data[c_user]);
                        }
                        users.reverse();

                        users.forEach(function(c_user) {
                             console.log("Current user: "+ c_user.username);
                             /*document.getElementById("user").innerHTML = c_user.username;*/
                        });

                    });
            });

            function put_subject(val){
                document.getElementById("subject").value = val;
            }


             /*function go_from() {
                document.getElementById
                location.href = "question.php?id="+ ext+"&t="+ post.username;
                //alert("question.php?id="+ post.id);
             }*/

            $(window).load(function(){
               $("#file_popup").hide();
            });

            $(document).ready(function() {

                $("#ask_q").click(function(){
                    $("#ask").slideToggle(450);
                });

            });

            function list_subjects() {
                document.getElementById("subject").placeholder = "Click one from the list...";

                var subjectRef = firebase.database().ref('subjects');
                subjectRef.on('value', function(snapshot) {
                    var subjects = [];
                    var data = snapshot.val();
                    for (subject in data) {
                        subjects.push(data[subject]);
                    }
                    subjects.reverse();
                    _refreshUI(subjects);
                });


                function _refreshUI(subjects) {
                    console.log(JSON.stringify(subjects, null, 2));
                    document.getElementById("subjects").innerHTML = "";
                    subjects.forEach(function(subject) {
                        var result = subject.subjects.split(",");
                        var classes;

                        document.getElementById("subjects").innerHTML += "<br>"+subject.name+" &nbsp;&nbsp;";
                        for (i=0; i<result.length; i++){
                            var classes = result[i];

                            if (classes !== ""){
                                 document.getElementById("subjects").innerHTML +=
                                "<button style='font-size: 14px; color: skyblue; background: white; border-radius: 2px; font-family: Roboto; display: inline; border: none;' onclick=\"put_subject('" + classes + "')\" id='f_subject'>"+ classes +"</button>&nbsp;";
                            }

                        }

                        document.getElementById("subjects").innerHTML += "<div class=''></div></div></span><br>";

                        console.log(subjects.subjects);
                    });
                }
            }

        </script>

    </head>

    <body style="font-family: Roboto; background-color: #EEEEEE;">
        <div id="header">
            <?php include "header.php"; ?>
        </div>
        <center id="shadow"><br><br><br><p id="content" style="font-size: 30px;"></p>
            <div class="asking_box" style="text-align: left;"><i style="margin-left: 3%;">Ask a Question</i></div>
            <div class="asking_box" style="position: relative; " id="ask">
                <input type="text" class="textbox" placeholder="Describe your assignment or problem..." style="border: 1px solid #EEE; border-radius: 0px; border-bottom: 0;" id="post_title">
                <textarea style="border: 1px solid #EEE; border-radius: 0px;" class="textarea" placeholder="What is your assignment about?" id="post_content"></textarea><br>
                <a onclick="show_uf();" class="file_button" id="add_image" style='position: relative; top: 15px;'>Add Image</a><br><br>
                <div id="file_popup">
                <div class="modal"><a onclick="hide_uf();" style="color: white; font-size: 30px; float: right; margin-right: 50px; position: relative; bottom: 80px; font-family: Sans-serif;">x</a><br><br><div class="card_no_hover">
                <input type="file" accept="image/*" id="upload_image">
                <br><br>
                     <button class="button" onclick="upload_file();">Upload</button><br><br>
                    <div id="g_file"></div>
                    </div></div></div>
                <input class="textbox" type="text" placeholder="Subject..." id="subject" style="text-align: center; border: none; padding-right: 2%; border-bottom: 1px solid #EEE;" onclick="list_subjects();" readonly>
                <div id="subjects" style="max-width: 80%;"></div>
                <br>
                <!--<input type="file" accept="image/*" id="upload_image" class="input_file">-->
                <button class="button" onclick="save_post();">Ask</button>&nbsp;
            </div><br><div id="after_post" style="positon: relative; bottom: 10px;"></div><br>
            <button class="card_no_hover"><div style="float: left; padding-left: 10px; font-size: 15px;"><i>Your Questions</i></div></button>
            <div id="user_posts">
                <div class="card_light_shadow" style='position: relative; bottom: 2px;'><i>Loading...</i></div>
            </div>

            <!--<button class="home_bottom" id="ask_question" style="outline: none;">+</button>-->
            <script>

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
                            document.getElementById("user_posts").innerHTML += "<button class='card_light_shadow' id='post-"+post.id+"' onclick=\"go('" + post.id + "','"+ post.username +"')\"><div style='text-align: left; padding-left: 2%; text-align: left;'><div style='float: right; padding-right: 2%; font-size: 14px;'><i>"+ display_ts(post.createdAt) +"</i></div><div style='font-size: 20px; max-width: 400px;'>"+ post.title +"</div><a id='num_answers_"+  post.id +"' href='question.php?id="+ post.id +"&u="+ post.username +"' style='padding-top: 10px; font-size: 14px; color: green; position: relative; top: 5px;'>0 Answers</a></div><hr></button><!--<a style='padding-top: 10px; font-size: 14px; color: red; position: relative; top: 5px; right: 10px;' onClick=\"delete_post('" + post.id + "')\">Discard</a>--><br>";
                        }

                        if (posts.length <1){
                            document.getElementById("user_posts").innerHTML = "<div class='card_light_shadow' style='position: relative; bottom: 5px;'>You have asked no questions.</div>";
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
        </center>
    </body>

</html>
