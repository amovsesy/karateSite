<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('config.php');
require_once('data.php');

getSchedule();

$timestamp = time();
$dayOfWeek = date( "w", $timestamp);
$startDay = 0;

if($dayOfWeek == 0) 
{
  $startDay = -6;
}
else
{
  $startDay = -$dayOfWeek + 1;
}

$daysInCurrentMonth = date("t");

$curDay = date("j");
$curYear = date("Y");
$curMonth = date("m");

$nextMonth = $curMonth + 1;

$lastFriday = strtotime($curYear . "-" . $nextMonth . "-01 last friday");
$today = strtotime($curDay . " " . date("F") . " " . $curYear);

$isLastFriday = 0;

if(($lastFriday - $today) == 0)
{
  $isLastFriday = 1;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>.: DOJO-USA :.</title>
    <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/footer.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/schedule.css" type="text/css" media="screen" />
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'></script>
    <script type='text/javascript' src='js/jquery-ui-1.8rc3.custom.min.js'></script>
    <script type="text/javascript" src="js/weekcalendar.js"></script>
    <script type="text/javascript">
    var year = new Date().getFullYear();
  	var month = new Date().getMonth();
  	var day = new Date().getDate();

    var eventsMorning = [];
    var events = [];

    <?php
      /*
       * TODO: things to think about
       *   - when the week rolls into the next month
       *   - when the year rolls into the next year
       *   - changes per week
       *   - new schedule as of _________
       *   
       */
      $curDayOfWeek = 1;
      $curMonth -= 1;
      foreach($events as $event)
      {
        if($curDayOfWeek != $event['dayOfWeek'])
        {
          $startDay++;
          $curDayOfWeek = $event['dayOfWeek'];
        }
        
        if($event['endTimeHour'] <= 12)
        {
          echo 'eventsMorning';
        }
        else 
        {
          echo 'events';
        }
        
        echo '.push({"id":', $event['id'], ', "start": new Date(', $curYear, ', ', $curMonth, ', ', $curDay+$startDay, ', ', $event['startTimeHour'], ', ', $event['startTimeMin'], '), "end": new Date(', $curYear, ', ', $curMonth, ', ', $curDay+$startDay, ', ', $event['endTimeHour'], ', ', $event['endTimeMin'], '),"title":"', $event['title'], '"});', "\n";
      } 
    ?>
    
  	var eventData = {
  		events : events
  	};

    var eventsDataMorning = {
        events : eventsMorning
    };
    
      $(document).ready(function() {
        $('#calendarMorning').weekCalendar({
          daysToShow : 6,
          dateFormat : "",
          allowCalEventOverlap : true,
          overlapEventsSeparate: true,
          firstDayOfWeek : 1, // 0 = Sunday, 1 = Monday, 2 = Tuesday, ... , 6 = Saturday
          businessHours : {start: 6, end: 12, limitDisplay : true},
          timeslotsPerHour : 6,
          buttons : false,
          readonly: true,
          timeFormat : "h:i",
          timeSeparator : " - ",
          height: function($calendar){
            return 747;
          },
          draggable : function(calEvent, element) {
             return false;
          },
          resizable : function(calEvent, element) {
             return false;
          },
          eventRender : function(calEvent, curEvent) {
            if(calEvent.end.getTime() < new Date().getTime()) {
              curEvent.css("backgroundColor", "#aaa");
              curEvent.find(".time").css({"backgroundColor": "#999", "border":"1px solid #888"});
            }
          },
          data:eventsDataMorning
        });
        
        $('#calendar').weekCalendar({
          daysToShow : 6,
          dateFormat : "",
          allowCalEventOverlap : true,
          overlapEventsSeparate: true,
          firstDayOfWeek : 1, // 0 = Sunday, 1 = Monday, 2 = Tuesday, ... , 6 = Saturday
          businessHours : {start: 16, end: 21, limitDisplay : true},
          timeslotsPerHour : 6,
          buttons : false,
          readonly: true,
          timeFormat : "h:i",
          timeSeparator : " - ",
          height: function($calendar){
            return 602;
          },
          draggable : function(calEvent, element) {
             return false;
          },
          resizable : function(calEvent, element) {
             return false;
          },
          eventRender : function(calEvent, $event) {
            if(calEvent.end.getTime() < new Date().getTime()) {
              $event.css("backgroundColor", "#aaa");
              $event.find(".time").css({"backgroundColor": "#999", "border":"1px solid #888"});
            }
          },
          data:eventData
        });
      });
    </script>
  </head>
  
  <body>
    <div id="content">
      <?php include 'leftPanel.php'; ?>
      <div id="mainPanel">
        <div id="calendarMorning"></div>
        <div id="calendar"></div>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>