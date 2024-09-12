<x-app-layout>
    <!-- component -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <style>
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
            .calendar-container {
                padding: 0.5rem;
                margin-left: 0;
            }

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
    </style>

    <body class="bg-gray-100">
        <div class="container mx-auto px-4 py-6">
            <div class="calendar-container">
                <div id='calendar'></div>
            </div>
        </div>

        <div id="eventModal" class=" hidden">
            <div class="relative bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                <!-- Close Button -->
                <span id="closeModalButton" class="absolute top-2 right-2 cursor-pointer text-gray-600 hover:text-gray-800 text-2xl">&times;</span>
                <h2 id="eventTitle" class="text-xl font-bold mb-4"></h2>
                <p id="eventDetails" class="mb-4"></p>
                <!-- Note: No Delete Button for user view -->
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

                $('#calendar').fullCalendar({
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
                    editable: false, // Set editable to false to prevent drag-and-drop
                    eventClick: function(event) {
                        // Only view details, no editing
                        $('#eventTitle').text(event.title);
                        $('#eventDetails').text(`Start: ${event.start.format('YYYY-MM-DD')} | End: ${event.end ? event.end.format('YYYY-MM-DD') : event.start.format('YYYY-MM-DD')}`);
                        $('#eventModal').show(); // Show the modal
                    },
                    eventRender: function(event, element) {
                        element.css('font-size', '14px');
                        element.attr('title', event.title);
                    },
                    eventLimit: true,
                    eventLimitClick: 'popover',
                    windowResize: function(view) {
                        $('#calendar').fullCalendar('option', 'contentHeight', window.innerWidth < 768 ? 'auto' : 600);
                    }
                });

                // Close modal when the X button is clicked
                $('#closeModalButton').on('click', function() {
                    $('#eventModal').hide(); // Hide the modal
                });
            });
        </script>
    </body>
</x-app-layout>