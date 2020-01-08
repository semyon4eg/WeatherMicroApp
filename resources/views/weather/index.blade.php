<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather Info</title>
    <style>
        body {
            height: 100%;
        }

        .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="/weather">

            <div style="margin-bottom: 10px">
                <label class="label" for="location">Location</label>
                <div>
                    <input type="text" class="input" name="location" id="location">
                </div>
            </div>

            <div style="margin-bottom: 10px">
                <label class="label" for="">Mode</label>
                <select name="mode" id="">
                        <option value="json">JSON</option>
                        <option value="xml">XML</option>
                </select>
            </div>

            <div>
                <button class="button is-link" type="submit">Submit</button>
            </div>

        </form>
    </div>
</body>
</html>
