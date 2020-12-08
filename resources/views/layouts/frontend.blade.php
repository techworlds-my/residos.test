<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.home') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">{{ __('My profile') }}</a>

                                    @can('user_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.userManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('permission_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.permissions.index') }}">
                                            {{ trans('cruds.permission.title') }}
                                        </a>
                                    @endcan
                                    @can('role_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.roles.index') }}">
                                            {{ trans('cruds.role.title') }}
                                        </a>
                                    @endcan
                                    @can('user_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.users.index') }}">
                                            {{ trans('cruds.user.title') }}
                                        </a>
                                    @endcan
                                    @can('resident_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.resident.title') }}
                                        </a>
                                    @endcan
                                    @can('unit_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.unit.title') }}
                                        </a>
                                    @endcan
                                    @can('add_unit_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.add-units.index') }}">
                                            {{ trans('cruds.addUnit.title') }}
                                        </a>
                                    @endcan
                                    @can('add_block_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.add-blocks.index') }}">
                                            {{ trans('cruds.addBlock.title') }}
                                        </a>
                                    @endcan
                                    @can('unit_management_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.unit-managements.index') }}">
                                            {{ trans('cruds.unitManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('family_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.family.title') }}
                                        </a>
                                    @endcan
                                    @can('add_family_member_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.add-family-members.index') }}">
                                            {{ trans('cruds.addFamilyMember.title') }}
                                        </a>
                                    @endcan
                                    @can('tenant_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.tenant.title') }}
                                        </a>
                                    @endcan
                                    @can('add_tanent_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.add-tanents.index') }}">
                                            {{ trans('cruds.addTanent.title') }}
                                        </a>
                                    @endcan
                                    @can('facility_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.facility.title') }}
                                        </a>
                                    @endcan
                                    @can('facility_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.facility-categories.index') }}">
                                            {{ trans('cruds.facilityCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('facility_management_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.facility-managements.index') }}">
                                            {{ trans('cruds.facilityManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('facility_book_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.facility-books.index') }}">
                                            {{ trans('cruds.facilityBook.title') }}
                                        </a>
                                    @endcan
                                    @can('check_facility_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.check-facilities.index') }}">
                                            {{ trans('cruds.checkFacility.title') }}
                                        </a>
                                    @endcan
                                    @can('visitor_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.visitor.title') }}
                                        </a>
                                    @endcan
                                    @can('add_visitor_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.add-visitors.index') }}">
                                            {{ trans('cruds.addVisitor.title') }}
                                        </a>
                                    @endcan
                                    @can('defect_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.defect.title') }}
                                        </a>
                                    @endcan
                                    @can('add_defect_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.add-defects.index') }}">
                                            {{ trans('cruds.addDefect.title') }}
                                        </a>
                                    @endcan
                                    @can('status_control_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.status-controls.index') }}">
                                            {{ trans('cruds.statusControl.title') }}
                                        </a>
                                    @endcan
                                    @can('defact_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.defact-categories.index') }}">
                                            {{ trans('cruds.defactCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('access_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.accessManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('entrance_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.entrances.index') }}">
                                            {{ trans('cruds.entrance.title') }}
                                        </a>
                                    @endcan
                                    @can('location_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.locations.index') }}">
                                            {{ trans('cruds.location.title') }}
                                        </a>
                                    @endcan
                                    @can('history_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.histories.index') }}">
                                            {{ trans('cruds.history.title') }}
                                        </a>
                                    @endcan
                                    @can('qr_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.qrs.index') }}">
                                            {{ trans('cruds.qr.title') }}
                                        </a>
                                    @endcan
                                    @can('form_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.form.title') }}
                                        </a>
                                    @endcan
                                    @can('form_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.form-categories.index') }}">
                                            {{ trans('cruds.formCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('e_billing_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.eBilling.title') }}
                                        </a>
                                    @endcan
                                    @can('maintenances_payment_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.maintenances-payments.index') }}">
                                            {{ trans('cruds.maintenancesPayment.title') }}
                                        </a>
                                    @endcan
                                    @can('facilitypayment_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.facilitypayments.index') }}">
                                            {{ trans('cruds.facilitypayment.title') }}
                                        </a>
                                    @endcan
                                    @can('payment_method_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.payment-methods.index') }}">
                                            {{ trans('cruds.paymentMethod.title') }}
                                        </a>
                                    @endcan
                                    @can('carpark_payment_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.carpark-payments.index') }}">
                                            {{ trans('cruds.carparkPayment.title') }}
                                        </a>
                                    @endcan
                                    @can('event_payment_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.event-payments.index') }}">
                                            {{ trans('cruds.eventPayment.title') }}
                                        </a>
                                    @endcan
                                    @can('feedback_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.feedback.title') }}
                                        </a>
                                    @endcan
                                    @can('add_feedback_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.add-feedbacks.index') }}">
                                            {{ trans('cruds.addFeedback.title') }}
                                        </a>
                                    @endcan
                                    @can('feedback_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.feedback-categories.index') }}">
                                            {{ trans('cruds.feedbackCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('resident_setting_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.residentSetting.title') }}
                                        </a>
                                    @endcan
                                    @can('notice_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.notice.title') }}
                                        </a>
                                    @endcan
                                    @can('user_alert_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.user-alerts.index') }}">
                                            {{ trans('cruds.userAlert.title') }}
                                        </a>
                                    @endcan
                                    @can('notice_board_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.notice-boards.index') }}">
                                            {{ trans('cruds.noticeBoard.title') }}
                                        </a>
                                    @endcan
                                    @can('event_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.event.title') }}
                                        </a>
                                    @endcan
                                    @can('event_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.event-categories.index') }}">
                                            {{ trans('cruds.eventCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('event_control_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.event-controls.index') }}">
                                            {{ trans('cruds.eventControl.title') }}
                                        </a>
                                    @endcan
                                    @can('event_enroll_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.event-enrolls.index') }}">
                                            {{ trans('cruds.eventEnroll.title') }}
                                        </a>
                                    @endcan
                                    @can('carpark_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.carpark.title') }}
                                        </a>
                                    @endcan
                                    @can('vehicle_management_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.vehicle-managements.index') }}">
                                            {{ trans('cruds.vehicleManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('vehicle_brand_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.vehicle-brands.index') }}">
                                            {{ trans('cruds.vehicleBrand.title') }}
                                        </a>
                                    @endcan
                                    @can('carpark_location_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.carpark-locations.index') }}">
                                            {{ trans('cruds.carparkLocation.title') }}
                                        </a>
                                    @endcan
                                    @can('carpark_log_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.carpark-logs.index') }}">
                                            {{ trans('cruds.carparkLog.title') }}
                                        </a>
                                    @endcan
                                    @can('vehicle_model_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.vehicle-models.index') }}">
                                            {{ trans('cruds.vehicleModel.title') }}
                                        </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('message'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                </div>
            @endif
            @if($errors->count() > 0)
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul class="list-unstyled mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')

</html>