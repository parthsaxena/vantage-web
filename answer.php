<?php 
    $subject = $_GET["subject"];
?>
<html>
    
    <head>
         
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <title>Vantage</title>
        
        <script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
        <script src="main.js"></script>
        <script>
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
                document.getElementById("posts").innerHTML += "<div class='card_light_shadow' style='text-align: left;'><i style='margin-left: 3%;'>"+ get_subject +"</i></div>";
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
                    
                    document.getElementById("posts").innerHTML += "<button class='card_light_shadow' onclick=\"go('" + post.id + "','"+ post.username +"')\"><div style='float: left; padding-left: 2%; text-align: left;'><div style='font-size: 20px; max-width: 400px;'>"+ post.title +"</div><a id='num_answers_"+  post.id +"' href='question.php?id="+ post.id +"&u="+ post.username +"' style='padding-top: 10px; font-size: 14px; color: green; position: relative; top: 5px;'>Answer</a></div><br><div style='float: right; padding-right: 2%; font-size: 14px;'><i>"+ display_ts(post.createdAt) +"</i></div><hr></button><br>";
                    
                });
            }
        </script>
        
    </head>
    
    <body style="font-family: Roboto; background-color: #EEEEEE;">
        <?php include "header.php"; ?>
        <center><br><br><br><p style="font-size: 30px;"></p>
            <!--<div class="card" style="font-size: 30px; border-radius: 2px; max-width: auto; box-shadow: none; background-color: #424242; color: white;"></div><br>-->
            <div id="posts">
            </div>
        </center>
        <script>
        document.getElementById("search_box").value = "<?php echo $subject; ?>";
        </script>
    </body>
    
</html>