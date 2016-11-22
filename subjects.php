<html>
    
    <head>
         
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <title>Vantage</title>
        
        <script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
        <script src="main.js"></script>
        <script>
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

                document.getElementById("subjects").innerHTML += "<div class='card' style='padding-bottom: 50px;'><div style='font-size: 20px;'>"+ subject.name +"</div>";
                for (i=0; i<result.length; i++){
                    var classes = result[i];
                    document.getElementById("subjects").innerHTML += "<a href='answer.php?subject="+ classes +"' style='position: relative; bottom: 30px; display: inline; color: green;' id='hover'>"+ classes +"</a> &nbsp;";
                }

                document.getElementById("subjects").innerHTML += "<div class=''></div><hr></div>";

                console.log(subjects.subjects);
            });
        }   
        </script>
    </head>
    
    <body style="font-family: Roboto; background-color: #EEEEEE;">
        <?php include "header.php"; ?>
        <center><br><br><br><p style="font-size: 30px;"></p>
            
            Pick a subject to answer questions<br><br>
            
            <div id="subjects">
                <i>Loading...</i>
            </div>
        </center>
    </body>
    
</html>