<html>
<head>
<meta charset="utf-8"/>
<title> hello </title>
</head>
<body>

<div id="hopla"></div>
<a href="demo.php" class="ext">Mon portfolio</a>
<script>
$(document).ready(function() {
  $(".ext").on('click',function() {
    var url = "/demo.php",;
    $("#hopla").load(url);
  });
});
</script> 
<!--  <script>
    $.ajax({
        url: "/demo.php",
        data: serializedData
    });
</script> -->
</body>
</html>