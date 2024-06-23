<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Meeting List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style media="screen">
  .download{
    cursor: pointer;
    color: green;
  }
  .delete{
    cursor: pointer;
    color: red;
  }
</style>
</head>
<body>
  <div class="container shadow p-3 mb-5 bg-body rounded mt-5">
    <h5 class="text-center">Meeting Recording List</h5>
    <hr>
    <table class="table" id="meetingTable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">id</th>
          <th scope="col">Room</th>
          <th scope="col">Start Time</th>
          <th scope="col">End Time</th>
          <th scope="col">Download</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    get_meet_list();

    // Click event handler for deleting a meeting
    $(document).on("click", ".delete", function() {
      var dataId = $(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "delete_meet.php",
        data: {
          dataId: dataId
        },
        success: function(response) {
          var res = JSON.parse(response);
          console.log(res);
          var data = res.result_arr;
          if (res.success == 1) {
            data = JSON.parse(data);
            alert(data.message)
          }
        },
        error: function(error) {
          console.error("Error:", error);
        }
      });
    });

    // Click event handler for downloading a meeting
    $(document).on("click", ".download", function() {
      var dataId = $(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "download_meet.php",
        data: {
          dataId: dataId
        },
        success: function(response) {
          var res = JSON.parse(response);
          var data = res.result_arr;
          if (res.success == 1) {
            var newdata = JSON.parse(data);
            window.location.href = newdata.url;
          }
        },
        error: function(error) {
          console.error("Error:", error);
        }
      });
    });

  });

  function get_meet_list() {
    $.ajax({
      type: "POST",
      url: "get_all_recording_meet.php",
      data: [],
      success: function(response) {
        var response = JSON.parse(response);
        if (response.success == 1) {
          var meetingList = response.result_arr.data;
          $('#meetingTable tbody').empty();
          $.each(meetingList, function(index, meeting) {
            $('#meetingTable tbody').append(
              '<tr>' +
              '<td>' + (index + 1) + '</td>' +
              '<td>' + meeting._id + '</td>' +
              '<td>' + meeting.room + '</td>' +
              '<td>' + formatDate(meeting.startTime) + '</td>' +
              '<td>' + formatDate(meeting.endTime) + '</td>' +
              '<td class="download" data-id=' + meeting._id + '>' + "Download" + '</td>' +
              '<td class="delete" data-id=' + meeting._id + '>' + "Delete" + '</td>' +
              '</tr>'
            );
          });
        }
      },
      error: function(error) {
        console.error("Error:", error);
      }
    });
  }

  function formatDate(timestamp) {
    var date = new Date(timestamp * 1000);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var day = date.getDate();
    var month = months[date.getMonth()];
    var year = date.getFullYear();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var period = hours >= 12 ? 'PM' : 'AM';
    if (hours > 12) {
      hours -= 12;
    }
    if (minutes < 10) {
      minutes = '0' + minutes;
    }
    return day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ' ' + period;
  }
</script>

</body>
</html>
