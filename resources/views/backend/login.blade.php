@extends('layouts.app')

@section('category-title', '主界面')

@section('content')
<div class="row">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel bk-widget bk-border-off bk-noradius">
            <div class="bk-border-danger bk-bg-white bk-fg-danger bk-ltr bk-padding-15">
                <div class="row">
                    <div class="col-xs-4 text-left bk-vcenter bk-padding-off">
                        <span class="bk-round bk-icon bk-icon-3x bk-bg-danger bk-border-off">
                            <i class="fa fa-users fa-3x"></i>
                        </span>
                    </div>
                    <div class="col-xs-8 text-center bk-vcenter">
                        <h6 class="bk-margin-off">TOTAL USERS</h6>
                        <h4 class="bk-margin-off">326,269</h4>
                    </div>
                </div>
                <div class="progress bk-margin-off-bottom bk-margin-top-10 bk-noradius" style="height: 6px;">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                        <span class="sr-only">90% Complete</span>
                    </div>
                </div>
                <div class="bk-margin-top-10">
                    <div class="row">
                        <div class="col-xs-6">
                            <small>This month: 6,269</small>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="#" class="bk-fg-danger bk-fg-darken"><small>View details</small> <i class="fa fa-database"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>						
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel bk-widget bk-border-off">
            <div class="bk-border-primary bk-bg-white bk-fg-primary bk-ltr bk-padding-15">
                <div class="row">
                    <div class="col-xs-4 text-left bk-vcenter bk-padding-off">
                        <span class="bk-round bk-border-off bk-icon bk-icon-3x bk-bg-primary">
                            <i class="fa fa-globe fa-3x"></i>
                        </span>
                    </div>
                    <div class="col-xs-8 text-center bk-vcenter">
                        <h6 class="bk-margin-off">VISITS TODAY</h6>
                        <h4 class="bk-margin-off">10,256</h4>
                    </div>
                </div>
                <div class="progress bk-margin-off-bottom bk-margin-top-10 bk-noradius" style="height: 6px;">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                        <span class="sr-only">80% Complete</span>
                    </div>
                </div>
                <div class="bk-margin-top-10">
                    <div class="row">
                        <div class="col-xs-6">
                            <small>Top country: INDONESIA</small>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="#" class="bk-fg-primary bk-fg-darken"><small>View details</small> <i class="fa fa-database"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel bk-widget bk-border-off bk-noradius">
            <div class="bk-border-success bk-bg-white bk-fg-success bk-ltr bk-padding-15">
                <div class="row">
                    <div class="col-xs-4 text-left bk-vcenter bk-padding-off">
                        <span class="bk-round bk-border-off bk-icon bk-icon-3x bk-bg-success">
                            <i class="fa fa-download fa-3x"></i>
                        </span>
                    </div>
                    <div class="col-xs-8 text-center bk-vcenter">
                        <h6 class="bk-margin-off">DOWNLOAD</h6>
                        <h4 class="bk-margin-off">1,256</h4>
                    </div>
                </div>
                <div class="progress bk-margin-off-bottom bk-margin-top-10 bk-noradius" style="height: 6px;">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                        <span class="sr-only">80% Complete</span>
                    </div>
                </div>
                <div class="bk-margin-top-10">
                    <div class="row">
                        <div class="col-xs-6">
                            <small>Stock Item: 32,269</small>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="#" class="bk-fg-success bk-fg-darken"><small>View details</small> <i class="fa fa-database"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel bk-widget bk-border-off bk-noradius">
            <div class="bk-border-warning bk-bg-white bk-fg-warning bk-ltr bk-padding-15">
                <div class="row">
                    <div class="col-xs-4 text-left bk-vcenter bk-padding-off">
                        <span class="bk-round bk-border-off bk-icon bk-icon-3x bk-bg-warning">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </span>
                    </div>
                    <div class="col-xs-8 text-center bk-vcenter">
                        <h6 class="bk-margin-off">PURCHASE</h6>
                        <h4 class="bk-margin-off">$526,369</h4>
                    </div>
                </div>
                <div class="progress bk-margin-off-bottom bk-margin-top-10 bk-noradius" style="height: 6px;">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                        <span class="sr-only">80% Complete</span>
                    </div>
                </div>
                <div class="bk-margin-top-10">
                    <div class="row">
                        <div class="col-xs-6">
                            <small>Top day: 02/01/2015</small>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="#" class="bk-fg-warning bk-fg-darken"><small>View details</small> <i class="fa fa-database"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>
@endsection