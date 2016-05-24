<!DOCTYPE html>
<html>
  <body>

    <div id="id01"></div>
    <script>
      var xmlhttp = new XMLHttpRequest();
      var url = "/data.php";

      xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      var dataset = JSON.parse(xmlhttp.responseText);
      showData(dataset);
      }
      };
      xmlhttp.open("GET", url, true);
      xmlhttp.send();

      function showData(arr) {
      var out = "";
      var i;
      for (i=0; i<arr.length; i++) {
			      out += '<p>' + arr[i].lot_id + '</p>';
      }
			      document.getElementById("id01").innerHTML = out;
			      }
    </script>
    
  </body>
  
</html>
