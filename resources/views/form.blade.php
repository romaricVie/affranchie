<!DOCTYPE html>
<html>
<head>
	<title>Upload video</title>
	<style type="text/css">
		
		.form{
             background-color: rgba(50,70,80,0.9);
             padding: 100px;
             margin: 100px;
             text-align: center;
             border-radius: 10px;
         }

         .btn{
             background-color: green;
             border-radius: 10px;
             margin-top: 20px;
             height: 25px;
             width: 100px;
             text-align: center;
         }

        .error{
             color: red;
         }


	</style>
</head>
<body>
  
  <div class="form">
  	<h1>Upload video</h1>
  	 <form method="POST" action="{{route('insert')}}"  enctype="multipart/form-data"  id="video"
>
      @csrf
  	  <input type="text" name="message">
  	  <input type="file" name="video"><br>
  	  @if ($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                  <li class="error">{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  	  <button type="submit" class="btn">Poster</button>
  </form>
  </div>
  
</body>
</html>