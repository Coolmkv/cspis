<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    @include('includes.head')
</head>

<body id="page2" class="bg-light">
    <div class="container-fluid p-0">

        <main>
            <div class="body1">
                <div class="main">
                    <!-- header -->

                    @include('includes.insideHeader')

                    <!-- / header -->
                </div>
            </div>
            <div class="">
                <div class="main">

                    @yield('content')

                </div>
            </div>
        </main>
        <!-- footer -->
        @include('includes.footer')
        <!-- / footer -->
    </div>



    @include('includes.script')
</body>

</html>
