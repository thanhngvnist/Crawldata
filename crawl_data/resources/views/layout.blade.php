<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scoreboard</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div class="main-container">
        <div class="list">
            <div class="col-4">
                <h2 class="title">Log management</h2>
                <div class="item-list">
                    @foreach($log_management_list as $data)
                    <div class="item">
                        <div class="number">{{$data['id']}}</div>
                        <div class="content">
                            <img src="{{$data['image']}}" alt="" class="logo">
                            {{$data['name']}}
                        </div>
                        <div class="checkbox">
                            <div class="checkbox-wrapper-40">
                                <label>
                                    <input type="checkbox"/>
                                    <span class="checkbox"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-4">
                <h2 class="title">Vulnerability management</h2>
                <div class="item-list">
                    @foreach($vulnerability_management_list as $data)
                        <div class="item">
                            <div class="number">{{$data['id']}}</div>
                            <div class="content">
                                <img src="{{$data['image']}}" alt="" class="logo">
                                {{$data['name']}}
                            </div>
                            <div class="checkbox">
                                <div class="checkbox-wrapper-40">
                                    <label>
                                        <input type="checkbox"/>
                                        <span class="checkbox"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-4">
                <h2 class="title">Security awareness training</h2>
                <div class="item-list">
                    @foreach($security_awareness_training_list as $data)
                        <div class="item">
                            <div class="number">{{$data['id']}}</div>
                            <div class="content">
                                <img src="{{$data['image']}}" alt="" class="logo">
                                {{$data['name']}}
                            </div>
                            <div class="checkbox">
                                <div class="checkbox-wrapper-40">
                                    <label>
                                        <input type="checkbox"/>
                                        <span class="checkbox"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-4">
                <h2 class="title">Security awareness training</h2>
                <div class="item-list">
                    @foreach($incident_response_plan_list as $data)
                        <div class="item">
                            <div class="number">{{$data['id']}}</div>
                            <div class="content">
                                <img src="{{$data['image']}}" alt="" class="logo">
                                {{$data['name']}}
                            </div>
                            <div class="checkbox">
                                <div class="checkbox-wrapper-40">
                                    <label>
                                        <input type="checkbox"/>
                                        <span class="checkbox"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12">
            <!-- HTML !-->
            <button class="btn" role="button" onclick="window.location.href = '/detail'">Next</button>
        </div>
    </div>
</body>
</html>
