@extends('layouts.app')

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
                        <div id="app">
                            <input type="text" v-on:keyup.enter="send($event.target.value)">
                            @{{ message }}
                        </div>
                    <script>
                        var conn = new WebSocket('ws://localhost:8080');
                        conn.onopen = function(e) {
                            console.log("Connection established!");
                        };

                        /*conn.onmessage = function(e) {
                            console.log(e.data);
                            conn.send(e);
                        };*/
                        new Vue({
                            el: '#app',
                            data: {
                                message: ''
                            },
                            methods:{
                                send:function(message){
                                    console.log(message);
                                    conn.send(message);
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
