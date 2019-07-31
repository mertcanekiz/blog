<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="content">
                    <div class="title m-b-md">
                        Blog
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-lg-6 col-sm-6">
                    <div class="h2 flex-center">
                        Last Post
                    </div>
<div class="div">
    @if(count($posts)>0)
        @foreach ($posts as $post)
            @component('components.post', ['post' => $post->orderBy('created_at', 'desc')->first()])
            @endcomponent
        @endforeach
        @endif
</div>
                </div>
                <div class="col col-lg-6 col-sm-6">
                    <div class="h2 flex-center">
                        Most Liked Post
                    </div>

                    @foreach ($posts as $post)
                        @component('components.post', ['post' => $post])
                        @endcomponent
                    @endforeach
                        </div>
                </div>
            </div>
    @endsection
    </body>
</html>
