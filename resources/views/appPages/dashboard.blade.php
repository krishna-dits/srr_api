@extends('layouts.layout')

@section('content')
    <?php
    $total_users = DB::table('users')->count();
    
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    @can('Dashboard')
        <!-- =================================first four section======================= -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 box_mainarea">
                    <div class="row">
                        @can('dashboard requisition')
                            <div class="col-lg-2">
                                <!-- <div class="incard_boxarea articles__article" style="--animation-order:1"> -->
                                <!-- <a class="articles__link"> -->
                                <!-- <div class="articles__content articles__content--lhs">
                    <h2 class="articles__title">Total Requisition</h2>
                    <div class="articles__footer">
                     <p>{{ @$total_requisitions }}</p> -->
                                <!-- <time>1 Jan 2020</time> -->
                                <!-- </div>
                   </div> -->
                                <!-- <div class="articles__content articles__content--rhs" aria-hidden="true">
                    <h2 class="articles__title">Total Requisition</h2>
                    <div class="articles__footer">
                     <p>{{ @$total_requisitions }}</p>

                    </div>
                   </div> -->
                                <!-- </a> -->
                                <!-- </div> -->
                            </div>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
        <!-- =================================first four section====================================== -->
        @can('show pie chart')
            <!-- =================================pie chart section======================================= -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dashchart_area">
                            <div class="row">
                                <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-xm-6">
                 <div class="card custom_cardx">
                  <div class="card-header">
                   <div class="card-title">Item Stock Amount / Item Issue Amount</div>
                  </div>
                  <div class="card-body">
                   <canvas id="myChart_issue_stock"></canvas>
                  </div>
                 </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-xm-6">
                 <div class="card mycard_scndchrt">
                  <div class="card-header">
                   <h3 class="card-title">Job Create / Job Complete</h3>
                  </div>
                  <div>
                   <canvas id="myChart"></canvas>
                  </div>
                 </div>
                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =================================pie chart section======================================= -->
        @endcan
        <!-- =================================second section========================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="scndfour_outstructure">
                        <div class="row gutters-20">
                            @can('dashboard total Customer')
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="dashboard-summery-one mg-b-20">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="item-icon ">
                                                    {{--  <i class="fas fa-users sicon_design"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/customer-satisfaction (2).png') }}"
                                                        alt="img">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="item-content">
                                                    <div class="item-title">Total Customer</div>
                                                    <div class="item-number"><span class="counter">{{ @$all_customers }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan




                            @can('dashboard total Customer')
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="dashboard-summery-one mg-b-20">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="item-icon bg-light-green">
                                                    {{--  <i class="fas fa-users sicon_design"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/number-blocks.png') }}"
                                                        alt="img">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="item-content">
                                                    <div class="item-title">Total Is NO</div>
                                                    <div class="item-number"><span class="counter">{{ @$is_no }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan


                            @can('dashboard total Customer')
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="dashboard-summery-one mg-b-20">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="item-icon bg-light-green">
                                                    {{--  <i class="fas fa-users sicon_design"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/size.png') }}" alt="img">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="item-content">
                                                    <div class="item-title">Total Size No</div>
                                                    <div class="item-number"><span class="counter">{{ @$size_no }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('dashboard total thickness_no')
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="dashboard-summery-one mg-b-20">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="item-icon bg-light-green">
                                                    {{--  <i class="fas fa-users sicon_design"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/paper.png') }}" alt="img">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="item-content">
                                                    <div class="item-title">Total Thickness</div>
                                                    <div class="item-number"><span class="counter">{{ @$thickness_no }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('dashboard total Grade')
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="dashboard-summery-one mg-b-20">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="item-icon bg-light-green">
                                                    {{--  <i class="fas fa-users sicon_design"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/exam.png') }}" alt="img">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="item-content">
                                                    <div class="item-title">Total Grade</div>
                                                    <div class="item-number"><span class="counter">{{ @$grade_no }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('dashboard total PoDo')
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="dashboard-summery-one mg-b-20">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="item-icon bg-light-green">
                                                    {{--  <i class="fas fa-users sicon_design"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/number-blocks.png') }}"
                                                        alt="img">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="item-content">
                                                    <div class="item-title">Total PoDo No</div>
                                                    <div class="item-number"><span class="counter">{{ @$podo_no }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('dashboard total Coil')
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="dashboard-summery-one mg-b-20">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="item-icon bg-light-green">
                                                    {{--  <i class="fas fa-users sicon_design"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/number-blocks.png') }}"
                                                        alt="img">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="item-content">
                                                    <div class="item-title">Total Coil No</div>
                                                    <div class="item-number"><span class="counter">{{ @$coil_no }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('dashboard total Batch')
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="dashboard-summery-one mg-b-20">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="item-icon bg-light-green">
                                                    {{--  <i class="fas fa-users sicon_design"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/number-blocks.png') }}"
                                                        alt="img">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="item-content">
                                                    <div class="item-title">Total Batch No</div>
                                                    <div class="item-number"><span class="counter">{{ @$batch_no }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('dashboard total Tc')
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="dashboard-summery-one mg-b-20">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="item-icon bg-light-green">
                                                    {{--  <i class="fas fa-users sicon_design"></i>  --}}
                                                    <img src="{{ asset('public/assets/images/brand/number-blocks.png') }}"
                                                        alt="img">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="item-content">
                                                    <div class="item-title">Total Tc No</div>
                                                    <div class="item-number"><span class="counter">{{ @$tc_no }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- =================================second section========================================== -->
    @endcan
@endsection
