/*
ComfyCorp Javascript - Made for comfycorp.eu radio site
Date: 24-03-2013
Author: Joris Mathijssen 
Company: ComfyCorp (Avans Hogeschool - Breda - Netherlands)

From here is the part for Index
*/

var editingAlarm = 0;

function load() // Called when page is loaded, will call the next files
{
    checkCookie();
    getcurrent();
    getJsonFile();
    $('#remove-btn-alarm').hide();
    $('#update-btn-alarm').hide();

}

function refresh() // Called in a loop when page is loaded.
{
    getJsonFile();
    getcurrent();
}

function checkCookie() // Check cookie on login
{
    var user = getCookie("radioName");
    if (user !== "")
    {
        return;
    }
    else
    {
        window.location = 'login.html';
    }
}

function getCookie(cname) // Checks if cookie exists Could be merged with check cookie (! TODO)
{
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++)
    {
        var c = ca[i].trim();
        if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
    }
    return "";
}

function deletecookie() //Delete Cookie on logout
{
    var d = new Date();
    d.setTime(d.getTime() - (14 * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = "radioID=" + ";" + expires;
    document.cookie = "radioName=" + ";" + expires;
    window.location = 'login.html';
}

function getJsonFile() //Get the json file with info about streams alarms
{
    var selectedStream = document.getElementById('streamselect').value;
    var json;
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php',
        dataType: 'json',
        success: function(response)
        {
            json = response;
            populateSavedStreams(document.getElementById('streamselect'), json.streams);
            populateSavedStreamsAlarm(document.getElementById('streamselect2'), json.streams);
            populateSavedAlarms(document.getElementById('alarmselect'), json.alarms);
            populateHeader(document.getElementById('header'));
        }
    });
}

function populateSavedStreams(select, data) //Populate Streams
{
    var json;
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=populate',
        dataType: 'json',
        success: function(response)
        {
            //Checking json en items
            var json = response;
            var items = [];
            $.each(data, function(id, option) 
            { 
                if (option.id == document.getElementById('streamselect').value)
                { //Selected option if it was selected before
                    items.push('<option value="' + option.id + '" alt="' + option.url + '" selected>' + option.name + '<\/option>');
                }
                else
                {
                    items.push('<option value="' + option.id + '" alt="' + option.url + '">' + option.name + '<\/option>');
                }
            });
            select.innerHTML = items.join('');
        }
    });
}


function populateSavedStreamsAlarm(select, data) //Populate Streams
{
    var json;
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=populate',
        dataType: 'json',
        success: function(response)
        {
            //Checking json en items
            var json = response;
            var items = [];
            $.each(data, function(id, option) 
            { 
                if (option.id == document.getElementById('streamselect2').value)
                { //Selected option if it was selected before
                    items.push('<option value="' + option.id + '" alt="' + option.url + '" selected>' + option.name + '<\/option>');
                }
                else
                {
                    items.push('<option value="' + option.id + '" alt="' + option.url + '">' + option.name + '<\/option>');
                }
            });
            select.innerHTML = items.join('');
        }
    });
}
function populateHeader(select) //Populate Header dashboard
{
    select.innerHTML = "Dashboard of " + getCookie('radioName');
}

function populateSavedAlarms(select, data) //populate Alarms
{
    var now = Date.now();
    console.debug("Now: " +now);
    var items = [];
    $.each(data, function(id, option)
    {
        if (moment(option.time)<now) {
        items.push('<a href="#" class="list-group-item list-group-item-warning" onclick="editalarm(\'' + option.desc + '\', \'' + option.time +'\')""><i class="fa fa-bell fa-fw"><\/i> ' + option.desc + '<\/br><span class="text-muted small"><em>' + option.time + '<\/em><\/span><\/a>');
        }
        else
        {
            items.push('<a href="#" class="list-group-item" onclick="editalarm(\'' + option.desc + '\', \'' + option.time +'\')""><i class="fa fa-bell fa-fw"><\/i> ' + option.desc + '<\/br><span class="text-muted small"><em>' + option.time + '<\/em><\/span><\/a>');
        }
    });
    select.innerHTML = items.join('');
}

function startstream() //Start a stream from the website
{
    var newStreamName = document.getElementById('streamselect').value;
    var newStreamRadioID = getCookie("radioID");
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=genconfig&name=' + newStreamName + '&id=' + newStreamRadioID,
        dataType: 'json',
        success: function(response)
        {
            json = response;
            if (json.result == 'success')
            {
                bootstrap_alert.success('Success: Stream started');
                window.setTimeout(closealert, 5000);
                refresh();
            }
            else
            {
                bootstrap_alert.warning('Error: Er is een fout opgetreden (Error code: 1337)');
                window.setTimeout(closealert, 5000);
            }
        }
    });
}


function stopstream() //Stop a stream from the website
{
    var newStreamRadioID = getCookie("radioID");
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=genconfigstop',
        dataType: 'json',
        success: function(response)
        {
            json = response;
            if (json.result == 'success')
            {
                bootstrap_alert.success('Success: Stream stopped');
                window.setTimeout(closealert, 5000);
                refresh();
            }
            else
            {
                bootstrap_alert.warning('Error: Er is een fout opgetreden (Error code: 1338)');
                window.setTimeout(closealert, 5000);
            }
        }
    });
}




// 
function editalarm(desc, time) //Removes an alarm from the database
{
    var newStreamRadioID = getCookie("radioID");
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=1alarm&desc=' + desc + '&time=' + time,
        dataType: 'json',
        success: function(response)
        {
            //Checking json en items
            var json = response;
            document.getElementById('timeAlarm').value = response.ALARM_TIME;
            document.getElementById('newAlarmDesc').value = response.DESCRIPTION;
            document.getElementById('streamselect2').value = response.STREAM;
            editingAlarm = response.ALARM_ID;
            $('#addAlarm').modal('show');
            $('#remove-btn-alarm').show();
            $('#update-btn-alarm').show();
            $('#add-btn-alarm').hide();

        }
    });
}

function removealarm() //Removes an alarm from the database
{
    var newStreamRadioID = getCookie("radioID");
    var time = document.getElementById('timeAlarm').value;
    var desc = document.getElementById('newAlarmDesc').value;
    var sss;
    sss = 'http://188.166.22.194/cgi-bin/api.php?q=removealarm&desc=' + desc + '&time=' + time;
    console.debug(sss);
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=removealarm&desc=' + desc + '&time=' + time,
        dataType: 'json',
        success: function(response)
        {
            json = response;
            if (json.result == 'success')
            {
                bootstrap_alert.success('Success: Alarm removed');
                window.setTimeout(closealert, 5000);
                refresh();
            }
            else
            {
                bootstrap_alert.warning('Error: Er is een fout opgetreden (Error code: 69)');
                window.setTimeout(closealert, 5000);
            }
        }
    });
}

function hideupdatebuttons()
{
    $('#remove-btn-alarm').hide();
    $('#update-btn-alarm').hide();
    $('#add-btn-alarm').show();
    document.getElementById('timeAlarm').value = null;
    document.getElementById('newAlarmDesc').value = null;

}

function getcurrent() //Get current playing for the now playing
{
    var json;
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=getcurrent',
        dataType: 'json',
        success: function(response)
        {
            var json = response;
            if (json.result === "")
            {
                $('#current_placeholder').html('<h4 class="timeline-title">No stream playing </h4>');
            }
            else
            {
                $('#current_placeholder').html('<h4 class="timeline-title">Now playing: ' + json.result + '</h4>');
            }
        }
    });
}


function saveStream() //Save added Stream
{
    var newStreamName = document.getElementById('newStreamName').value;
    var newStreamURL = document.getElementById('newStreamURL').value;
        var newStreamRadioID = getCookie("radioID");
        $.ajax(
        {
            url: 'http://188.166.22.194/cgi-bin/api.php?q=addstream&name=' + newStreamName + '&url=' + newStreamURL + '&id=' + newStreamRadioID,
            dataType: 'json',
            success: function(response)
            {
                json = response;
                $('#myModal').modal('hide');
                getJsonFile();
                populateSavedStreams(document.getElementById('streamselect'), json.streams);
            }
        });
}

function saveAlarm() //Save added Alarm
{
    var newAlarmStream = document.getElementById('streamselect2').value;
    var newAlarmType;
    var newAlarmTime;
    newAlarmType = 0;
    newAlarmTime = document.getElementById('timeAlarm').value;
    var newAlarmDesc = document.getElementById('newAlarmDesc').value;
        if (newAlarmTime == "" || newAlarmDesc == "") {
        bootstrap_alert.warning('Warning: I think you forgot something.');
        window.setTimeout(closealert, 5000);
        $('#addAlarm').modal('hide');
    }
    else{
    var newStreamRadioID = getCookie("radioID");
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=addalarm&id=' + newStreamRadioID + '&time=' + newAlarmTime + '&type=' + newAlarmType + '&stream=' + newAlarmStream + '&desc=' + newAlarmDesc,
        dataType: 'json',
        success: function(response)
        {
            bootstrap_alert.success('Success: Alarm saved');
            window.setTimeout(closealert, 5000);
            json = response;
            $('#addAlarm').modal('hide');
            getJsonFile();
            populateSavedAlarms(document.getElementById('alarmselect'), json.alarms);
            refresh();
        }
    });
}
}

function updateAlarm() //Save added Alarm
{
    var newStreamRadioID = getCookie("radioID");
    var time = document.getElementById('timeAlarm').value;
    var desc = document.getElementById('newAlarmDesc').value;
    var newAlarmStream = document.getElementById('streamselect2').value;
    console.debug("newAlarmStream" + newAlarmStream);
    var sss = 'http://188.166.22.194/cgi-bin/api.php?q=updatealarm&alarmID=' + editingAlarm + '&newdesc=' + desc + '&newtime=' + time + '&newstream=' + newAlarmStream;
    console.debug(sss);
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=updatealarm&alarmID=' + editingAlarm + '&newdesc=' + desc + '&newtime=' + time + '&newstream=' + newAlarmStream,
        dataType: 'json',
        success: function(response)
        {
            json = response;
            if (json.result == 'success')
            {
                $('#addAlarm').modal('hide');
                bootstrap_alert.success('Success: Alarm changed');
                window.setTimeout(closealert, 5000);
                refresh();
            }
            else
            {
                $('#addAlarm').modal('hide');
                bootstrap_alert.warning('Error: Er is een fout opgetreden (Error code: 42)');
                window.setTimeout(closealert, 5000);
            }
        }
    });
}

bootstrap_alert = function() //Open alert messages
{};
bootstrap_alert.warning = function(message)
{
    $('#alert_placeholder').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span>' + message + '</span></div>');
};
bootstrap_alert.success = function(message)
{
    $('#alert_placeholder').html('</br><div class="alert alert-success alert-dismissable" id="alertmssg"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span>' + message + '</span></div>');
};

function closealert() //Close above Alerts
{
    $('#alertmssg').alert('close');
}

/*

Down here is the part for LOGIN

*/

function register()
{
    var radioRegID = document.getElementById('regID').value;
    var radioRegNaam = document.getElementById('regName').value;
    var d = new Date();
    d.setTime(d.getTime() + (14 * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toGMTString();
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=setname&name=' + radioRegNaam + '&id=' + radioRegID,
        dataType: 'json',
        success: function(response)
        {
            json = response;
            if (json.result == 'ID ' + radioRegID + ' linked to ' + radioRegNaam)
            {
                $('#myModal').modal('hide');
                document.cookie = "radioID=" + radioRegID + ";" + expires;
                document.cookie = "radioName=" + radioRegNaam + ";" + expires;
                window.location = 'index.html';
                return;
            }
        }
    });
}

function logincheck()
{
    var json;
    var json2;
    var radioNaam = document.getElementById('nameRadio').value;
    var d = new Date();
    d.setTime(d.getTime() + (14 * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toGMTString();
    bootstrap_alert = function()
    {};
    bootstrap_alert.warning = function(message)
    {
        $('#alert_placeholder').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span>' + message + '</span></div>');
    };
    $.ajax(
    {
        url: 'http://188.166.22.194/cgi-bin/api.php?q=validate&name=' + radioNaam,
        dataType: 'json',
        success: function(response)
        {
            json = response;
            if (json.result == "name " + radioNaam + " is valid")
            {
                $.ajax(
                {
                    url: 'http://188.166.22.194/cgi-bin/api.php?q=getid&name=' + radioNaam,
                    dataType: 'json',
                    success: function(response)
                    {
                        json2 = response;
                        var id = json2.result.split('to id ');
                        document.cookie = "radioID=" + id[1] + ";" + expires;
                        document.cookie = "radioName=" + radioNaam + ";" + expires;
                        window.location = 'index.html';
                    }
                });
                return;
            }
            else(json.result == "name " + radioNaam + " is invalid");
            {
                bootstrap_alert.warning('This radio was not found');
                return;
            }
        }
    });
}

