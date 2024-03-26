@extends('backend.layouts.main')
@section('content')
    <x-alert />
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-aside-wrap">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="tab-content">
                            @if (auth()->user()->employee)
                                <div class="tab-pane active" id="tabItem1">
                                    <div>
                                        <div class="nk-block-head-content float-left d-md-none">
                                            <h4 class="nk-block-title">Personal Information</h4>
                                        </div>
                                        <div class="nk-block-head-content d-none d-md-block">
                                            <h4 class="nk-block-title">Personal Information</h4>
                                        </div>
                                        <div class="nk-block-head-content align-self-end d-lg-none text-right">
                                            <a href="javascript:void(0)" class="toggle btn btn-icon btn-trigger mt-n1"
                                                data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                        </div>
                                    </div>
                                    <div class="nk-block mt-3">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Basics</h6>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Phone Number</span>
                                                    <span
                                                        class="data-value text-soft">+{{ auth()->user()->employee->pri_country_code }}
                                                        {{ auth()->user()->employee->pri_phone_number }} @if (auth()->user()->employee->sec_country_code)
                                                            , +{{ auth()->user()->employee->sec_country_code }}
                                                            {{ auth()->user()->employee->sec_phone_number }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Date of Birth</span>
                                                    <span
                                                        class="data-value text-soft">{{ date('d-m-Y', strtotime(auth()->user()->employee->dob)) }}</span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Address</span>
                                                    <span
                                                        class="data-value text-soft">{{ auth()->user()->employee->address }},
                                                        {{ auth()->user()->employee->city }},
                                                        {{ auth()->user()->employee->state }},
                                                        {{ auth()->user()->employee->zip_code }}</span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Joining Date</span>
                                                    <span
                                                        class="data-value text-soft">{{ date('d-m-Y', strtotime(auth()->user()->employee->joining_date)) }}</span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Basic Salary</span>
                                                    <span
                                                        class="data-value text-soft">{{ auth()->user()->employee->basic_salary }}</span>
                                                </div>
                                            </div><!-- data-item -->
                                        </div><!-- data-list -->
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Emergency Details</h6>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Blood Group</span>
                                                    <span
                                                        class="data-value text-soft">{{ auth()->user()->employee->blood_group }}</span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Emergency Contact Name</span>
                                                    <span
                                                        class="data-value text-soft">{{ auth()->user()->employee->emergency_contact_name }}</span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Emergency Contact Number</span>
                                                    <span
                                                        class="data-value text-soft">+{{ auth()->user()->employee->emergency_contact_country_code }}
                                                        {{ auth()->user()->employee->emergency_contact_number }}</span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Emergency Contact Relation</span>
                                                    <span
                                                        class="data-value text-soft">{{ auth()->user()->employee->emergency_contact_relation }}</span>
                                                </div>
                                            </div><!-- data-item -->
                                        </div><!-- data-list -->
                                    </div><!-- .nk-block -->
                                </div>
                                <div class="tab-pane" id="tabItem2">
                                    <div>
                                        <div class="nk-block-head-content float-left d-md-none">
                                            <h4 class="nk-block-title">Work Information</h4>
                                        </div>
                                        <div class="nk-block-head-content d-none d-md-block">
                                            <h4 class="nk-block-title">Work Information</h4>
                                        </div>
                                        <div class="nk-block-head-content align-self-end d-lg-none text-right">
                                            <a href="javascript:void(0)" class="toggle btn btn-icon btn-trigger mt-n1"
                                                data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                        </div>
                                    </div>
                                    <div class="nk-block mt-3">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Connects</h6>
                                            </div>
                                            @if (auth()->user()->employee->reportingManager)
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Reporting Manager </span>
                                                        <span
                                                            class="data-value text-soft">{{ auth()->user()->employee->reportingManager->name }}</span>
                                                    </div>
                                                </div><!-- data-item -->
                                            @endif
                                            @if (auth()->user()->employee->subManager)
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">Sub Manager </span>
                                                        <span
                                                            class="data-value text-soft">{{ auth()->user()->employee->subManager->name }}</span>
                                                    </div>
                                                </div><!-- data-item -->
                                            @endif
                                            @if (auth()->user()->employee->peopleManager)
                                                <div class="data-item">
                                                    <div class="data-col">
                                                        <span class="data-label">People Manager </span>
                                                        <span
                                                            class="data-value text-soft">{{ auth()->user()->employee->peopleManager->name }}</span>
                                                    </div>
                                                </div><!-- data-item -->
                                            @endif

                                        </div><!-- data-list -->
                                    </div><!-- .nk-block -->
                                </div>
                                <div class="tab-pane" id="tabItem3">
                                    <div>
                                        <div class="nk-block-head-content float-left d-md-none">
                                            <h4 class="nk-block-title">Banking Information</h4>
                                        </div>
                                        <div class="nk-block-head-content d-none d-md-block">
                                            <h4 class="nk-block-title">Banking Information</h4>
                                        </div>
                                        <div class="nk-block-head-content align-self-end d-lg-none text-right">
                                            <a href="javascript:void(0)" class="toggle btn btn-icon btn-trigger mt-n1"
                                                data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                        </div>
                                    </div>
                                    <div class="nk-block mt-3">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Banking Details</h6>
                                            </div>
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Bank Name</span>
                                                    <span class="data-value text-soft">
                                                        @if (auth()->user()->employee->bank_name)
                                                            {{ auth()->user()->employee->bank_name }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Branch Name</span>
                                                    <span class="data-value text-soft">
                                                        @if (auth()->user()->employee->branch_name)
                                                            {{ auth()->user()->employee->branch_name }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit"
                                                data-tab-target="#address">
                                                <div class="data-col">
                                                    <span class="data-label">Account Number</span>
                                                    <span class="data-value text-soft">
                                                        @if (auth()->user()->employee->account_number)
                                                            {{ auth()->user()->employee->account_number }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit"
                                                data-tab-target="#address">
                                                <div class="data-col">
                                                    <span class="data-label">IFSC Code</span>
                                                    <span class="data-value text-soft">
                                                        @if (auth()->user()->employee->ifsc_code)
                                                            {{ auth()->user()->employee->ifsc_code }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit"
                                                data-tab-target="#address">
                                                <div class="data-col">
                                                    <span class="data-label">UPI ID</span>
                                                    <span class="data-value text-soft">
                                                        @if (auth()->user()->employee->upi_id)
                                                            {{ auth()->user()->employee->upi_id }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit"
                                                data-tab-target="#address">
                                                <div class="data-col">
                                                    <span class="data-label">PAN</span>
                                                    <span
                                                        class="data-value text-soft">{{ auth()->user()->employee->pan }}</span>
                                                </div>
                                            </div><!-- data-item -->
                                        </div><!-- data-list -->
                                    </div><!-- .nk-block -->
                                </div>
                                <div class="tab-pane" id="tabItem4">
                                    <div>
                                        <div class="nk-block-head-content float-left d-md-none">
                                            <h4 class="nk-block-title">Security Settings</h4>
                                        </div>
                                        <div class="nk-block-head-content d-none d-md-block">
                                            <h4 class="nk-block-title">Security Settings</h4>
                                        </div>
                                        <div class="nk-block-head-content align-self-end d-lg-none text-right">
                                            <a href="javascript:void(0)" class="toggle btn btn-icon btn-trigger mt-n1"
                                                data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="card d-block">
                                            <div class="data-head mt-2">
                                                <h6 class="overline-title">Change Password</h6>
                                            </div>
                                            <div class="nk-block-text mt-1">
                                                <p>Set a unique password to protect your account.</p>
                                            </div>
                                            <div class="nk-block-actions flex-shrink-sm-0 pt-2">
                                                <form action="{{ route('user.changePassword') }}" id="form"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row gy-3">
                                                        <div class="col-12 col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Current Password<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="password"
                                                                        data-msg="This field is required"
                                                                        class="form-control required"
                                                                        name="current_password"
                                                                        placeholder="Eg. A@1234@abc" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">New Password<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="password"
                                                                        data-msg="This field is required"
                                                                        class="form-control required" name="new_password"
                                                                        placeholder="Eg. A@1234@abc" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Confirm Password<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text"
                                                                        data-msg="This field is required"
                                                                        class="form-control required"
                                                                        name="confirm_password"
                                                                        placeholder="Eg. A@1234@abc" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-2">Change
                                                        Password</button>
                                                </form>
                                            </div><!-- .card-inner-group -->
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->
                                </div>
                                <div class="tab-pane" id="tabItem5">
                                    <div>
                                        <div class="nk-block-head-content float-left d-md-none">
                                            <h4 class="nk-block-title">Assigned Assets</h4>
                                        </div>
                                        <div class="nk-block-head-content d-none d-md-block">
                                            <h4 class="nk-block-title">Assigned Assets</h4>
                                        </div>
                                        <div class="nk-block-head-content align-self-end d-lg-none text-right">
                                            <a href="javascript:void(0)" class="toggle btn btn-icon btn-trigger mt-n1"
                                                data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                        </div>
                                    </div>
                                    <div class="nk-block mt-3">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title d-flex">
                                                    <span class="col-6">Name</span>
                                                    <span class="col-3">Serial Number</span>
                                                    <span class="col-3">Assigned On</span>
                                                </h6>
                                            </div>
                                            @php $assignedAssets = auth()->user()->employee->assignedAssets; @endphp
                                            @forelse ($assignedAssets as $assignedAsset)
                                                <div class="data-item" data-toggle="modal">
                                                    <div class="data-col d-flex">
                                                        <span
                                                            class="col-6">{{ ucwords($assignedAsset->asset->assetType->brand) }}
                                                            {{ ucwords($assignedAsset->asset->assetType->model) }}</span>
                                                        <span class="col-3">
                                                            {{ ucwords($assignedAsset->asset->serial_number) }}
                                                        </span>
                                                        <span class="col-3">
                                                            @if ($assignedAsset->assigned_on)
                                                                {{ date('d F Y', strtotime($assignedAsset->assigned_on)) }}
                                                            @else
                                                                {{ date('d F Y', strtotime($assignedAsset->created_at)) }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div><!-- data-item -->
                                            @empty
                                                <div class="data-item" data-toggle="modal">
                                                    <div class="data-col">
                                                        No Assets Assigned
                                                    </div>
                                                </div><!-- data-item -->
                                            @endforelse
                                        </div><!-- data-list -->
                                    </div><!-- .nk-block -->
                                </div>
                            @else
                                <div>
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Security Settings</h4>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="javascript:void(0)" class="toggle btn btn-icon btn-trigger mt-n1"
                                            data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                    <div class="nk-block">
                                        <div class="card">
                                            <div class="data-head mt-2">
                                                <h6 class="overline-title">Change Password</h6>
                                            </div>
                                            <div class="nk-block-text mt-1">
                                                <p>Set a unique password to protect your account.</p>
                                            </div>
                                            <div class="nk-block-actions flex-shrink-sm-0 pt-2">
                                                <form action="{{ route('user.changePassword') }}" id="form"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row gy-3">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Email<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text"
                                                                        data-msg="This field is required"
                                                                        class="form-control required" name="name"
                                                                        value="{{ auth()->user()->email }}" required
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Current Password<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="password"
                                                                        data-msg="This field is required"
                                                                        class="form-control required"
                                                                        name="current_password"
                                                                        placeholder="Eg. Eg. A@1234@abc" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="form-label">New Password<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="password"
                                                                        data-msg="This field is required"
                                                                        class="form-control required" name="new_password"
                                                                        placeholder="Eg. A@1234@abc" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Confirm Password<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text"
                                                                        data-msg="This field is required"
                                                                        class="form-control required"
                                                                        name="confirm_password"
                                                                        placeholder="Eg. A@1234@abc" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-2">Change
                                                        Password</button>
                                                </form>
                                            </div><!-- .card-inner-group -->
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->
                                </div>
                            @endif
                        </div>
                    </div><!-- .nk-block-head -->
                </div><!-- .card-inner -->
                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true"
                    style="overflow: scroll !important;">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            @if (auth()->user()->employee)
                                <div class="profile-image-div">
                                    <div class="profile-image circle-card d-flex justify-content-center">
                                        @if (auth()->user()->employee->image)
                                            <img src="{{ asset('storage/images/employees/' . auth()->user()->employee->image) }}"
                                                class="circle-card new-image"
                                                alt="{{ substr(auth()->user()->employee->fname, 0, 1) }}">
                                        @elseif(auth()->user()->employee->gender == 'female')
                                            <img src="{{ asset('assets/img/female-avtar.png') }}" class="new-image"
                                                alt="">
                                        @else
                                            <img src="{{ asset('assets/img/male-avtar.png') }}" class="new-image"
                                                alt="">
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/img/male-avtar.png') }}" alt="">
                            @endif
                        </div>
                        @if (auth()->user()->employee)
                            <div class="profile-upload-button">
                                <form action="{{ route('employee.updateProfile') }}" method="post" id="profile-change"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                    <input type="file" name="image" id="profile_image" hidden>
                                    <label for="profile_image">
                                        <h3 class="ni icon ni-upload circle-button bg-dark p-2 text-primary text-right">
                                        </h3>
                                    </label>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="text-center mt-2">
                        <h4>{{ auth()->user()->name }}</h4>
                        <p class="sub-text">{{ auth()->user()->email }}</p>
                        @if (auth()->user()->employee)
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="sub-text">
                                        <td>
                                            <b>Employee ID:</b>
                                        </td>
                                        <td>
                                            {{ auth()->user()->employee->employee_id }}
                                        </td>
                                    </tr>
                                    <tr class="sub-text">
                                        <td>
                                            <b>Department:</b>
                                        </td>
                                        <td class="text-left">
                                            @if (auth()->user()->employee->department)
                                                {{ auth()->user()->employee->department->name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="sub-text">
                                        <td>
                                            <b>Designation:</b>
                                        </td>
                                        <td class="text-left">
                                            @if (auth()->user()->employee->designation)
                                                {{ auth()->user()->employee->designation->name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="sub-text">
                                        <td>
                                            <b>Submitted Documents:</b>
                                        </td>
                                        <td class="text-left">
                                            {{ ucwords(auth()->user()->employee->received_documents) }}
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        @endif
                    </div>
                </div><!-- .card-inner -->
                @if (auth()->user()->employee)
                    <div class="card-inner">
                        <div class="user-account-info py-0">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="overline-title-alt">Last Payout</h6>
                                    <div class="user-balance" style="font-size:1.3rem !important;">
                                        <span class="currency currency-btc">₹</span>
                                        @if ($lastPayout)
                                            {{ $lastPayout->total_salary }}
                                        @else
                                            0
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h6 class="overline-title-alt">Deposits</h6>
                                    <div class="user-balance" style="font-size:1.3rem !important;">
                                        <span class="currency currency-btc">₹</span>
                                        @if ($totalDeposits)
                                            {{ $totalDeposits }}
                                        @else
                                            0
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner p-0">
                        <ul class="nav link-list-menu border border-light round m-0">
                            <li>
                                <a class="active" data-toggle="tab" href="#tabItem1"><em
                                        class="icon ni ni-user"></em><span>Personal</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabItem2"><em
                                        class="icon ni ni-book-read"></em><span>Work</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabItem3"><em
                                        class="icon ni ni-lock-fill"></em><span>Banking</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabItem4"><em
                                        class="icon ni ni-lock-alt"></em><span>Security</span></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tabItem5"><em
                                        class="icon ni ni-coins"></em><span>Assets</span></a>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                @endif
            </div><!-- .card-aside -->
        </div><!-- .card-aside-wrap -->
    </div><!-- .card -->
    </div><!-- .card -->
    </div><!-- .nk-block -->
@endsection
@push('custom-js')
    <script>
        $('#profile_image').change(function(event) {
            $('#profile-change').submit();
        });
    </script>
@endpush
