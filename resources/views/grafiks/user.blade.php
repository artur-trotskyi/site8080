@extends('layouts.layout')

@section('title', 'Графік')
@section('header', 'Графік повірки ЗВТ')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-0">
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::open(['route' => 'user.poverka.store'])}}
                                    <div class="form-group">
                                        <label>Фільтрувати за строком виконання</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                            </div>
                                            <input type="text" class="form-control float-right"
                                                   id="reservation"
                                                   value="{{$dateFrom}} - {{$dateTo}}"
                                                   name="dateFilter">
                                            <span class="input-group-prepend">
                                                <button class="btn btn-primary">OK</button>
                                                </span>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>

                                <div class="col-md-2">
                                    {{Form::open(['route'=>['user.poverka.reset', $dateFrom], 'method'=>'post'])}}
                                    <div class="form-group">
                                        <label>Скинути всі фільтри</label>
                                        <div class="input-group">
                                            <button class="btn btn-danger">
                                                Показати {{\Carbon\Carbon::now()->format('Y-m')}}</button>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>


                                @include('grafiks.breadcrumbs.user.filterInfo')


                                @if(json_decode($grafikIdJson))
                                    <div class="col-md-2">
                                        <label>Роздрукувати графік</label>
                                        {{Form::open([
                                        'route'=>['user.grafiks.showPDF'], 'method'=>'post', 'target'=>'_blank'
                                        ])}}
                                        <div class="form-group">
                                            <div class="input-group">
                                                <button class="btn btn-primary">
                                                    <i class="fas fa-print"></i>
                                                    &nbsp;ДРУК
                                                </button>
                                            </div>
                                            <input type="hidden" name="id" value="{{$grafikIdJson}}">
                                            <input type="hidden" name="dateFrom" value="{{$dateFrom}}">
                                            <input type="hidden" name="dateTo" value="{{$dateTo}}">
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body">

                            {{--Подключение таблицы--}}
                            @include('grafiks.breadcrumbs.user.table')
                            {{--Конец таблицы--}}

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('page-script')

    <script>
        $('#reservation').daterangepicker({
            language: 'ua',
            autoclose: true,
            todayHighlight: true,
            locale: {
                "format": "YYYY-MM-DD",
                "separator": " - ",
                "daysOfWeek": ["Нд", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                "monthNames": ["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень"],
                "firstDay": 1
            }
        })
    </script>

    {{--Подключение DataTableScript--}}
    @include('grafiks.breadcrumbs.user.dataTableScript')
    {{--Конец DataTableScript--}}

@endsection
