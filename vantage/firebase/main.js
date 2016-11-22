 // Initialize Firebase
        var config = {
            apiKey: "AIzaSyA62_N7yggbFRkiX5e291axflf-CYDAM3E",
            authDomain: "vantage-e9003.firebaseapp.com",
            databaseURL: "https://vantage-e9003.firebaseio.com",
            storageBucket: "vantage-e9003.appspot.com",
        };
        firebase.initializeApp(config);

function display_login() {
    
}


function display_posts() {
            var posts = [];
            
            var postsRef = firebase.database().ref('posts');
            postsRef.orderByChild("school").equalTo("PMS").on('value', function(snapshot) {
                var data = snapshot.val();
                var list = [];
                console.log(data);
                
                var content = "";
                
                for (post in data) {
                    postRef = firebase.database().ref('posts/' + post);
                    postRef.on('value', function(snapshot) {                                 
                        var dataPost = snapshot.val();
                        console.log(dataPost);
                        var title = dataPost.title;
                        var content = dataPost.content;
                        var image = dataPost.image;
                        
                        //document.write(content + "<br>"); 
                        
                        var individualPost = [title, content];                        
                        posts.push(individualPost);
                    });  
                }                
                posts.reverse();
                refreshUI();
            });
                    
            function refreshUI() {
                console.log(posts)
                for (content in posts) {
                    //document.write("<b>Title:</b> " + posts[content][0] + " <b>Content:</b> "+ posts[content][1] + " <br>");
                    for (i=0; i<1; i++) {
                        document.getElementById("posts").innerHTML = "<div class='post'><div  style='float: left; display: inline-block;'><table style='padding-top: 5px;'><tr><td><img id='post_img' height='50' src='../images/empty_profile_picture.jpg'></td><td>Anonymous</td></tr></table></div><br><br><br><hr style='border-top: 1px white; visibility: hidden;'><center style='position: relative; bottom: 15px;'><h3>"+  posts[content][0] +"</h3>"+ posts[content][1] +"</center></div><br>";
                    }
                } 
            }
}
            
             function check_user() {
        // Check if user is logged in
        firebase.auth().onAuthStateChanged(function(user) {
            
            var current_user = firebase.auth().currentUser;
            var email = current_user.email;
            var uid = current_user.uid;
            
            if (user) {
               document.write(email);
            } 
            
            else {
               location.href = "login.php";
            }
        });
            
        }
            
        function posts(){
            var ref = firebase.database().ref("posts/-KMRS64oZDdq5wi5y7oz");
            ref.once("value")
                .then(function(snapshot) {
                var key = snapshot.key;
                var childKey = snapshot.child("content");
                var content = snapshot.child("content").val();
                
                console.log(content);
            });
        }

        posts();

        display_posts();
        //check_user();
        
        function save_post() {
            
            //location.reload();
            
            var post_content = document.getElementById("post_content").value;
            
             var postData = {
             content: post_content
            };

            var newPostKey = firebase.database().ref().child('posts').push().key;

            var updates = {};
            updates['/posts/' + newPostKey] = postData;

            return firebase.database().ref().update(updates);
            
        }