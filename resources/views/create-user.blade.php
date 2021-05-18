<html lang="en">
<head>
  <title>Register User</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">   
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css", rel="stylesheet", integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN", crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h2>Register User</h2><br/>
    <span class="alert-danger"> Please fill your details within 3 minutes</span>
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div><br />
    @endif

    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
    <br />
    <br />
    <div class="row">
    <div id="display" class="col-md-4">

    </div>
    </div>
  
    <form method="post" action="{{url('store-details')}}">
      @csrf
      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="Name">Name:</label>
          <input type="text" class="form-control" name="name">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="Email">Email:</label>
          <input type="text" class="form-control" name="email">
        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="date_of_birth">Date of Birth:</label>
          <input type="date" class="form-control" name="date_of_birth" required autofocus>

        </div>
      </div>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <label for="description">About yourself:</label>
          <textarea name="description" class="form-control" autocomplete="off"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
         <div class="captcha">
           <span>{!! captcha_img() !!}</span>
           <button type="button" class="btn btn-success"><i class="fa fa-refresh" id="refresh"></i></button>
         </div>
       </div>
     </div>
     <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
       <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" autocomplete="off"></div>
     </div>
     <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </form>
</div>
</body>

<script type="text/javascript">
  $('#refresh').click(function(){
    $.ajax({
     type:'GET',
     url:'refresh_captcha',
     success:function(data){
      $(".captcha span").html(data.captcha);
    }
  });
  });


  function CountDown(duration, display) {
    if (!isNaN(duration)) {
      var timer = duration, minutes, seconds;

      var interVal=  setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        $(display).html("<b>" + minutes + "m : " + seconds + "s" + "</b>");
        if (--timer < 0) {
          timer = duration;
          SubmitFunction();
          $('#display').empty();
          clearInterval(interVal)
        }
      },1000);
    }
  }


  function SubmitFunction(){
      
       alert("Your time is out. Please Try Again. Thank you.")
        location.reload();
        }

   CountDown(180,$('#display'));
 
</script>
</html>