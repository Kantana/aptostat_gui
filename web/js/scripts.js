$(document).ready(function() {

    //used on index.php//

    $(function() {
        $(".downtime").tooltip({
            'placement': 'left'
        });
    });

    $(function(){
        function checkScrollPosition() {
            var top = $(window).scrollTop();
            if (top > 1) {
                $("#dimmer").fadeTo("normal",1);
            }
    }
    $(window).scroll(checkScrollPosition);
    checkScrollPosition();
    });


    //used in manage.php//


    //load viewReport on click
    $(".report").click(function() {
        var reportId = $(this).attr('id');
        var report = reportId.replace("report_", "");
        $("#reportPane").css("opacity", "0");
        $("#reportPane").load("ajax/viewReport", {"report": report}, function(response, status, xhr) {
            if (status == "error") {
                var msg = "Error: ";
                $("#reportPane").html(msg + xhr.status + " " + xhr.statusText);
            }
            else {
                $("#reportPane").fadeTo("normal",1);
            }
        });
    });

    //load editIncident on click
    $("#editIncident").click(function(event) {
        $("#incidentPane").css("opacity", "0");
        $("#incidentPane").load("ajax/editIncident", {"incident": incident}, function(response, status, xhr) {
            if (status == "error") {
                var msg = "Error: ";
                $("#incidentPane").html(msg + xhr.status + " " + xhr.statusText);
            }
            else {
                $("#incidentPane").fadeTo("normal",1);
            }
        });
        event.preventDefault();
    });

    //load viewIncident on click

    $(".incident").click(function() {
        var incidentId = $(this).attr("id");
        var incident = incidentId.replace("incident_", "");
        $("#incidentPane").css("opacity", "0");
        $("#incidentPane").load("ajax/viewIncident", {"incident": incident}, function(response, status, xhr) {
            if (status == "error") {
                var msg = "Error: ";
                $("#incidentPane").html(msg + xhr.status + " " + xhr.statusText);
            }
            else {
                $("#incidentPane").fadeTo("normal",1);
            }
        });
        $('#editIncident').show();
    });

    //filter active incidents

    $(".filter").on("click", function() {
        if ($("#showAll").hasClass("active")) {
            $("#incidentList").load("ajax/listIncident", {"showHidden": false}, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error: ";
                    $("#incidentList").html(msg + xhr.status + " " + xhr.statusText);
                }
                else {
                    $("#incidentList").fadeTo("normal",1);
                }
            });
        } else {
            $("#incidentList").load("ajax/listIncident", {"showHidden": true}, function(response, status, xhr) {
                if (status == "error") {
                    var msg = "Error: ";
                    $("#incidentList").html(msg + xhr.status + " " + xhr.statusText);
                }
                else {
                    $("#incidentList").fadeTo("normal",1);
                }
            });
        }
    });

    //redirects to newIncident on button click

    $(".newIncident").click(function() {
        window.location.href = "newIncident";
    });

    //hides edit incident button on tab change
    $("#reportTab").click(function() {
        $('#editIncident').hide();
    });

    //used in editIncident.php//

    //removes placeholder text on textarea focus
    var placeholder = $("#fieldMessage").val();
    $("#fieldMessage").focus(
        function() {
            if($(this).val() == placeholder) {
                $(this).val("");
            }
        }
    );

    //inserts placeholder text if textarea is empty
    $("#fieldMessage").blur(
        function() {
            if($(this).val() == "") {
                $(this).val(placeholder);
            }
        }
    );


    //used in newIncident.php

    //activates click-to-select functionality for reports
    /*$(function() {
        var selectedReports = new Array();
        $('#reportSelect').click(function() {
            $(".selectable").bind("mousedown", function(event) {
                event.metaKey = true;
            }).selectable({
                tolerance: 'fit',
                stop: function() {
                    var result = $( "#select-result" ).empty();
                    selectedReports.length = 0;
                    var i = 0;
                    $(".ui-selected", $("#accordion2")).each(function() {
                        var itemId = $(this).attr('id');
                        var item = itemId.replace("report_", "");
                        result.append( " #" + ( item) );
                        selectedReports[i] = item;
                        i++;
                    });
                }
            });
            $("#selectedReports").html(selectedReports);
        })
    });*/
});