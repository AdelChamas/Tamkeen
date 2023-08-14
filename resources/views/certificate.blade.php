<!DOCTYPE html>
<html lang="en">
<head>
    <title>Course Completion Certificate</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #7a96a7;
            color: #f1f1f1;
            text-align: center;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            font-family: pacifico, serif;
        }
        .name{
            font-size: 50px;
            text-decoration: underline;
            color: #1a202b;
        }
        strong{
            font-family: Sacramento;
        }
        p {
            font-size: 18px;
            line-height: 60px;
        }

        .certificate{
            width: 100%;
            margin: auto;
        }
    </style>
</head>
<body>
<div class="certificate">
    <img src="{{ public_path('storage/assets/logo.png') }}">
    <h1>Certificate of Completion</h1>
    <p>This is to certify that</p>
    <p><strong class="name">{{ $studentName }}</strong></p>
    <p>has successfully completed the course <em>{{ $courseName }}</em>.</p>
    <p class="date">on</p><strong>{{ date("Y/m/d") }}</strong>
</div>
</body>
</html>
