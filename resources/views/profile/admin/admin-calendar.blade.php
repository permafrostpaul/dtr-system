<x-admin-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <style>
        /* General styles */
        body {
            background-color: #1E3A8A;
            margin: 0;
            padding: 0;
        }

        /* Calendar container styles */
        .calendar-container {
            border: 2px solid #c05437;
            border-radius: 1rem;
            padding: 1rem;
            max-width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
            color: #1E3A8A;
        }

        /* FullCalendar Styles */
        .fc-event {
            border-color: #FFA500;
            color: #ffffff;
            background-color: #1e3d77;
        }

        .fc-title {
            color: #ffffff;
        }

        /* Modal styles */
        #eventModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 600px;
            padding: 1rem;
            z-index: 1000;
            overflow: auto;
            /* Rounded corners */
        }


        /* Close button */
        #closeModalButton {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #1E3A8A;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            #eventModal {
                width: 90%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        }

        @media (max-width: 480px) {

            #eventModal {
                width: 90%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 0.5rem;
            }

            #closeModalButton {
                font-size: 1.25rem;
            }
        }

        #calendar {
            width: 100%;
            height: auto;
            min-height: 500px;
            /* Ensures minimum height */
        }

        .fc-day-grid-event {
            font-size: 12px;
            /* Smaller font for mobile */
            padding: 2px;
        }

        .fc th,
        .fc td {
            padding: 2px;
            /* Larger padding for easier taps */
        }
    </style>

    <body class="bg-gray-100">
        <div class="container mx-auto px-4 py-6">
            <div class="calendar-container">
                <div id='calendar'></div>
            </div>
        </div>

        <!-- Modal -->
        <div id="eventModal" class="hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-4 sm:mx-0 relative">
                <!-- X Button -->
                <span id="closeModalButton" class="absolute top-2 right-2 cursor-pointer text-gray-600 hover:text-gray-800 text-2xl">&times;</span>
                <h2 id="eventTitle" class="text-xl font-bold mb-4"></h2>
                <p id="eventDetails" class="mb-4"></p>
                <!-- Delete Button -->
                <button id="deleteEventButton" type="button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete Event</button>

            </div>
        </div>




        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            $(document).ready(function() {
                var SITEURL = "{{ url('/') }}";
                var selectedEvent = null;

                $('#calendar').fullCalendar({
                    editable: true,
                    events: function(start, end, timezone, callback) {
                        $.when(
                            $.ajax({
                                url: SITEURL + "/full-calender",
                                dataType: 'json'
                            }),
                            $.ajax({
                                url: SITEURL + "/get-birthdays",
                                dataType: 'json'
                            })
                        ).done(function(eventsResponse, birthdaysResponse) {
                            var events = eventsResponse[0];
                            var birthdays = birthdaysResponse[0];

                            var currentYear = moment().format('YYYY');
                            birthdays.forEach(function(birthday) {
                                var startDate = moment(birthday.start, "MM-DD").year(currentYear).format('YYYY-MM-DD');

                                events.push({
                                    title: birthday.title,
                                    start: startDate,
                                    end: startDate,
                                    allDay: birthday.allDay,
                                    backgroundColor: birthday.backgroundColor,
                                    borderColor: birthday.borderColor
                                });
                            });

                            callback(events);
                        }).fail(function(xhr, status, error) {
                            console.error("Error fetching data:", error);
                        });
                    },
                    displayEventTime: false,
                    editable: true,
                    selectable: true,
                    selectHelper: true,

                    // Ensure proper selection handling for mobile view
                    select: function(start, end, allDay) {
                        var title = prompt('Event Title:');
                        if (title) {
                            var startFormatted = $.fullCalendar.formatDate(start, "Y-MM-DD");
                            var endFormatted = $.fullCalendar.formatDate(end, "Y-MM-DD");
                            $.ajax({
                                url: SITEURL + "/full-calender-ajax",
                                type: "POST",
                                data: {
                                    title: title,
                                    start_date: startFormatted,
                                    end_date: endFormatted,
                                    type: 'add',
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(data) {
                                    $('#calendar').fullCalendar('renderEvent', {
                                        id: data.id,
                                        title: title,
                                        start: startFormatted,
                                        end: endFormatted,
                                        allDay: allDay
                                    }, true);
                                    $('#calendar').fullCalendar('unselect');
                                },
                                error: function(xhr, status, error) {
                                    console.error("Error creating event:", error);
                                }
                            });
                        }
                    },
                    // Resize the calendar for mobile view
                    windowResize: function(view) {
                        $('#calendar').fullCalendar('option', 'contentHeight', window.innerWidth < 768 ? 'auto' : 600);
                    },
                    eventClick: function(event) {
                        selectedEvent = event;
                        $('#eventTitle').text(event.title);
                        $('#eventDetails').text(`Start: ${event.start.format('YYYY-MM-DD')} | End: ${event.end ? event.end.format('YYYY-MM-DD') : event.start.format('YYYY-MM-DD')}`);
                        $('#eventModal').show();
                    },
                    eventRender: function(event, element) {
                        element.css('font-size', '14px');
                        element.attr('title', event.title);
                    },
                    eventLimit: true,
                    eventLimitClick: 'popover'
                });

                // Close modal when the X button is clicked
                $('#closeModalButton').on('click', function() {
                    $('#eventModal').hide();
                });

                // Delete event
                $('#deleteEventButton').on('click', function(event) {
                    event.preventDefault();
                    if (selectedEvent) {
                        $.ajax({
                            url: SITEURL + '/full-calender-ajax',
                            type: "POST",
                            data: {
                                id: selectedEvent.id,
                                type: 'delete',
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#calendar').fullCalendar('removeEvents', selectedEvent.id);
                                $('#eventModal').hide();
                                selectedEvent = null;
                            },
                            error: function(xhr, status, error) {
                                console.error("Error deleting event:", error);
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</x-admin-layout>