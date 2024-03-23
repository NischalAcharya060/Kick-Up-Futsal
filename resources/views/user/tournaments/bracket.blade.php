@extends('user.layouts.app')

@section('title', 'Tournament Tie Sheet')

@section('content')
    <div class="container">
        <h1>Tournament Tie Sheet of {{ $tournamentName }}</h1>
        <section id="bracket">
            <div class="container">
                @if($matches->isEmpty())
                    <div class="alert alert-success">
                        <p>Tournament Not Started Yet</p>
                    </div>
                @else
                    <div class="row">
                        @foreach($matches->groupBy('round') as $round => $roundMatches)
                            <div class="col-md-4">
                                <h3>Round {{ $round }}</h3>
                                @foreach($roundMatches as $match)
                                    <div class="matchup{{ isset($match->winner) ? ' completed' : '' }}">
                                        <div class="team team-top">{{ $match->team1->name }}<span class="score">{{ $match->team1_score ?? 'N/A' }}</span></div>
                                        <div class="team team-bottom">{{ $match->team2->name }}<span class="score">{{ $match->team2_score ?? 'N/A' }}</span></div>
                                        @if(isset($match->winner))
                                            <div class="winner">Winner: {{ $match->winner->name }}</div>
                                        @else
                                            <div class="winner">Winner not decided</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
{{--            @if(isset($match) && $match->round == 3 && isset($match->winner))--}}
{{--                <div class="mt-4">--}}
{{--                    <div>Congratulations to {{ $match->winner->name }} for winning the {{ $tournamentName }} tournament!</div>--}}
{{--                    <a href="{{ route('download-certificate', ['winnerId' => $match->winner->id]) }}" class="mt-2 btn btn-success">Download Certificate</a>--}}
{{--                </div>--}}
{{--            @endif--}}
        </section>
    </div>
@endsection

@section('styles')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px;
        }

        h1 {
            text-align: center;
        }

        #bracket {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .matchup {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 15px;
            width: 100%;
            box-sizing: border-box;
            position: relative;
        }

        .matchup.completed {
            border: 2px solid #5cca87;
        }

        .team {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }

        .score {
            font-size: 14px;
            float: right;
            color: #888;
        }

        .winner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 18px;
            font-weight: bold;
            color: #5cca87;
        }
    </style>
@endsection
