@extends('layouts.app')
@section('main')
    <style>
        div #reader {
            width: 100%;
            border: 20px solid #6777ef;
            border-radius: 10px;

            /* Adjust the radius as needed */
        }

        #html5-qrcode-button-camera-start {
            background-color: #6777ef;
            color: white;
            border-radius: 10px;
            padding: 10px;
            border: none;
        }

        #html5-qrcode-button-camera-stop {
            background-color: #6777ef;
            color: white;
            border-radius: 10px;
            border: none;
            padding: 10px;
        }

        #html5-qrcode-button-file-selection {
            background-color: #6777ef;
            color: white;
            border-radius: 10px;
            border: none;
            padding: 10px;
        }

        #html5-qrcode-button-camera-permission {
            background-color: #6777ef;
            color: white;
            border-radius: 10px;
            border: none;
            padding: 10px;
        }
    </style>
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

    </section>

    <div id="reader" width="100%" class="reader"></div>
@endsection
