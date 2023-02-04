<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    @include('includes.head')
</head>

<body id="page1" class="bg-light">
    <div class="body1 container">
      <main>
        <div class="main">
          <!-- header -->
          
          @include('includes.header')
          
          <!-- / header -->
        </div>
      </div>
      <div class="body2">
          <div class="main">
      
      @yield("content")
      </main>
      
    <!-- footer -->       
    @include("includes.footer")
    <!-- / footer -->
  </div>
</div>
    @include("includes.script")
    </body>
</html>
