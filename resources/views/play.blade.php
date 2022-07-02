<!DOCTYPE html>
<html>
<head>
	<title>Play</title>
</head>
<body>
     <h1>Play video</h1>
     @foreach($datas as $data)
        <video  width="320" height="240"  autoplay muted  >

         <source  src="{{asset('storage/'.$data->video)}}"  type="video/mp4">
        </video>
     @endforeach
</body>
</html>