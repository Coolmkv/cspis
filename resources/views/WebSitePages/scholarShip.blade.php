@extends('layout.websiteInside')
@section('content')
    <!-- content -->
    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <h2 class="text-center">Scholarship Form</h2>

                     
                    <form action="javascript:" method="POST" id="registerStudent" enctype='multipart/form-data' >
                        @csrf
                        <div class="row">
                            <x-input-group-element title="First Name" placeholder="First Name" name="fname" required id="fname"></x-input-group-element>
                            <x-input-group-element title="Last Name" placeholder="Last Name" name="lname" required
                                id="lname"></x-input-group-element>
                            <x-input-group-element title="Father Name" placeholder="Father Name" name="father_name" required
                                id="father_name"></x-input-group-element>
                            <x-select-group-element title="Gender" name="gender" required id="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>

                            </x-select-group-element>
                            <x-input-group-element title="Date of birth" placeholder="Date of birth" type="date"
                                max="2012-01-01" name="dob" required id="dob"></x-input-group-element>
                            <x-input-group-element title="Aadhar number" placeholder="Aadhar number" name="aadhar_number"
                                required id="aadhar_number" maxlength="12"></x-input-group-element>
                            <x-select-group-element title="Religion" name="religion" required id="religion">
                                <option value="">Select Religion</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Muslim">Muslim</option>
                                <option value="Sikh">Sikh</option>
                                <option value="Parsi">Parsi</option>
                                <option value="Jain">Jain</option>
                                <option value="Budhhist">Budhhist</option>
                                <option value="Other">Other</option>
                            </x-select-group-element>
                            <x-select-group-element title="Category" name="category" required id="category">
                                <option value="">Select Category</option>
                                <option value="General">General</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                                <option value="OBC">OBC</option>
                                <option value="Others">Others</option>
                            </x-select-group-element>
                            <x-input-group-element title="Address" placeholder="Address" name="address" required
                                id="address"></x-input-group-element>
                            <x-input-group-element title="District" placeholder="District" name="district" required
                                id="district"></x-input-group-element>
                            <x-input-group-element title="State" placeholder="State" name="state" required
                                id="state"></x-input-group-element>
                            <x-input-group-element title="Pincode" placeholder="Pincode" name="pincode" required
                                id="pincode" maxlength="6" accept="number"></x-input-group-element>
                            <x-input-group-element title="Contact Number" placeholder="Contact Number" name="mobile"
                                required id="mobile" maxlength="10"></x-input-group-element>
                            <x-input-group-element
                                onchange="imagesizeValidation('photo',10,100,'Min 10 Kb Upto 100 Kb')"
                                title="Photo (Min 10 Kb Upto 100 Kb)" type="file" name="photo" required id="photo"
                                accept="image/*"></x-input-group-element>
                            <x-input-group-element title="Signature"
                                onchange="imagesizeValidation('signature',10,30,'Min 10 Kb Upto 30 Kb')"
                                title="Signature (Min 10 Kb Upto 30 Kb)" type="file" name="signature" required id="signature"
                                accept="image/*"></x-input-group-element>
                            <x-select-group-element title="Class" name="class_passed" required id="class_passed">
                                <option value="">Select Class</option>
                                <option value="5th">5th</option>
                                <option value="6th">6th</option>
                                <option value="7th">7th</option>
                                <option value="8th">8th</option>
                                <option value="9th">9th</option>
                                <option value="10th">10th</option>
                                <option value="11th">11th</option>
                                <option value="12th">12th</option>
                            </x-select-group-element>
                            <x-input-group-element title="Year Passed" placeholder="Year Passed" type="date"
                                name="year_of_passing" required id="year_of_passing"></x-input-group-element>
                            <x-input-group-element title="Board" placeholder="Board" name="board" required
                                id="board"></x-input-group-element>
                            <x-input-group-element title="School" placeholder="School" name="school" required
                                id="school"></x-input-group-element>
                            
                            <div class="col-md-4 col-sm-12 mb-3">
                                <label class="form-label" for="CaptchaImg">Capthca Image<span class="text-danger">*</span>
                                </label>
                                <div>
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
                            <x-input-group-element title="Enter Captcha" placeholder="Enter Text From Image" name="captcha" required
                                id="captcha"></x-input-group-element>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    <script type="text/javascript">
     $(document).ready(function() {
            $("#registerStudent").on("submit", function(e) {
                if(checkAadhar()){
                    var form = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("registerStudentInfo") }}',
                        data: form,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if(response.status){
                                window.location = '{{ route("completePurchase") }}';
                            }else{
                                errorMessage(response.message);
                            }
                        },
                        failure: function(response) {
                            errorMessage(response.message);
                        }
                    });
                }else{
                    e.preventDefault();
                    errorMessage("Invalid aadhar");
                    return false;
                }
                
            });
        });
        
        function checkAadhar(){
            {
                var regex =
                    /^([0-9]{4}[0-9]{4}[0-9]{4}$)|([0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|([0-9]{4}-[0-9]{4}-[0-9]{4}$)/;
                if (regex.test($("#aadhar_number").val())) {
                    
                    return true;
                } else {
                    //for testing
                    return false;
                }
            }
        }

        function imagesizeValidation(id, validSizeStartInKb, validSizeEndInkb, failmessage) {

            var fileUpload = document.getElementById(id);
            if (typeof(fileUpload.files) != "undefined") {
                var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
                if (size > validSizeEndInkb || size < validSizeStartInKb) {
                    errorMessage(failmessage);
                    fileUpload.value="";
                } else {
                    return false;
                }
            } else {
                errorMessage("This browser does not support HTML5.");
            }
        }

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
