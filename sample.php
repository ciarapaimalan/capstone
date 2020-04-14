<html>
<head>
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
</head>
<body>

<script type="text/javascript">
$(document).ready(function () {
    $('#checkBtn').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("You must check at least one checkbox.");
        return false;
      }

    });
});

</script>

<p>Box Set 1</p>
<ul>
   <li><input name="BoxSelect[]" type="checkbox" value="Box 1" required><label>Box 1</label></li>
   <li><input name="BoxSelect[]" type="checkbox" value="Box 2" required><label>Box 2</label></li>
   <li><input name="BoxSelect[]" type="checkbox" value="Box 3" required><label>Box 3</label></li>
   <li><input name="BoxSelect[]" type="checkbox" value="Box 4" required><label>Box 4</label></li>
</ul>
<p>Box Set 2</p>
<ul>
   <li><input name="BoxSelect[]" type="checkbox" value="Box 5" required><label>Box 5</label></li>
   <li><input name="BoxSelect[]" type="checkbox" value="Box 6" required><label>Box 6</label></li>
   <li><input name="BoxSelect[]" type="checkbox" value="Box 7" required><label>Box 7</label></li>
   <li><input name="BoxSelect[]" type="checkbox" value="Box 8" required><label>Box 8</label></li>
</ul>
<p>Box Set 3</p>
<ul>
   <li><input name="BoxSelect[]" type="checkbox" value="Box 9" required><label>Box 9</label></li>
</ul>
<p>Box Set 4</p>
<ul>
   <li><input name="BoxSelect[]" type="checkbox" value="Box 10" required><label>Box 10</label></li>
</ul>

<input type="button" value="Test Required" id="checkBtn">

</body>
</html>