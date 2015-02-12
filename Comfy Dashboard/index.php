<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Comfy Radio | Dashboard</title>
    <!-- Core CSS - Include with every page -->
    <link rel="shortcut icon" href="pics/ComfyCorpLogoConcept.ico" type="image/vnd.microsoft.icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.min.css" rel="stylesheet">
    <link href="css/sb-admin.min.css" rel="stylesheet">
    <link href="css/plugins/social-buttons/social-buttons.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css"><!-- Scripts for loading shits -->
    <script src="js/jquery-1.11.0.js"></script>
    <!--<script src="js/comfycorp.min.js"></script>-->
    <script src="js/comfycorp.js"></script>
    <script src="js/moment.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script><!-- Page-Level Plugin Scripts - Dashboard -->
    <script>
    setInterval(refresh,2000); //Please edit this! <===== !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
    </script>
    <script src="js/sb-admin.js"></script>
</head>

<body onload="load()">
    <div id="wrapper">
        <nav class="navbar navbar-default na" style="margin-bottom: 0">
            <div class="navbar-header">
                <button class="navbar-toggle" data-target=".sidebar-collapse"
                data-toggle="collapse" type="button"><span class=
                "sr-only">Toggle navigation</span><span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button> <a class=
                "navbar-brand" href="index.html" id="brandID"><img width="40" height="40" src=
                        "https://reupload.nl/radio/pics/ComfyCorpLogoConcept.png"><b>omfy Radio</b></a>
            </div><!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <p class="dropdown-toggle" data-toggle="dropdown" id=
                    "theTimer">00:00:00</p><script type="text/javascript">
<!--
                        window.setTimeout("updateTime()", 0);// start immediately
                        window.setInterval("updateTime()", 1000);// update every second
                        function updateTime() {
                        document.getElementById("theTimer").firstChild.nodeValue =
                        new Date().toTimeString().substring(0, 8);
                        }
                        //-->
                    </script> <!-- /.dropdown-tasks -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href=
                    "#"><img height="14px;" src="pics/radio.png" width=
                    "14px"> <i class="fa fa-caret-down"></i></a>

                    <ul class="dropdown-menu dropdown-user">
                        <li><a onclick="deletecookie()"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>

                        <li style="list-style: none; display: inline">
                        </li>

                        <li><a data-target="#about" data-toggle="modal" href=
                        "#"><i class="fa fa-info fa-fw"></i> About</a></li>
                    </ul><!-- Modal -->

                    <div class="modal fade" id="about" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal"
                                    type="button">×</button>

                                    <h4 class="modal-title" id="addAlarmLabel">
                                    About</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="container">
                                        <div class="col-lg-4">
                                            <center><h1>The Comfy Hero!</h1></br><img src="https://reupload.nl/radio/pics/hero.png"></center>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-default"
                                    data-dismiss="modal" type=
                                    "button">Close</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <!-- /.dropdown-user -->
                </li><!-- /.dropdown -->
            </ul><!-- /.navbar-top-links -->
        </nav><!-- /.navbar-static-top -->

        <nav class="navbar-default navbar-static-side">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form"><img src=
                        "https://reupload.nl/radio/pics/logo.png"></div><!-- /input-group -->
                    </li>

                    <li><a href="index.html"><i class="ionicons ion-speedometer"> Dashboard</i></a></li>
                </ul><!-- /#side-menu -->
            </div><!-- /.sidebar-collapse -->
        </nav><!-- /.navbar-static-side -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" id="header"></h1>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->

            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <i class="fa fa-music fa-fw"></i> Current Stream
                        </div><!-- /.panel-heading -->

                        <div class="panel-body">
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <div id='current_placeholder'>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-list fa-fw"></i>Start Streams

                            <div class="pull-right">
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-xs"
                                    data-target="#myModal" data-toggle="modal"
                                    href="#"><i class="fa fa-plus"></i> Add</a>
                                </div><!-- Modal -->

                                <div class="modal fade" id="myModal" tabindex=
                                "-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button class="close"
                                                data-dismiss="modal" type=
                                                "button">×</button>

                                                <h4 class="modal-title" id=
                                                "myModalLabel">Add stream</h4>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Stream Name</label>
                                                    <input class="form-control"
                                                    id="newStreamName"
                                                    placeholder="Enter Name">
                                                </div>

                                                <div class="form-group">
                                                    <label>Stream URL</label>
                                                    <input class="form-control"
                                                    id="newStreamURL"
                                                    placeholder="Enter Stream URL">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-default"
                                                data-dismiss="modal" type=
                                                "button">Close</button>
                                                <button class="btn btn-primary" onclick="saveStream()" type= "button">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.panel-heading -->

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <select autofocus="true" class="form-control" id="streamselect">
                                            
                                    </select>
                                    <br>
                                </div>
                                <div class="col-lg-5 col-lg-5">
                                <a class="btn btn-block btn-social btn-dropbox" onclick="startstream()"><i class="fa fa-check"></i> Start Stream</a>
                                <br>
                                </div>
                                <div class="col-lg-5 col-lg-5">
                                <a class="btn btn-block btn-social btn-pinterest" onclick="stopstream()"><i class="fa fa-times"></i> Stop Stream</a>
                                </div>
                                <br>
                                <div class="col-lg-10"><div id="alert_placeholder"></div></div><!-- /.col-lg-8 (nested) -->
                            </div><!-- /.row -->
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                    <!-- /.panel -->
                </div><!-- /.col-lg-8 -->

                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Alarm

                            <div class="pull-right">
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-xs"
                                    data-target="#addAlarm" data-toggle="modal"
                                    href="#" onclick="hideupdatebuttons()"><i class="fa fa-plus"></i> Add</a>
                                </div><!-- Modal -->

                                <div class="modal fade" id="addAlarm" tabindex=
                                "-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button class="close"
                                                data-dismiss="modal" type=
                                                "button">×</button>

                                                <h4 class="modal-title" id=
                                                "addAlarmLabel">Add Alarm</h4>
                                            </div>

                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="col-lg-4">
                                                        <div class='well'>
                                                            <div class=
                                                            "form-group">
                                                            <label>Alarm Type</label>
                                                                <label>Select Time of Alarm</label>
                                                                <div class=
                                                                'input-group date'
                                                                id=
                                                                'datetimepicker1'>
                                                                <input id="timeAlarm" placeholder="Time" class="form-control"
                                                                    type='text'>
                                                                <span class="input-group-addon"><span class="fa fa-clock-o"></span>
																</span>
                                                                </div>
                                                                </br>
                                                                <label>Alarm Description</label>
                                                                <input id="newAlarmDesc" class="form-control" placeholder="Description">
                                                                </br>
                                                                <label>Select Stream</label>
                                                                <select class="form-control" id="streamselect2">
                                                                </select>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <script type="text/javascript">
                                                            $(function () 
                                                            {
                                                                $('#datetimepicker1').datetimepicker(
                                                                {
                                                                    format: 'YYYY-MM-DD HH:mm:ss',
                                                                    pickDate: true,
                                                                    pickSeconds: false,
                                                                    pick12HourFormat: false  
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-danger" data-dismiss="modal" id="remove-btn-alarm" onclick="removealarm()" type="button">Remove</button>
                                                <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                                                <button onclick="saveAlarm()" class="btn btn-primary" type="button" id="add-btn-alarm">Save alarm</button>
                                                <button onclick="updateAlarm()" class="btn btn-primary" type="button" id="update-btn-alarm">Save changes</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div><!-- /.panel-heading -->

                            <div class="panel-body">
                                <div class="list-group" id="alarmselect">
                                </div>
                            </div><!-- /.panel-body -->
                        </div><!-- /.col-lg-4 -->
                    </div><!-- /.row -->
                </div><!-- /#page-wrapper -->
            </div><!-- /#wrapper -->
        </div>
    </div>
</body>
</html>
