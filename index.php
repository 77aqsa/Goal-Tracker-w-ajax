<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="http://cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="http://cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <link rel="stylesheet" href="goals.css" />
    <title>Goal Tracker</title>
</head>
<body>
    <div id="container">
        <h1>New Goal</h1>
        <form action="insert.php" method="post" class="form">
            <input type="hidden" id="id" name="id">
            <label for="cat">Category</label>
            <select name="cat" id="cat" class="cat">
                <option value="0">Personal</option>
                <option value="1">Professional</option>
                <option value="2">Other</option>
            </select>
            <label for="text">Goal</label>
            <textarea name="text" id="text" class="text"></textarea>
            <label for="goaldate">Date</label>
            <input type="date" id="goaldate" name="goaldate" class="goaldate"/>
            <label for="complete">Goal Completed</label>
            <input type="checkbox" id="complete" class="complete" name="complete"/><br/>
            <button type="submit" id="submit">Submit Goal</button>
            <div id="goals"></div>
        </form>

        <script>
            document.getElementById('submit').addEventListener('click', postForm);
            //document.getElementById('submit').addEventListener('click', loadGoals);

            function postForm(e){
                e.preventDefault();

                //var id = document.getElementById('id').value;
                var cat = document.getElementById('cat').value;
                var text = document.getElementById('text').value;
                var date = document.getElementById('goaldate').value;

                var complete;
                if (document.getElementById('complete').checked){
                    complete = 1;
                }
                else{
                    complete = 0;
                }
                
                var params = "cat="+cat+"&text="+text+"&date="+date+"&complete="+complete;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'insert.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onload = function(){
                    console.log("Goal Added...");
                }
                xhr.send(params);
            }
            // function loadGoals(){
            //     var xhr = new XMLHttpRequest();
            //     xhr.open('GET', 'load.php', true);

            //     xhr.onload = function(){
            //         if(this.status == 200){

            //             if (document.getElementById('complete').checked){
            //                 var goals = JSON.parse(this.responseText);

            //                 var output = '';

            //                 for(var i in goals){
            //                     output += '<div class="goal"></div>' +
            //                     '<a href="complete.php?id="' +
            //                     goals[i].id +
            //                     '><button class="btnComplete">Complete</button></a><strong>' +
            //                     goals[i].cat +
            //                     '</strong><p>' + goals[i].text + '</p> Goal Date: ' +
            //                     goals[i].date + '<div>';
            //                 }
            //             document.getElementById('goals').innerHTML = output;
            //             }
            //         }
            //     }
            //     xhr.send();
            // }
        </script>
        <?php
        require_once 'connect.php';
        $sql = "SELECT * FROM goals";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        print("<h2>Incomplete Goals</h2>");
        while($row = mysqli_fetch_array($result)){
            if($row['goal_complete'] == 0){
                if($row['goal_category'] == 0){
                $cat = "Personal";
                } elseif ($row['goal_category' == 1]) {
                $cat = "Professional";
                } else {
                $cat = "Other";
                }
                echo "<div class='goal'>";
                echo "<a href='complete.php?id=" . $row['goal_id'] . "'><button class='btnComplete'>Complete</button></a><strong>";
                echo  $cat . "</strong><p>" . $row['goal_text'] . "</p>Goal Date: " . $row['goal_date'];
                echo "</div>";
            }
        }

        print("<h2>Complete Goals</h2>");
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while($row = mysqli_fetch_array($result)){
            if($row['goal_complete'] != 0){
                if($row['goal_category'] == 0){
                $cat = "Personal";
                } elseif ($row['goal_category' == 1]) {
                $cat = "Professional";
                } else {
                $cat = "Other";
                }
                echo "<div class='goal'>";
                echo "<a href='delete.php?id=" . $row['goal_id'] . "'><button class='btnDelete'>Delete</button></a><strong>";
                echo  $cat . "</strong><p>" . $row['goal_text'] . "</p>Goal Date: " . $row['goal_date'];
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>