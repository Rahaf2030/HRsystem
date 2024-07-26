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

    <div class="centered-div" style="display: flex; justify-content: center; align-items: center; height: 100vh;  padding: 20px; border-radius: 8px;">
        <div class="bg-body d-flex flex-center rounded-4 w-100 p-10" style="background-color: white;">
            <div class="w-100">
                <form class="form w-100" novalidate="novalidate" method="post" enctype="multipart/form-data" action="{{ url('/jobApplying') }}">
                    @csrf
                    <div class="separator separator-content my-14">
                        <span class="w-125px text-gray-500 fw-semibold fs-7">
                            <h1 class="text-dark fw-bolder mb-3">Form</h1>
                        </span>
                    </div>
                    <div class="fv-row mb-8">
                        <input type="text" placeholder="Enter Your Name" name="name" autocomplete="off" class="form-control bg-transparent" />
                        <span style="color:red">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="fv-row mb-8">
                        <input type="date" placeholder="Enter Your Date of Birth" name="dob" autocomplete="off" class="form-control bg-transparent" />
                        <span style="color:red">
                            @error('dob')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="fv-row mb-8">
                        <select name="gender" class="form-control bg-transparent">
                            <option value="">Select Your Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span style="color:red">
                            @error('gender')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="fv-row mb-8">
                        <input type="text" placeholder="Enter Your Nationality" name="nationality" autocomplete="off" class="form-control bg-transparent" />
                        <span style="color:red">
                            @error('nationality')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="fv-row mb-3">
                        <input type="file" placeholder="CV attachment" name="cv_attachment" autocomplete="off" class="form-control bg-transparent" />
                        <span style="color:red">
                            @error('cv_attachment')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="d-grid mb-10">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
                @if(session('success'))
                <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('fail'))
                <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px;">
                    {{ session('fail') }}
                </div>
            @endif
            </div>
        </div>
    </div>

    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>
</html>
