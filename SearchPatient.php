<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            .select:hover {background-color:#f5f5f5;}
        </style>
    </head>
    <body>

        <div class="container">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Search</span>
                    <input type="text" name="search_text" id="search_text" placeholder="Search Patient" class="form-control" />
                </div>
            </div>
            <br />
            <div id="result"></div>
        </div>
    </body>
</html>


<script>
    $(document).ready(function () {

        load_data();

        function load_data(query)
        {
            $.ajax({
                url: "search.php",
                method: "POST",
                data: {query: query},
                success: function (data)
                {
                    $('#result').html(data);
                }
            });
        }
        $('#search_text').keyup(function () {
            var search = $(this).val();
            if (search != '')
            {
                load_data(search);
            } else
            {
                load_data();
            }
        });
    });
</script>