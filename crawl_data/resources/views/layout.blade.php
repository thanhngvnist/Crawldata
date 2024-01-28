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
        <form action="/detail" method="post">
        {{ csrf_field() }} 
        <div class="list">
            <div class="col-4">
                <h2 class="title">Log management</h2>
                <div class="item-list">
                    @foreach($log_management_list as $key=>$data)
                    <div class="item">
                        <div class="number">{{$data['id']}}</div>
                        <div class="content">
                            <img src="{{$data['image']}}" alt="" class="logo">
                            {{$data['name']}}
                        </div>
                        <div class="checkbox">
                            <div class="checkbox-wrapper-40">
                                <label>
                                    <input type="checkbox" name="log_management_list[]" value="{{$data['id']}}" 
                                    @if (!empty($value['log_management_list']) && in_array($data['id'], $value['log_management_list']))
                                        checked
                                    @endif />
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
                    @foreach($vulnerability_management_list as $key=>$data)
                        <div class="item">
                            <div class="number">{{$data['id']}}</div>
                            <div class="content">
                                <img src="{{$data['image']}}" alt="" class="logo">
                                {{$data['name']}}
                            </div>
                            <div class="checkbox">
                                <div class="checkbox-wrapper-40">
                                    <label>
                                        <input type="checkbox"  name="vulnerability_management_list[]" value="{{$data['id']}}"
                                        @if (!empty($value['vulnerability_management_list']) && in_array($data['id'], $value['vulnerability_management_list']))
                                            checked
                                        @endif />
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
                    @foreach($security_awareness_training_list as $key=>$data)
                        <div class="item">
                            <div class="number">{{$data['id']}}</div>
                            <div class="content">
                                <img src="{{$data['image']}}" alt="" class="logo">
                                {{$data['name']}}
                            </div>
                            <div class="checkbox">
                                <div class="checkbox-wrapper-40">
                                    <label>
                                        <input type="checkbox" name="security_awareness_training_list[]" value="{{$data['id']}}" 
                                        @if (!empty($value['security_awareness_training_list']) && in_array($data['id'], $value['security_awareness_training_list']))
                                            checked
                                        @endif  />
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
                    @foreach($incident_response_plan_list as $key=>$data)
                        <div class="item">
                            <div class="number">{{$data['id']}}</div>
                            <div class="content">
                                <img src="{{$data['image']}}" alt="" class="logo">
                                {{$data['name']}}
                            </div>
                            <div class="checkbox">
                                <div class="checkbox-wrapper-40">
                                    <label>
                                        <input type="checkbox"  name="incident_response_plan_list[]" value="{{$data['id']}}"
                                        @if (!empty($value['incident_response_plan_list']) && in_array($data['id'], $value['incident_response_plan_list']))
                                            checked
                                        @endif  />
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
            <button class="btn" type="submit" role="button">Next</button>
        </div>
        </form>
    </div>
</body>
</html>
