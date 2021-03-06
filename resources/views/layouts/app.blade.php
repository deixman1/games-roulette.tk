<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GameRoulette') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <style>
        #page{
            display: flex;
            justify-content: space-between;
        }
        #settings{
            width: 200px;
            background: #9d9d9d;
        }
        #chat{
            width: 300px;
            background: #9d9d9d;
        }
        .slide-enter, .slide-leave {
            left: -100%;
        }﻿
    </style>
</head>
<body>
    <div id="page">
        <div id="settings">
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li>{{ Auth::user()->name }}</li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            @endguest
                <li id="games-list">

                </li>
        </div>
        <div id="content">
        @yield('content')
        </div>
        <div id="chat">
            <div v-for="message in messages">@{{ message }}</div>
            <input type="text" v-on:keyup.enter="send($event.target.value)">
        </div>
    </div>
    <script>
        window.onload = function (ev) {
            var socket = new WebSocket('ws://localhost:8080');
            socket.onopen = function(e) {
                console.log("Connection established!");
            };
            socket.onmessage = function(e) {
                console.log(e);
                vue.messages.push(e.data);
            };
            var vue = new Vue({
                el: '#page',
                data:{
                    ShowSettings: false,
                    ShowChat: false,
                    messages: [

                    ]
                },
                methods:{
                    send:function(message){
                        //console.log(conn.send(message));
                        socket.send(message);
                    }
                }
            });
        }
    </script>
</body>
</html>
   {{-- <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'GameRoulette') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>--}}

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}

