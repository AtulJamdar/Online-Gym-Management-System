<?php include('db_connect.php');?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <!-- Attendance Report Button -->
                <button class="btn btn-success btn-sm float-right mr-2" id="view_report">
                    <i class="fa fa-chart-bar"></i> View Attendance Report
                </button>
            </div>
        </div>
        <div class="row">
            <!-- Existing Calendar Panel -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <b>Session Schedules</b>
                        <span class="float:right">
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right"  id="new_schedule">
                                <i class="fa fa-plus"></i> New Entry
                            </button>
                        </span>
                    </div>
                    <div class="card-body">
                        <hr>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

            <!-- Attendance Panel -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <b>Attendance Management</b>
                    </div>
                    <div class="card-body" id="attendance_section">
                        <!-- Attendance content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height:150px;
	}
	.avatar {
	    display: flex;
	    border-radius: 100%;
	    width: 100px;
	    height: 100px;
	    align-items: center;
	    justify-content: center;
	    border: 3px solid;
	    padding: 5px;
	}
	.avatar img {
	    max-width: calc(100%);
	    max-height: calc(100%);
	    border-radius: 100%;
	}
		input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
a.fc-daygrid-event.fc-daygrid-dot-event.fc-event.fc-event-start.fc-event-end.fc-event-past {
    cursor: pointer;
}
a.fc-timegrid-event.fc-v-event.fc-event.fc-event-start.fc-event-end.fc-event-past {
    cursor: pointer;
}

.attendance-status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8em;
    }
    .present { background: #d4edda; color: #155724; }
    .absent { background: #f8d7da; color: #721c24; }
    .attendance-table td { padding: 5px 10px; }
    #report_table th, #report_table td { font-size: 12px; }
</style>


<script>
	
	 $('#new_schedule').click(function(){
        uni_modal('New Schedule','manage_schedule.php')
    })

    document.addEventListener('DOMContentLoaded', function() {
        start_load()
        $.ajax({
            url: 'ajax.php?action=get_schedule', // Fixed typo in endpoint
            method: 'POST',
            success: function(resp) {
                let evt = [];
                try {
                    const schedules = JSON.parse(resp);
                    schedules.forEach(schedule => {
                        evt.push({
                            title: schedule.name,
                            data_id: schedule.id, // Store ID directly in event object
                            daysOfWeek: [parseInt(schedule.dow)], // Ensure numeric value
                            startRecur: schedule.date_from,
                            endRecur: schedule.date_to,
                            startTime: schedule.time_from,
                            endTime: schedule.time_to,
                            start: schedule.date_from // For single date comparison
                        });
                    });
                } catch (e) {
                    console.error('Error parsing schedules:', e);
                }

                const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    initialDate: '<?= date('Y-m-d') ?>',
                    events: evt,
                    eventClick: function(info) { // Correct event parameter
                        const event = info.event;
                        const scheduleId = event.extendedProps.data_id;
                        const eventDate = new Date(event.start);

                        if (eventDate < new Date()) {
                            uni_modal('Session Options', `
                                <div class="container">
                                    <button class="btn btn-primary btn-block" 
                                        onclick="takeAttendance(${scheduleId})">
                                        Take Attendance
                                    </button>
                                    <button class="btn btn-info btn-block mt-2" 
                                        onclick="viewAttendance(${scheduleId})">
                                        View Attendance
                                    </button>
                                </div>
                            `);
                        } else {
                            uni_modal('Manage Schedule', 'manage_schedule.php?id=' + scheduleId);
                        }
                    }
                });
                
                calendar.render();
                end_load();
            }
        });
    });

    // Attendance functions remain the same
    function takeAttendance(id) {
        uni_modal('Take Attendance', 'take_attendance.php?id='+id, 'large');
    }

    function viewAttendance(id) {
        uni_modal('Attendance Report', 'view_attendance.php?id='+id, 'large');
    }

    // Report button handler
    $('#view_report').click(function(){
        uni_modal('Attendance Reports', 'attendance_reports.php', 'large');
    });
</script>