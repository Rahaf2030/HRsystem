<!DOCTYPE html>
<html lang="en">
@include('common.head')
<body>
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root">
        <style>
            body {
                background-image: url('assets/media/auth/bg10.jpeg');
            }

            [data-theme="dark"] body {
                background-image: url('assets/media/auth/bg10-dark.jpeg');
            }
        </style>
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('assets/media/auth/agency.png')}}" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('assets/media/auth/agency-dark.png')}}" alt="" />
                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7"> HR SYSTEM</h1>
                    <!--end::Title-->
                    <!--begin::Text-->

                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->

            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <!--begin::Wrapper-->
                <div class="bg-body d-flex flex-center rounded-4 w-md-600px p-10">
                    <!--begin::Content-->
                    <div class="w-md-400px">
                        <!--begin::Form-->

                        <form class="form w-100" novalidate="novalidate" method="post" action="{{ route('login') }}">

                            @if (Session::has('success'))
                                url{{ route('/home') }}
                            @endif

                            @csrf
                            {{-- <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                            </div> --}}
                            <div class="separator separator-content my-14">
                                <span class="w-125px text-gray-500 fw-semibold fs-7">
                                    <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                                </span>
                            </div>
                            <!--end::Separator-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="User Name" value="{{ old('email') }}" name="email" autocomplete="off"
                                    class="form-control bg-transparent" />
                                <!--end::Email-->
                                <span style="color:red">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div style="margin-top: 10px;">
                                    @if (Session::has('fail'))
                                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!--end::Input group=-->
                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <input type="password" placeholder="Password" name="password" autocomplete="off"
                                    class="form-control bg-transparent" />
                                <!--end::Password-->
                                <span style="color:red">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div style="margin-top: 10px;">
                                    @if (Session::has('failpass'))
                                        <div class="alert alert-danger">{{ Session::get('failpass') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">
                                    sign-in
                                </button>
                            </div>
                            @if (Session::has('message'))
                                        <div style="margin-top: 20px" class="alert alert-primary"> {{ Session::get('message') }} </div>
                           @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
</body>
</html>
