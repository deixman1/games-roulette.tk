@extends('layouts.app')

@section('header')
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                    <div class="chat">
                        <input id="url" type="text" v-on:input="message = $event.target.value">
                        {{--<button v-on:click="send(message)">send</button>--}}
                        @{{ message }}
                    </div>
                    <script>
                        var conn = new WebSocket('ws://localhost:8080');
                        conn.onopen = function(e) {
                            console.log("Connection established!");
                        };

                        conn.onmessage = function(e) {
                            console.log(e.data);
                            conn.send(e);
                        };
                        new Vue({
                            el: '.chat',
                            data: {
                                message: ''
                            },
                            methods: {
                                send: function(message){
                                    this.message = message;
                                    console.log(this.message);
                                    //conn.send(this.message);
                                },
                                asd: function(e){
                                    this.message = e;
                                    console.log(e);
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
