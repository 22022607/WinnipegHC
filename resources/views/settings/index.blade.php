@extends('layouts.app')

@section('content')

<style>
    #loader {
            display: none; /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            z-index: 1000; /* Ensure it's above other content */
        }
</style>

<div class="pagetitle mb-4" >
    <h1>CMS Management</h1>
</div><!-- End Page Title -->
<div class="container">
<section class="section dashboard">
    <div class="card info-card p-2">
        <div class="card-body">
            <div class="cms-panel">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-aboutUs-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-aboutUs" type="button" role="tab" aria-controls="pills-aboutUs"
                            aria-selected="true">About Us</button>
                    </li>
                   
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-privacy-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-privacy" type="button" role="tab" aria-controls="pills-privacy"
                            aria-selected="false">Privacy Policy</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-terms-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-terms" type="button" role="tab" aria-controls="pills-terms"
                            aria-selected="false">Terms and Condition</button>
                    </li>
                   
                   
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">Contact US</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-faqs-tab" data-bs-toggle="pill" data-bs-target="#pills-faqs"
                            type="button" role="tab" aria-controls="pills-faqs" aria-selected="false">FAQs</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-aboutUs" role="tabpanel"
                        aria-labelledby="pills-aboutUs-tab" tabindex="0">
                        <form action="{{ route('content.about.store') }}" method="POST">
                            @csrf  
                        <div class="cms-wapper">
                            <div class="cms-header py-2">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3>About Us</h3>
                                    </div>
                                   
                                </div>
                            </div>
                            <hr>
                            <div class="about-content">
                           
                            <div id="loader">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                                <input type="hidden" name="about" id="about">

                            <div id="editor" >
                                 {{-- <textarea id="editor" name="content">{{ $about->content ?? '' }}</textarea> --}}
                                 {!! $about->content ?? '' !!}
                            </div>
                                <input type="hidden" name="slug" value="about_us">
                                
                            </div>
                            
                        </div>                
                        <button type="submit" class="btn btn-success btn-sm justify-content-center !important" 
                           >Add
                        </button>
                    </form>         
                    </div>
                    <div class="tab-pane fade" id="pills-privacy" role="tabpanel" aria-labelledby="pills-privacy-tab"
                        tabindex="0">
                        <div class="cms-wapper">
                            <form action="{{ route('content.privacy.store') }}" method="POST">
                                @csrf
                            <div class="cms-header py-2">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3>Privacy Policy</h3>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="about-content">
                                <textarea name="privacy" id="editor1">{{ $privacy->content ?? '' }}</textarea>
                            </div>

                            <input type="hidden" name="slug" value="privacy_policy">

                            <button type="submit" class="btn btn-success btn-sm justify-content-center !important">
                                Add
                            </button>
                        </form>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="pills-terms" role="tabpanel" aria-labelledby="pills-terms-tab"
                        tabindex="0">
                        <div class="cms-wapper">
                            <form action="{{ route('content.terms.store') }}" method="POST">
                                @csrf
                            <div class="cms-header py-2">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3>Terms and Condition</h3>
                                    </div>
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="about-content" >
                                <textarea name="terms" id="editor2">{{ $terms->content ?? '' }}</textarea>
                            </div>

                            <input type="hidden" name="slug" value="terms_and_conditions">
 
                            <button type="submit" class="btn btn-success btn-sm justify-content-center !important">
                                Add
                            </button>
                            </form>
                        </div>
                    </div>

                  

               

                 

                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                        tabindex="0">
                        <div class="cms-wapper">
                            <form action="{{ route('content.store') }}" method="POST">
                                @csrf
                            <div class="cms-header py-2">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3>Contact Us</h3>
                                    </div>
                                  
                                </div>
                            </div>
                            <hr>
                            <div class="about-content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="text" name="email" value="{{ $data->email ?? '' }}" class="form-control" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" name="phone" value="{{ $data->phone ?? '' }}" class="form-control" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text" name="location" value="{{ $data->location ?? '' }}" class="form-control" placeholder="Enter Location">
                                        </div>
                                    </div>
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="message">Office Hours</label>
                                            <input type="text" name="office_hours" value="{{ $data->office_hours ?? '' }}" class="form-control" rows="4" placeholder="Enter Office Hours"></input>
                                        </div>
                                    </div>
                                  
                                 

                                </div>
                                <div class="login-btn mt-5 text-center">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>


                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-faqs" role="tabpanel" aria-labelledby="pills-faqs-tab"
                        tabindex="0">
                        <div class="cms-wapper">
                            <div class="cms-header py-2">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3>FAQs</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex gap-4">
                                           
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#FaqModal" style="width:140px;">Add FAQs</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="about-content">
                                <!-- Accordion without outline borders -->
                               <div class="accordion accordion-flush" id="accordionFlushExample">
                                    @foreach($faqs as $index => $faq)
                                        <div class="accordion-item">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <h2 class="accordion-header" id="faq{{ $faq->id }}">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $faq->id }}"
                                                            aria-expanded="false" aria-controls="flush-collapse{{ $faq->id }}">
                                                            <div style="font-size:20px;">
                                                                <span>Question:</span> {{ $faq->question }}
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                                        aria-labelledby="faq{{ $faq->id }}" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">
                                                            <p>{!! $faq->answer !!}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2">
                                                    <div class="faqBtn">
                                                        <button class="btn btn-edit"><i class="bi bi-pencil-square"></i></button>
                                                        <button class="btn btn-edit"><i class="bi bi-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



   


    <!-- Add FAQs Modal -->
    <div class="modal fade" id="FaqModal" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add FAQs </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <form action="{{ route('front.faq') }}" method="POST">
                            @csrf

                        <div class="form-group">
                            <label for="brand">Question Title</label>
                            <input type="text" name="question" class="form-control" placeholder="Enter question">
                        </div>
                        <div class="form-group">
                            <label for="brand">Answer</label>
                            <textarea class="form-control" name="answer" rows="4"></textarea>
                        </div>

                        <div class="login-btn mt-4">
                            <button type="submit" class="btn btn-success w-100">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <script>
    $(document).ready(function() {

        const loader = document.getElementById('loader');
        const minLoaderTime = 1000; // Minimum loader display time in milliseconds
        const startTime = Date.now();

        // Show the loader
        loader.style.display = 'block';

        ClassicEditor
            .create(document.querySelector("#editor"))
            .then(editor => {
                editor.ui.view.editable.element.style.height = ""; // Set the height
                const elapsedTime = Date.now() - startTime;
                const timeToHide = Math.max(minLoaderTime - elapsedTime, 0); // Ensure non-negative

                // Hide the loader after the minimum time
                setTimeout(() => {
                    loader.style.display = 'none';
                }, timeToHide);
            })
            .catch(error => {
                console.error(error);
                const elapsedTime = Date.now() - startTime;
                const timeToHide = Math.max(minLoaderTime - elapsedTime, 0);

                setTimeout(() => {
                    loader.style.display = 'none';
                }, timeToHide);
            });





        // imgInp.onchange = evt => {
        //     const [file] = imgInp.files
        //     if (file) {
        //         brandImg.src = URL.createObjectURL(file)
        //     }
        // }
        
    });
    ClassicEditor
        .create(document.querySelector("#editor1"))
        .catch(error => {
            console.error(error);
        });

    // Image preview
    // imgInp.onchange = evt => {
    //     const [file] = imgInp.files;
    //     if (file) {
    //         brandImg.src = URL.createObjectURL(file);
    //     }
    // };
   
    </script>
    <script>
         ClassicEditor
        .create(document.querySelector("#editor2"))
        .catch(error => {
            console.error(error);
        });

    // Image preview
    // imgInp.onchange = evt => {
    //     const [file] = imgInp.files;
    //     if (file) {
    //         brandImg.src = URL.createObjectURL(file);
    //     }
    // };
    </script>
@endsection
