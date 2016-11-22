<script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
        <script src="main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script>
    
    function logout_user(){
        firebase.auth().signOut().then(function() {
           console.log("Success");
        }, function(error) {
           console.log("Error");
        });
    }
    
</script>
<ul>
    <li><a href="">Your Questions</a></li>
    <li><a href="">Answer Questions</a></li>
    <li><a href="">Logo</a></li>
    <li><a href="">Account Settings</a></li>
    <li><a href="">Signout</a></li>
</ul>

<style>
    
    @import url(https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese);
    
    @import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,400,400italic,700,700italic&subset=latin,latin-ext,cyrillic-ext,cyrillic,greek-ext,greek,vietnamese);
    
    @import url(https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700&subset=latin,latin-ext,greek-ext,greek,vietnamese,cyrillic,cyrillic-ext);
    
    ul {
        border:1px solid #ccc;
        border-width:1px 0;
        list-style: none;
        margin:0;
        padding:0;
        text-align: center;
        width: 100%;
        z-index: 3;
        position: fixed;
        padding: 10px;
        margin: 0 auto;
        margin-right: -3000px;
        padding-right: 3000px;
        margin-left: -3000px;
        padding-left: 3000px;
        margin-top: -100px;
        padding-top: 60px;
        height: 90px;
        font-family: Roboto;
    }

    li {
        display: inline-block;
        font-size: 15px;
        color: skyblue;
        z-index: 4;
        position: relative;
        top: 45px;
    }

    li a {
        display: inline-block;
        color: black;
        /*text-align: center;*/
        padding: 20px 16px;
        text-decoration: none;
        padding-top: 10px;
        position: relative;
        cursor: pointer; 
        cursor: hand;
    }

    li a:hover {
        color: skyblue;
    }
</style>