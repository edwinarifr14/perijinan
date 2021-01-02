@extends('layouts.app')

@section('title', 'Home')

@section('heads')
<link rel="stylesheet" href="{{ url('/assets/css/home.css') }}">
@endsection

@section('content')
<div class="container">
    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Selamat datang di website Taniku</div>
                <div class="intro-heading text-uppercase">It's Nice To Meet You</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a>
            </div>
        </div>
    </header>

    <!-- Services -->
    <section class="page-section" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                    <h3 class="section-subheading text-muted">Kenapa harus Taniku ?</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Berkualitas</h4>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Online</h4>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Aman</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="page-section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Owner</h2>
                    <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image" style="z-index: 1">
                                <img class="rounded-circle img-fluid" src="{{ url('/assets/img/about/1.jpg') }}"
                                    alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <!-- <h4>2009-2011</h4> -->
                                    <!-- <h4 class="subheading">Our Humble Beginnings</h4> -->
                                </div>
                                <div class="timeline-body">
                                    <!-- <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam,
                                        recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium
                                        consectetur!</p> -->
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image" style="z-index: 1">
                                <img class="rounded-circle img-fluid" src="{{ url('/assets/img/about/2.jpg') }}"
                                    alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <!-- <h4>March 2011</h4>
                                    <h4 class="subheading">An Agency is Born</h4> -->
                                </div>
                                <div class="timeline-body">
                                    <!-- <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam,
                                        recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium
                                        consectetur!</p> -->
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image" style="z-index: 1">
                                <img class="rounded-circle img-fluid" src="{{ url('/assets/img/about/3.jpg') }}"
                                    alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <!-- <h4>December 2012</h4>
                                    <h4 class="subheading">Transition to Full Service</h4> -->
                                </div>
                                <div class="timeline-body">
                                    <!-- <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam,
                                        recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium
                                        consectetur!</p> -->
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image" style="z-index: 1">
                                <img class="rounded-circle img-fluid" src="{{ url('/assets/img/about/4.jpg') }}"
                                    alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                  <!-- <h4>July 2014</h4>
                                    <h4 class="subheading">Phase Two Expansion</h4> -->
                                </div>
                                <div class="timeline-body">
                                    <!-- <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam,
                                        recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium
                                        consectetur!</p> -->
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image" style="z-index: 1">
                                <h4>Be Part
                                    <br>Of Our
                                    <br>Story!</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
