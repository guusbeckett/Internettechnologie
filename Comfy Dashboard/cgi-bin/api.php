<?php

class radio {
    public $name;
    public $id;

    public function __construct($nams, $is) {
        $this->name = $nams;
        $this->id = $is;
    }
}
class stream {
    public $id;
    public $url;
    public $name;

    public function __construct($nams, $is, $uri) {
        $this->name = $nams;
        $this->id = $is;
        $this->url = $uri;
    }
}
class alarm {
    public $id;
    public $time;
    public $stream;
    public $type;
    public $desc;

    public function __construct($tijs, $is, $steam, $typs, $desg) {
        $this->time = $tijs;
        $this->id = $is;
        $this->stream = $steam;
        $this->type = $typs;
        $this->desc = $desg;
    }
}
class jsonstruct {
    #public $radios;
    public $streams;
    public $alarms;

    public function __construct($stims, $almr) {
        #$this->radios = $rads;
        $this->streams = $stims;
        $this->alarms = $almr;
    }
}

$con=mysqli_connect("localhost","ipac_user","kissFM","ipac_user");


function getStreams($con)
{
    #parsing streams
    $result = mysqli_query($con,"SELECT * FROM streams43");
    $s = array();
    while($row = mysqli_fetch_array($result))
    {
        $s[] = new stream($row['NAME'], $row['ID'], $row['URL']);
    }
    return $s;
}

function getAlarms($con)
{
    #parsing alarms
    $result = mysqli_query($con,"SELECT * FROM `alarm` ORDER BY `ALARM_TIME` ASC");
    $a = array();
    while($row = mysqli_fetch_array($result))
    {
        $a[] = new alarm($row['ALARM_TIME'], $row['RADIO_ID'], $row['STREAM'], $row['TYPE'], $row["DESCRIPTION"]);
    }

    return $a;
}

function getAlarm($desc, $time, $con)
{
    #parsing alarms
    $result = mysqli_query($con,"SELECT * FROM alarm WHERE `DESCRIPTION`='".$desc."' AND `TIME`='".$time."'");
    return $result;
}

function getRadios($con)
{
    #parsing radios
    $result = mysqli_query($con,"SELECT * FROM radios");
    $r = array();
    while($row = mysqli_fetch_array($result))
    {
        $r[] = new radio($row['NAME'], $row['ID']);
    }
    return $r;
}

function addStream($url, $name, $con)
{
			$stop = strpos($url, ":",6);
			if (substr_count($url, "https:/") > 0)
				$bareurl = substr($url, 8, $stop-8);
			else
				$bareurl = substr($url, 7, $stop-7);
			$ip = gethostbyname($bareurl);
			//echo $ip;
		$url = str_replace($bareurl, $ip, $url);
		//echo $url;
    $query = "INSERT INTO streams43 (URL, NAME) VALUES ('".$url."', '".$name."')";
    $result = mysqli_query($con,$query);
    return $result;
}

function addAlarm($id, $time, $stream, $type, $desc, $con)
{
    $query = "INSERT INTO alarm (RADIO_ID, ALARM_TIME, TYPE, STREAM, DESCRIPTION) VALUES ('".$id."', '".$time."', '".$type."', '".$stream."', '".$desc."')";
    $result = mysqli_query($con,$query);
    return $result;
}

function removeAlarm($desc, $time, $con)
{
    // DELETE FROM `alarm` WHERE `ALARM_ID`=2
    $timeWithoutSpace = str_replace ( "%20" , " " , $time );
    $query = "SELECT `ALARM_ID` FROM `alarm` WHERE `DESCRIPTION`='".$desc."' AND `ALARM_TIME`='".$time."'";
    $result = mysqli_query($con,$query);
    $strs = mysqli_fetch_array($result);
    $alarmID = $strs['ALARM_ID'];
    $query = "DELETE FROM `alarm` WHERE `ALARM_ID`='".$alarmID."'";
    $result = mysqli_query($con,$query);
    return $result;
}


function updateAlarm($alarmID, $newdesc, $newtime, $newstream, $con)
{
    $timeWithoutSpace = str_replace ( "%20" , " " , $newtime );
    $query = "UPDATE `alarm` SET `DESCRIPTION` = '".$newdesc."', `ALARM_TIME` = '".$timeWithoutSpace."', `STREAM` = '".$newstream."' WHERE `ALARM_ID` = '".$alarmID."'";
    $result = mysqli_query($con,$query);
    return $result;
}

function checkId($id, $con)
{
    if ($id === "")
        return false;
    foreach (getRadios($con) as $i)
    {
        if ($i->id === $id)
            return true;
    }
    return false;
}

function getId($name, $con)
{
    if ($name === "")
        return -1;
    foreach (getRadios($con) as $i)
    {
        if ($i->name === $name)
        {
            return $i->id;
        }
    }
    return -1;
}

function isValidRadioName($name, $con)
{
    if ($name === "")
        return false;
    foreach (getRadios($con) as $i)
    {
        if ($i->name === $name)
        {
            return true;
        }
    }
    return false;
}

// Check connection
if (mysqli_connect_errno())
{
	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
    echo "{\"Error\":\"MySql connection failed\"}";
}
else
{
    #$e = new jsonstruct($r, $s, $a);
    if ($_GET["q"]!=null)
    {
        switch ($_GET["q"]) {
                // echo "$_GET["q"]";
            #case 'radio':
            #   echo json_encode(getRadios($con));
            #    break;
            
            case 'alarm':
                echo json_encode(getAlarms($con));
                break;

            case '1alarm':
                if($_GET['desc'] != "" && $_GET['time'] != "")
                {
                $query = "SELECT * FROM alarm WHERE `DESCRIPTION`='".$_GET['desc']."' AND `ALARM_TIME`='".$_GET['time']."'";
                $result = mysqli_query($con, $query);
                $strs = mysqli_fetch_array($result);
                echo json_encode($strs);
                }
                break;

            case 'stream':
                echo json_encode(getStreams($con));
                break;

            case 'checkid':
                if (checkId($_GET['id'], $con))
                {
                    echo 1;
                }
                else
                    echo 0;
                break;

            case 'manual':
                echo "henk";
                break;


            case 'getcurrent':
                $handle = fopen("../settings", "r");
                $data = fread($handle, filesize("../settings"));
                fclose($handle);
                // preg_replace( "/\r|\n/", "", $data);
                $str = explode("StreamAddr:", $data);
                //var_dump($str);
                $query = "SELECT * FROM streams43 WHERE URL='".substr($str[1], 0, -2)."'";
                $result = mysqli_query($con, $query);
                $strs = mysqli_fetch_array($result);
                //echo $query;
                //var_dump($strs);
                //echo $str[1][-1];
                if (!$strs['NAME'] == NULL)
                	echo "{\"result\":\"".$strs['NAME']."\"}";
                else echo "{\"result\":\"\"}";
                //echo split(":", $data)[1];*/
                
                break;

            case 'getcurrentid':
                $handle = fopen("../settings", "r");
                $data = fread($handle, filesize("../settings"));
                fclose($handle);
                // preg_replace( "/\r|\n/", "", $data);
                $str = explode("StreamAddr:", $data);
                //var_dump($str);
                $query = "SELECT * FROM streams43 WHERE URL='".substr($str[1], 0, -2)."'";
                $result = mysqli_query($con, $query);
                $strs = mysqli_fetch_array($result);
                //echo $query;
                //var_dump($strs);
                //echo $str[1][-1];
                if (!$strs['ID'] == NULL)
                    echo "{\"result\":\"".$strs['ID']."\"}";
                else echo "{\"result\":\"\"}";
                //echo split(":", $data)[1];*/
                
                break;
                
            case 'populate':
            	echo json_encode(getStreams($con));
            	break;

            case 'getid':
                if (isValidRadioName($_GET["name"], $con))
                {
                    echo "{\"result\":\"linked to id ".getId($_GET["name"], $con)."\"}";
                }
                else
                {
                    echo "{\"result\":\"no linked id\"}";
                }
                break;

            case 'validate':
                if (isValidRadioName($_GET["name"], $con))
                {
                    echo "{\"result\":\"name ".$_GET["name"]." is valid\"}";
                }
                else
                {
                    echo "{\"result\":\"name ".$_GET["name"]." is invalid\"}";
                }
                break;

            case 'addstream': 
                if ($_GET['name'] != "" && $_GET['url'] != "" && $_GET['id'] != "")
                {
                    if (checkId($_GET['id'], $con))
                    {
                        $s = addStream($_GET['url'], $_GET['name'], $con);
                        if ($s > 0)
                        {
                            echo "{\"result\":\"success\"}";
                        }
                        else
                            die($s."shit");
                    }
                    else
                       echo "{\"error\":\"Invalid ID\"}"; 
                }
                else
                    echo "{\"error\":\"Invalid parameters\"}";
                break;

			case 'addalarm':
				if ($_GET['id'] != "" && $_GET['time'] != "" && $_GET['stream'] != "" && $_GET["type"] != "" && $_GET["desc"] != "")
				{
					if (checkId($_GET['id'], $con))
                    {
                        $s = addAlarm($_GET['id'], $_GET['time'], $_GET['stream'], $_GET['type'],  $_GET['desc'], $con);
						if ($s > 0)
                        {
                            echo "{\"result\":\"success\"}";
                        }
                        else
                            die($s."shit");
						
                    }
                    else
                       echo "{\"error\":\"Invalid ID\"}"; 
				}
                else
                    echo "{\"error\":\"Invalid parameters\"}";
                break;    

            case 'removealarm':
                if ($_GET['time'] != "" && $_GET["desc"] != "")
                {

                        $s = removeAlarm($_GET['desc'],$_GET['time'], $con);
                        if ($s > 0)
                        {
                            echo "{\"result\":\"success\"}";
                        }
                        else
                            die($s."shit");
                }
                else
                    echo "{\"error\":\"Invalid parameters\"}";
                break;     
            case 'updatealarm':
                if ($_GET["alarmID"] != "" && $_GET["newdesc"] != "" && $_GET["newtime"] != "" && $_GET["newstream"] != "")
                {

                        $s = updateAlarm($_GET["alarmID"], $_GET["newdesc"],$_GET["newtime"],$_GET["newstream"], $con);
                        if ($s > 0)
                        {
                            echo "{\"result\":\"success\"}";
                        }
                        else
                            die($s."shit");
                }
                else
                    echo "{\"error\":\"Invalid parameters\"}";
                break;  

            case genconfig:
                if ($_GET['name'] != "")
                {
                    $query = "SELECT * FROM streams43 WHERE ID='".$_GET['name']."'";
                    $result = mysqli_query($con, $query);
                    $str = mysqli_fetch_array($result);
                    //var_dump($str);
                    $handle = fopen("../settings", "w+");
                    $data = "Type:STREAMREQ\nStreamAddr:".$str['URL']."\n\n";
                    fwrite($handle, $data);
                    fclose($handle);
                    echo "{\"result\":\"success\"}";
                    break;
                }
                else
                    echo "{\"error\":\"Invalid parameters\"}";
                break;

            case genconfigstop:
                    $handle = fopen("../settings", "w+");
                    $data = "Type:STREAMREQ\nStreamAddr:STOP\n\n";
                    fwrite($handle, $data);
                    fclose($handle);
                    echo "{\"result\":\"success\"}";
                    break;

	    			case getstreamurl:

								if ($_GET['id'] != "" && $_GET['time'] != "")
								{ 
						            $alarmQuery = "SELECT * FROM alarm";
						            $alarmResult = mysqli_query($con, $alarmQuery); 
						            $clocktime = $_GET['time'];
						            $clocknumbers = explode(":", $clocktime);
						            $clocknumber = $clocknumbers[0].$clocknumbers[1];
						            $rows = array();
						            $times = array();
						            $late = array();
						            while ($row = mysqli_fetch_array($alarmResult)) 
						            {
						                $rows[] = $row;
						            }
						
						            foreach ($rows as &$value) 
						            {   
						
						                $numbers = explode(":", $value[1]);
						                $tempvar = $numbers[0].$numbers[1];
						                if ($tempvar > $clocknumber) 
						                {
						                    $times[] = $value;
						                }
						                else
						                {
						                    $late[] = $value;
						                }
						            }
						            if (count($times) == 0) 
						            {
						                sort($late);
						                $handle = fopen("../alarms", "w+");
						                $data = "Type:ALARMREQ\nAlarmAmount:1\nAlarmTextA:".$late[0][4]."\nAlarmStreamIDA:".$late[0][3]."\nAlarmTypeA:0\nAlarmTimeA:".$late[0][1]."\nend\n\n";
						                fwrite($handle, $data);
						                fclose($handle);
						                $query = "SELECT * FROM streams43 WHERE ID=".$_GET['id'];
						                $result = mysqli_query($con, $query);
						                $str = mysqli_fetch_array($result);
						                echo "StreamURL:".$str['URL']."\n\n";
						                break;
						            }
						            sort($times);
						                $handle = fopen("../alarms", "w+");
						                $data = "Type:ALARMREQ\nAlarmAmount:1\nAlarmTextA:".$times[0][4]."\nAlarmStreamIDA:".$times[0][3]."\nAlarmTypeA:0\nAlarmTimeA:".$times[0][1]."\nend\n\n";
						                fwrite($handle, $data);
						                fclose($handle);
						            //echo '<pre>';
						            //print_r($times);
								    $query = "SELECT * FROM streams43 WHERE ID=".$_GET['id'];
						            $result = mysqli_query($con, $query);
						            $str = mysqli_fetch_array($result);
						            echo "StreamURL:".$str['URL']."\n\n";
						            break;
								}
								else
								    echo "URL:NONE";
								break;

            default:
                echo "{\"error\":\"Invalid query\"}";
                break;
        }
    }
    else
        echo json_encode(new jsonstruct(getStreams($con), getAlarms($con)));
}
?>
