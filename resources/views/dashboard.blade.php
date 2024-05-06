@extends('layouts.app2')
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BTL_eRecruitment</title>
        <!-- CSS -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet"
            href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
</head>
<!--Content-->
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="content">
                            <div class="container-fluid">
                                <!-- Small boxes (Stat box) -->
                                <div class="row">
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <p>604</p>
                                                <p>Total vacancy</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-android-contacts"></i>
                                            </div>
                                            <a href="{{ route('report') }}" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                        
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <p>112</p>
                                                <p>Number of applicants applied</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-android-contact"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"><i
                                                class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <p>10</p>
                                                <p>Shortlisted Applicants</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-android-contact"></i>                                                </div>
                                                <a href="#" class="small-box-footer"> <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                            <div class="small-box bg-danger">
                                                <div class="inner">
                                                    <p>482</p>
                                                    <p>Selected Applicants</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-android-contact"></i>                                                </div>
                                                <a href="#" class="small-box-footer"> <i
                                                    class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                    </div>
                                        <!-- ./col -->
                                </div>
                            </div>
                            <!-- /.container-fluid -->       
                        <br>
                        </section>  

                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <b>
                                    <p class="text-center">Vacancy List</p>
                                </b>
                                <div class="container">
                                    @if(count($vacancies) > 0)
                                        <table class="table table-striped table-bordered">
                                            <thead style="background-color: #888; color: white;">
                                                <tr>
                                                    <th>Position</th>
                                                    <th>Slots</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($vacancies as $vacancy)
                                                    <tr>
                                                        <td>{{ $vacancy->position }}</td>
                                                        <td>{{ $vacancy->slot }}</td>
                                                        <td class="text-center" style="width: 150px;"> <!-- Adjust the width as needed -->
                                                            <a href="{{ route('showcanidate', $vacancy->id) }}" class="btn btn-primary btn-sm">View Candidates</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                           
                                        </table>
                                    @else
                                        <p>No vacancies available.</p>
                                    @endif
                                </div>
                                
                                
                                
                            </div>
                        </div>
                        <div><br></div>
                        <div><br></div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</body>
</html>