// Initialize Firebase
var config = {
    apiKey: "AIzaSyA62_N7yggbFRkiX5e291axflf-CYDAM3E",
    authDomain: "vantage-e9003.firebaseapp.com",
    databaseURL: "https://vantage-e9003.firebaseio.com",
    storageBucket: "vantage-e9003.appspot.com",
};
firebase.initializeApp(config);

function display_ts(date_posted) {
                var time_elapsed = Date.now() - date_posted;
                var minutes = Math.round(time_elapsed/60000);
                var hours = minutes/60;
                var days = Math.round(hours/24);
                var weeks = Math.round(days/7);
                var years = Math.round(weeks/52);
                
                var tsStr = 'a moment ago';
                
                if (years > 1) {
                    tsStr = years + ' years ago';
                } else if (weeks > 1) {
                    tsStr = weeks + ' weeks ago';
                } else if (days > 1) {
                    tsStr = days + ' days ago';
                } else if (hours > 1){
                    var rHours = Math.floor(hours);
                    var rMinutes = minutes % 60;
                    tsStr = rHours + 'h, ' + rMinutes + 'm ago';
                } else if (minutes > 1){
                    tsStr = minutes + ' min ago';
                } else if (minutes < 1){
                    return tsStr;
                }
                
                return tsStr;
            }

/* Code to get posts
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
    posts.forEach(function(post) {
        document.getElementById("posts").innerHTML += "<div class='card_light_shadow'><div class=''>"+ post.title +"</div><hr></div>";
    });
}*/

/*var subjectRef = firebase.database().ref('subjects');
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

        document.getElementById("subjects").innerHTML += "<div class='card' style='padding-bottom: 50px;'><div style='font-size: 20px;'>"+ subject.name +"</div>";
        for (i=0; i<result.length; i++){
            var classes = result[i];
            document.getElementById("subjects").innerHTML += "<a href='answer.php?subject="+ classes +"' style='position: relative; bottom: 30px; display: inline; color: green;'>"+ classes +"</a> &nbsp;";
        }
        
        document.getElementById("subjects").innerHTML += "<div class=''></div><hr></div>";
        
        console.log(subjects.subjects);
    });
}*/

var uid;

function check_user() {
    // Check if user is logged in
    firebase.auth().onAuthStateChanged(function(user) {
        
        var uid;

        var current_user = firebase.auth().currentUser;
        var email = current_user.email;
        var uid = current_user.uid;
        //alert(uid);

        if (user) {
           //document.write(uid);
        } 

        else {
           location.href = "login.php";
        }
    });
}

function get_uid() {
    
    firebase.auth().onAuthStateChanged(function(user) {

        var current_user = firebase.auth().currentUser;
        var email = current_user.email;
        var uid = current_user.uid;

        if (user) {
           //document.write(uid);
        } 

        else {
           location.href = "login.php";
        }
        
        return uid;
        
    });
}

//check_user();

//alert(uid);
            
function posts() {
    var ref = firebase.database().ref("posts/-KMRS64oZDdq5wi5y7oz");
    ref.once("value")
        .then(function(snapshot) {
        var key = snapshot.key;
        var childKey = snapshot.child("content");
        var content = snapshot.child("content").val();

        console.log(content);
    });
}

//posts();
//display_posts();
//check_user();
        
function save_post() {

    location.reload();
    var post_content = document.getElementById("post_content").value;
     var postData = {
     content: post_content
    };

    var newPostKey = firebase.database().ref().child('posts').push().key;

    var updates = {};
    updates['/posts/' + newPostKey] = postData;

    return firebase.database().ref().update(updates);
}

firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
        
    } 
    else {
        location.href = "login.php";
    }
});

function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 10; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

var file_name = "";

function save_post() {
    firebase.auth().onAuthStateChanged(function(user) {
        var current_user = firebase.auth().currentUser;
        var email = current_user.email;
        var uid = current_user.uid;
        var post_content = document.getElementById("post_content").value;
        var post_title = document.getElementById("post_title").value;
        var subject = document.getElementById("subject").value;
        var g_file = document.getElementById("g_file").innerHTML;
        
        if (post_content == "" || post_title == "" || subject == "" || g_file == ""){
            document.getElementById("after_post").innerHTML = "<div class='card_light_shadow' style='color: white; background-color: red; position: relative; top: 3px; box-shadow: none;'>You have left something empty.</div>";
            
            if (g_file == ""){
                document.getElementById("after_post").innerHTML = "<div class='card_light_shadow' style='color: white; background-color: red; position: relative; top: 3px; box-shadow: none;'>Adding an image is required.</div>";
            }
        }
        
        else {
               var postData = {
                title : post_title,
                content : post_content,
                id: makeid(),
                subject: subject,
                username: uid,
                createdAt: Date.now(),
                image: document.getElementById("g_file").innerHTML
            };
        
            var newPostKey = firebase.database().ref().child('posts').push().key;
            var updates = {};
            updates['/posts/' + newPostKey] = postData;
            firebase.database().ref().update(updates);

            document.getElementById("after_post").innerHTML = "<div class='card_light_shadow' style='color: white; background-color: green; position: relative; top: 3px; box-shadow: none;'>Your inquiry has been posted to "+ subject +".</div>";

            //location.reload(); 
            //upload_file();
            
            location.reload(); 
        }
    });

}

function save_answer() {
    firebase.auth().onAuthStateChanged(function(user) {
        var current_user = firebase.auth().currentUser;
        var email = current_user.email;
        var uid = current_user.uid;
        var answer_content = document.getElementById("answer_content").value;
        var g_file = document.getElementById("g_file").innerHTML;
        
        if (answer_content == "" || g_file == ""){
            document.getElementById("after_post").innerHTML = "<div class='card_light_shadow' style='color: white; background-color: red; position: relative; top: 3px; box-shadow: none;'>You can't submit and answer empty.</div>";
            
            if(g_file == ""){
                document.getElementById("after_post").innerHTML = "<div class='card_light_shadow' style='color: white; background-color: red; position: relative; top: 3px; box-shadow: none;'>You must add an image.</div>";
            }
        }
        
        else {
               var postData = {
                content : answer_content,
                id: makeid(),
                username: uid,
                inquiryID: id,
                createdAt: Date.now(),
                image: document.getElementById("g_file").innerHTML 
            };
        
            var newPostKey = firebase.database().ref().child('posts').push().key;
            var updates = {};
            updates['/answers/' + newPostKey] = postData;
            firebase.database().ref().update(updates);
            
            answer_content.innerHTML = "";
            
            document.getElementById("after_post").innerHTML = "<div class='card_light_shadow' style='color: white; background-color: green; position: relative; top: 3px; box-shadow: none;'>Thank you for answering. Check 'your profits' to view your points. <a href='"+ location.href +"' style='text-align: right; color: white; text-decoration: underline;'>Dismiss</a></div>";
            
           
        }
    });
}

function query_user(id){
    var ref = firebase.database().ref("authentication/users/"+id);
    ref.once("value")
        .then(function(snapshot) {
        var key = snapshot.key;
        var childKey = snapshot.child("email");
        var email = snapshot.child("email").val();

        console.log("User's email:"+ email);
        return email;
    });
}

function generate() {
  var ALPHABET = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

  var ID_LENGTH = 10;    
    
  var rtn = '';
  for (var i = 0; i < ID_LENGTH; i++) {
    rtn += ALPHABET.charAt(Math.floor(Math.random() * ALPHABET.length));
  }
  return rtn;
}

function upload_file(){
    
    // Create a root reference
    var storageRef = firebase.storage().ref();
    
    // File or Blob named mountains.jpg
    var file = document.getElementById('upload_image').files[0];
    console.log(file.name);
    
    var base_name = file.name.split(".")[0];
    var file_name = generate() + ".jpg";
    
    document.getElementById("g_file").innerHTML = file_name;
    
    console.log("New file name: "+ file_name);

    // Create the file metadata
    var metadata = {
      contentType: 'image/jpeg'
    };

    // Upload file and metadata to the object 'images/mountains.jpg'
    var uploadTask = storageRef.child('images/' + file_name).put(file, metadata);

    // Listen for state changes, errors, and completion of the upload.
    uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED, // or 'state_changed'
      function(snapshot) {
        // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
        console.log('Upload is ' + progress + '% done');
        switch (snapshot.state) {
          case firebase.storage.TaskState.PAUSED: // or 'paused'
            console.log('Upload is paused');
            break;
          case firebase.storage.TaskState.RUNNING: // or 'running'
            console.log('Upload is running');
            break;
        }
      }, function(error) {
      switch (error.code) {
        case 'storage/unauthorized':
          // User doesn't have permission to access the object
          break;

        case 'storage/canceled':
          // User canceled the upload
          break;

        case 'storage/unknown':
          // Unknown error occurred, inspect error.serverResponse
          break;
      }
    }, function() {
      // Upload completed successfully, now we can get the download URL
      var downloadURL = uploadTask.snapshot.downloadURL;
    });
    
    $("#file_popup").hide();
    document.getElementById("add_image").innerHTML = "Change Image";
}

function go(ext, t) {
    location.href = "question.php?id="+ ext+"&u="+ t;
    //alert("question.php?id="+ post.id);
}

function header(url, link, id, css){
    if (url == link){
        document.getElementById(id).style = css;
    }
}

header(location.href, "vantage.social", "1", "color: skyblue;");

function clear(){
    document.getElementById("popup").innerHTML = "";
}

function popup_image(src){
    var popup = "popup";
    
    document.getElementById("popup").innerHTML = "<div class='modal'><img src='"+ src +"' style='max-height: 70%;'><br><br><a style='font-size: 20px; color: orange; cursor: pointer; cursor: hand;' onclick=\"location.reload();\">Close</a></div>"
}

function popup_file(){
    
}

function show_uf(){
    $("#file_popup").show();
}

function hide_uf(){
    $("#file_popup").hide();
}

/*function delete_post(key){
    var postRef = firebase.database().ref('posts/'+key);
    postRef.remove();
}*/