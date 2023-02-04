@extends('layout.websiteInside')
@section('content')
    <!-- content -->
    <section id="content">
        <div class="box1">
            <div class="wrapper">
                <article class="col1">
                    <div class="pad_left1">
                        <h2>Contact Form</h2>
                        <form id="ContactForm" action="#" autocomplete="off">
                            @csrf
                            <div>
                                <div class="wrapper"> <strong>Name:</strong>
                                    <div class="bg">
                                        <input type="text" class="input" name="username" required>
                                    </div>
                                </div>
                                <div class="wrapper"> <strong>Email:</strong>
                                    <div class="bg">
                                        <input type="email" class="input" name="email" id="email_id" required>
                                    </div>
                                </div>
                                <div class="wrapper"> <strong>Mobile:</strong>
                                    <div class="bg">
                                        <input type="numeric" class="input" name="phone_number" id="phone_number" required>
                                    </div>
                                </div>
                                <div class="wrapper"> <strong>Topic:</strong>
                                    <div class="bg">
                                        <select class="select" name="topic" id="topic" required>
                                            <option value="">Select</option>
                                            <option value="Admission">Admission</option>
                                            <option value="Carrier">Carrier</option>
                                            <option value="Scholarship">Scholarship</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="textarea_box"> <strong>Message:</strong>
                                    <div class="bg">
                                        <textarea name="textarea" cols="1" rows="1" required></textarea>
                                    </div>
                                </div>
                                <a href="#" class="button"><span><span>Send</span></span></a> <a href="#"
                                    class="button"><span><span>Clear</span></span></a>
                            </div>
                        </form>
                    </div>
                </article>
                <article class="col2 pad_left2">
                    <div class="pad_left1">
                        <h2>Contact Us</h2>
                        <p>
                            Office address : 60 A Ground Floor, oppsite central hospital, Tilak Nagar, Delhi, 110018</p>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <!-- content -->
@endsection
