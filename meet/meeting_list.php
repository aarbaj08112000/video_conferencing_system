<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Meeting List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
  <h5 class="text-center">Meeting List</h5>
  <table class="table" id="meetingTable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">id</th>
        <th scope="col">Room Name</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      get_meet_list();


    });
    function get_meet_list() {
      $.ajax({
        type: "POST",
        url: "get_all_meet.php",
        data: [],
        success: function(res) {
          console.log(res);
            var response = JSON.parse(res)
          if (response.success == 1) {
            var meetingList = response.result_arr;

            $('#meetingTable tbody').html();
            $.each(meetingList, function(index, meeting) {
              $('#meetingTable tbody').append(
                '<tr>' +
                '<td>' + (index + 1) + '</td>' +
                '<td>' + meeting._id + '</td>' +
                '<td>' + meeting.roomName + '</td>' +
                '</tr>'
              );
            });
          }
        },
        error: function(error) {
          console.error("Error:", error);
        },
      });
    }
  </script>
</body>
</html>
