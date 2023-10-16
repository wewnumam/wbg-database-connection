let startTime = 0;
let timerInterval = 0;
let elapsedTime = 0;
let score = 0;

$(function () {
    $('#username').hide();
    $('#submitButton').hide();

    // Function to start the timer
    function startTimer() {
        startTime = new Date().getTime();
        timerInterval = setInterval(updateTimer, 1000); // Update timer every second
    }

    // Function to update and display the playtime
    function updateTimer() {
        var currentTime = new Date().getTime();
        elapsedTime = Math.floor((currentTime - startTime) / 1000); // Calculate elapsed time in seconds
        
        $("#playtime").text(elapsedTime);
    }

    $('#startButton').click(function () {
        startTimer();
    });

    $('#stopButton').click(function () {
        clearInterval(timerInterval);
        
        $('#username').show();
        $('#submitButton').show();
    });

    $('#addScoreButton').click(function () {
        score++;
        $("#score").text(elapsedTime);
    });

    $('#submitButton').click(function () {
        let record = {
            'username': $('#username').val(),
            'time': elapsedTime,
            'score': score,
            'created_at': Date.now()
        };

        $.ajax({
            url: 'system/create.php', // Replace with your server endpoint
            method: 'POST',
            data: record, // Data to send to the server
            success: function (response) {
                // Handle the server response if needed
                console.log(record);
                location.reload();
            },
            error: function (xhr, status, error) {
                // Handle errors if any
                console.log('SUBMIT FAILED');
            }
        });
    });

    $('#reloadButton').click(function () {
        location.reload();
    });
});