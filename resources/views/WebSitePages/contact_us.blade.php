@extends('layout.websiteInside')
@section('content')
    <!-- content -->
    <section id="content">
        <div class="box1">
            <div class="wrapper">
                <article class="col1">
                    <div class="pad_left1">
                        <h2>Contact Form</h2>
                        <form id="ContactForm" action="javascript:" autocomplete="off">
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
                                        <textarea name="message" cols="1" rows="1" required></textarea>
                                    </div>
                                </div>
                                <div class="wrapper"> <strong>Captcha:</strong>
                                    <div class="bg">
                                        <div>
                                            <input placeholder="Captha Text" style="width: 100%;height:43px;" type="text" class="input" name="captcha" id="captcha" required><br>
                                            
                                        </div> 
                                    </div>
                                    <div style=" margin-left:10px">
                                        <img src="{{captcha_src()}}" class="img-thumbnail" name="captcha_img" id="captcha_img_id">
                                            
                                            <button type="button" class="btn btn-primary" onclick="refreshCapthca()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                    <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                                    <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                                  </svg>
                                                  Refresh
                                            </button>
                                    </div>
                                </div>
                               <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary" >
                                    Send
                                </button>
                                <input type="reset" id="resetButton" class="btn btn-danger" value="Clear">  
                               </div>
                                
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
    <script>
        $(document).ready(function() {
            $("#ContactForm").on("submit", function(e) {
                
                var form = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("contactUsSubmit") }}',
                        data: form,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if(response.status){
                                successMessage(response.message);
                                $("#resetButton").trigger("click");
                            }else{
                                errorMessage(response.message);
                            }
                        },
                        failure: function(response) {
                            errorMessage(response.message);
                        }
                    });
               
            });
        });
        function refreshCapthca(){
            $.ajax({
                url:'{{ route("refreshCaptcha") }}',
                method:'get',
                dataType:'json',
                success:function(response){
                    if(response.status){
                        $("#captcha_img_id").attr("src",response.data);
                        $("#captcha").val("");
                    }else{
                        errorMessage(response.message);
                    }
                },
                error:function(err){
                    errorMessage("error occurred");
                }
            });
        }
    </script>
@endsection
