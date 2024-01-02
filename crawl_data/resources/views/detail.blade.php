<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scoreboard detail</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="main-container">
    <div class="flex">
        <div class="left-card">
            <h1 class="lc-h1">General</h1>
            <div class="lc-score">
                <p class="lc-result">76</p>
                <p class="lc-total">of 100</p>
            </div>
            <h2 class="lc-grade">Great</h2>
{{--            <p class="lc-remarks">--}}
{{--                You scored higher than 65% of the people who have taken these tests.--}}
{{--            </p>--}}
        </div>
        <!-- ------------------------- -->
        <div class="right-card">
            @foreach($data as $key=>$item)
{{--                <h1 class="rc-h1">Summary</h1>--}}
                    <div class="rc-scoreboard">
                        <div class="rc-score verbal">
                            <svg class="verbal-image" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12H20M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            <p>{{$item['name']}}</p>
                            <p>{{round($item['point_total'], 2)}} / {{ $item['point']}}</p>
                        </div>
                    </div>
            @endforeach
            <button class="rc-button" onclick="window.location.href = '/'">Back</button>
        </div>
    </div>
</div>
</body>
</html>
