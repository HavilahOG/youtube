<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <input type="text" class="form-control my-5" placeholder="search" name="search" id="search">

        <ul class="list-unstyled" id="results">

        </ul>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>

<script type="text/javascript">
    $('#search').on('keyup', _.debounce(function(e) {
        $value = $(this).val();
        $.ajax({
            url: "{{ route('youtube') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                search: $value,
            },
            success: function(res) {
                $("#results").empty();

                for (i = 0; i < res.length; i++) {
                    $('#results').append(
                        '<li class="media"> <img class="mr-3" src="' + res[i].snippet
                        .thumbnails
                        .default.url +
                        '" alt="Generic placeholder image"> <div class="media-body"> <a href="https://www.youtube.com/watch?v=' +
                        res[i].id.videoId +
                        '"><h5 class="mt-0 mb-1">' +
                        res[i].snippet.title.replace(/&/g, '&amp;').replace(/</g, '&lt;')
                        .replace(/"/g, '&quot;') + '</h5></a>' +
                        res[i].snippet.channelTitle.replace(/&/g, '&amp;').replace(/</g,
                            '&lt;').replace(/"/g, '&quot;') + ' </div> </li>'
                    );
                }
            }
        });
    }, 300));
</script>

</html>
