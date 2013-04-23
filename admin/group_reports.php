﻿<!DOCTYPE html>
<html>
    <?php
		include 'inc/html_head.php';
        include 'inc/apiurl.php';
        include 'inc/reports.php';
        include 'inc/incidents.php';
        

        $reports = new Reports();
        $reportList = $reports->getReportsAsArray();

        $incidents = new Incidents();
        $incidentList = $incidents->getIncidentsAsArray();
	?>

                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active" id="reportTab"><a href="#tab1" data-toggle="tab">Reports</a></li>
                            <li id="incidentTab"><a href="#tab2" data-toggle="tab">Incidents</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="list_content" id="groupbox_reports">
                                    <div class="groupbox_heading">
                                        Open reports
                                        <p style="margin-right:6px" class="right">Status</p>
                                    </div>
                                    <div class="groupbox_wrapper">
                                        <div class="accordion" id="accordion2">
                                            <?php
                                                $reports->generateReportList($reportList);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="list_content_menu">

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class="list_content" id="incidentbox_list">
                                    <div class="groupbox_heading">
                                        Incidents
                                    </div>
                                    <div class="groupbox_wrapper">
                                        <ul>
                                            <?php
                                                $incidents->generateIncidentsList($incidentList);
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="list_content_menu_fat"> 
                                        <div class="btn-group" data-toggle="buttons-checkbox">
                                          <button type="button" class="btn btn-primary filter" id="all">View all</button>
                                          <button type="button" class="btn btn-primary filter" id="warning">Warning</button>
                                          <button type="button" class="btn btn-primary filter" id="critical">Critical</button>
                                          <button type="button" class="btn btn-primary filter" id="responding">Responding</button>
                                          <button type="button" class="btn btn-primary filter" id="resolved">Resolved</button>
                                          <button type="button" class="btn btn-primary filter" id="ignored">Ignored</button>
                                          <button type="button" class="btn btn-primary filter" id="internal">Internal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="list_content" id="groupbox_details">
                                <div class="groupbox_heading">
                                    Details for selected report
                                </div>
                                <div class="groupbox_wrapper" id="reportPane">
                                    Click a report to view it.
                                </div>
                                <div class="list_content_menu">
                                    <a href="#" id="newIncident" style="float: right; margin-right: 5px; margin-top: 10px; display: none;">Make new incident  </a>
                                    <a href="#" id="newMessage" style="float: right; margin-right: 5px; margin-top: 10px; display: none;">Make new message</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        

        <script type="text/javascript">


               
        </script>
        
    </body>
</html>