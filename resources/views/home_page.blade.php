@extends('layout.app_layout')
@section("content")
<div>
    <img src="assets/images/csps_home_scholarship.jpg" class="w100" alt="Main content 2">
</div>
      <!-- content -->
      <section id="content">
        <div class="wrapper bg-white">
          <div class="pad1 pad_top1 ">
            <article class="cols marg_right1">
              <figure>
                <a href="#"><img src="assets/images/sss-280x250w.jpg" alt=""></a></figure>
                <span class="font1">Startup India</span>
            </article>
            <article class="cols marg_right1">
              <figure><a href="#"><img src="assets/images/gff-280x250w.jpeg" alt=""></a></figure>
              <span class="font1">Make In India</span>              
            </article>
            <article class="cols marg_right1">
              <figure><a href="#"><img src="assets/images/ggff-280x250w.png" alt=""></a></figure> 
              <span class="font1">Skill India</span>              
            </article>
            <article class="cols marg_right1">
                <figure><a href="#"><img src="assets/images/gffg-280x250w.png" alt=""></a></figure>
                <span class="font1">Go Green</span>               
              </article>
          </div>
        </div>
        <div class="box1">
          <div class="wrapper">
            <article>
              <div class="pad_left1">
                <h2>Welcome to CSP International School</h2>
                <p class="font2">CSP International School </p>
                <p><strong>We are the leader of quality education.</strong> With skilled teachers and a vision to cater future talent we are striving hard.</p>
              </div>
              <a href="{{ route("aboutUs") }}" class="button"><span><span>Read More</span></span></a>
              <div class="pad_left1">
                <h2>Individual Approach to Education!</h2>
              </div>
              <div class="wrapper">
                <figure class="left marg_right1"><img src="assets/images/page1_img4.jpg" alt=""></figure>
                <p class="pad_bot1 pad_top2"><strong>For quality education and to ensure overall development.</strong></p>
                <p>Our dedicated staff is all about Students welfare and their development</p>
              </div>
              <div class="pad_top2"> <a href="{{ route("aboutUs") }}" class="button"><span><span>Read More</span></span></a> </div>
            </article>
            
          </div>
        </div>
      </section>
      <!-- content -->
      
@endsection