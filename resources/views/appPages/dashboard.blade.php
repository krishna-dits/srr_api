@extends('layouts.layout')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    @can('Dashboard')
        <!-- =================================first four section======================= -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 box_mainarea">
                    <div class="row">
                        @can('dashboard requisition')
                            <div class="col-lg-2">
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- =================================first four section====================================== -->

        <!-- =================================second section========================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="scndfour_outstructure">
                        <div class="row gutters-20">
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
                                                <div class="item-title">Total User</div>
                                                <div class="item-number"><span class="counter">{{ @$all_user }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


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
                                                <div class="item-title">Yet To Start Task</div>
                                                <div class="item-number"><span class="counter">{{ @$yet_to_start_task }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                <div class="item-title">In Progress Task</div>
                                                <div class="item-number"><span class="counter">{{ @$in_progress_task }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                <div class="item-title">Completed Task</div>
                                                <div class="item-number"><span class="counter">{{ @$completed_task }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                <div class="item-title">Yet To Start Task</div>
                                                <div class="item-number"><span class="counter">{{ @$yet_to_start_task }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>





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
                                                <div class="item-number"><span class="counter">{{ @$thickness_no }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                    <div class="item-number"><span class="counter">{{ @$grade_no }}</span>
                                                    </div>
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
