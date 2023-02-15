<header>
  {{-- <div class="homePageMenu">
    
  </div> --}}
  @include("includes.nav_item")
    <div class="wrapper ">
      <h1><a href="{{ url("/") }}" id="logo">Learn Center</a></h1>
    </div>
    <div id="slogan"> We Will Open The World<span>of knowledge for you!</span> </div>
    <ul class="banners">
      <li><a href="#"><img src="assets/images/banner12.jpg" alt=""></a></li>
      <li><a href="{{ route("studentInstructions") }}"><img src="assets/images/banner2.jpg" alt=""></a></li>
      <li><a href="#"><img src="assets/images/banner3.jpg" alt=""></a></li>
    </ul>
  </header>