 @extends('layout')

@section('title', 'Manage Forms')
@section('PageTitle', 'Manage Forms')
@section('breadcrumb1', 'Manage Forms')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" id="search-input" class="form-control form-control-solid w-500px ps-14"
                                placeholder="Search user" />
                        </div>
                    </div>

                </div>
                <div id="search-results" class="card-body py-4">
                    <table id="alldata" class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr style="text-color: black" class="text-start   fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px  pe-2">
                                </th>
                                <th class="min-w-90px">Form Number</th>
                                <th class=" min-w-100px">Name</th>
                                <th class="min-w-125px">DOB</th>
                                <th class=" min-w-100px">Gender</th>
                                <th class=" min-w-100px">Nationality</th>
                                <th class=" min-w-100px">Attachment</th>
                                <th class=" min-w-100px">Form date</th>
                                <th class=" min-w-100px">HR Coordinator Status</th>
                                <th class=" min-w-100px">HR Manager Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($forms as $form)
                                <tr>
                                    <td></td>
                                    <td>{{ $form->id }}</td>
                                    <td>{{ $form->name }}</td>
                                    <td>{{ $form->dob }}</td>
                                    <td>{{ ucfirst($form->gender) }}</td>
                                    <td>{{ $form->nationality }}</td>
                                    {{-- <td><a href="{{ asset('storage/' . $form->cv_attachment) }}" target="_blank">View</a></td> --}}
                                    <td><a href="{{ Storage::url($form->cv_attachment) }}" class="" target="_blank">View</a></td>

                                    <td>{{ $form->created_at }}</td>

                                    <td class="text-center">
                                        @if (Auth::user()->type == 'hr_coordinator')
                                            @if ($form->actions->isEmpty() || optional($form->actions->first())->hr_accepted === null)
                                                <form action="{{ route('forms.accept', $form->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                                </form>
                                                <form action="{{ route('forms.reject', $form->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            @else
                                                {{ optional($form->actions->first())->hr_accepted ?? 'Pending' }}
                                            @endif
                                        @else
                                            {{ optional($form->actions->first())->hr_accepted ?? 'Pending' }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (Auth::user()->type == 'hr_manager')
                                            @if (optional($form->actions->first())->hr_accepted === 'accepted' && optional($form->actions->first())->manager_accepted === null)
                                                <form action="{{ route('forms.accept', $form->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                                </form>
                                                <form action="{{ route('forms.reject', $form->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            @else
                                                {{ optional($form->actions->first())->manager_accepted ?? 'Pending' }}
                                            @endif
                                        @else
                                            {{ optional($form->actions->first())->manager_accepted ?? 'Pending' }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/export-users.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/add.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/update-details.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection
