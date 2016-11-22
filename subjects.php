<?php 
    include "header.php";
?>
<script>
    
    document.getElementById("sub").style = "";
    
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

                document.getElementById("subjects").innerHTML += "<div class='none' style='padding-bottom: 50px; '><div style='font-size: 20px;'>"+ subject.name +"</div>";
                for (i=0; i<result.length; i++){
                    var classes = result[i];
                    document.getElementById("subjects").innerHTML += "<a href='answer.php?subject="+ classes +"' style='position: relative; bottom: 30px; display: inline; color: green;' id='hover'>"+ classes +"</a> &nbsp;";
                }

                console.log(subjects.subjects);
            });
        }   
</script>
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
<br>
        <center>
            <div id="asking_box" class="modal">
                <div class="card" style="box-shadow: none; color: black;"><a onclick="ask();">x</a>
                    <center>Download the iOS or Android app to ask questions!</center>
                </div>
                <br>
            </div>
            <div style="position: relative; left: 9%;">
                <div id="subjects"></div>
            </div>
        </center>
    </body>
</html>