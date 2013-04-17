﻿<?php
session_start();

include '../inc/apiurl.php';

if (isset($_POST["incident"])) {
    $_SESSION["incidentID"] = $_POST["incident"];
}

$incidentID = $_SESSION["incident"];

$url = APIURL . "incident/$incidentID";
$curl = curl_init($url);

if(isset($_POST["flag"])) {

    $arrayData = array(
                    "message" => $_POST["message"],
                    "author" => $_POST["author"],
                    "flag" => $_POST["flag"],
                    "visibility" => 1);
                    
    $jsonData = json_encode($arrayData);

    $headers = array(
                    "Accept: application/json",
                    "Content-Type: application/json");
    
    $options = array(
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "PUT",
                    CURLOPT_POSTFIELDS => $jsonData);
    
    curl_setopt_array($curl,$options);
    
    if (curl_exec($curl) === false) {
    
        echo "Curl error: " . curl_error($curl);
        exit();
    } else {
    
        echo "Message recieved.";
        exit();
    }
}
    
$options = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "GET");
    
curl_setopt_array($curl,$options);
    
$result = json_decode(curl_exec($curl),true);
$incident = $result["incident"];
    
?>
    <div id="form">
        <form name="messageForm" action="" id="messageForm">
        <br />
        <?php
            echo "Selected incident: ".$incidentID."<br /><br />";
            echo "<fieldset>";
                echo "<legend>Data</legend>";
                echo '<table border="0">';
                    echo "<tr>";
                        echo "<h4>Reports:</h4>";
                        echo "<ul>";

                        foreach ($incident["connectedReports"] as $groupName => $group) {

                            echo "<li>".$groupName."</li>";
                            echo "<ul>";

                                foreach ($group as $report) {

                                    echo "<li>".$report["checkType"]." - ".$report["errorMessage"]."</li>";

                                }
                            echo "</ul>";
                        }

                        echo "</ul>";
    ?>
                    </tr>
                </table>
                Flag: <select name="flag" id="fieldFlag">
                    <option value="CRITICAL">Critical</option>
                    <option value="WARNING">Warning</option>
                    <option value="RESPONDING">Responding</option>
                    <option value="RESOLVED">Resolved</option>
                    <option value="IGNORED">Ignored</option>
                    <option value="INTERNAL">Internal</option>
                </select>
            </fieldset>
                <br />
            <fieldset>
                <legend>Message</legend>
                Author: <input name="author" type="text" length="20" id="fieldAuthor" /><br />
                <textarea id="fieldMessage" name="message" rows="10" cols="50">Update message</textarea><br />
                <input type="submit" value="Submit" id="buttonSubmit" />
            </fieldset><br />
        </form>
    </div>
    
    <script type="text/javascript">
        var placeholder = $("#message").val();
        $("#message").focus(
            function() {
                if($(this).val() == placeholder) {
                    $(this).val("");
                }
            }
        );
        $("#message").blur(
            function() {
                if($(this).val() == "") {
                    $(this).val(placeholder);
                }
            }
        );

        $("#messageForm").submit(function(event) {
            event.preventDefault();
            var author = $("#fieldAuthor").val();
            var flag = $("#fieldFlag").val();
            var message =$("#fieldMessage").val();
            var dataString = "author=" + author + "&flag=" + flag + "&message=" + message;
            $.ajax({
                type: "POST",
                url: "newMessage.php",
                data: dataString,
                success: function(){
                    $("#reportPane").css("opacity", "0");
                    $("#reportPane").html("Message posted.");
                    $("#reportPane").fadeTo("normal",1);
                },
            });
        })
    </script>