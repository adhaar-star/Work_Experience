<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Online Project Planning Software | @yield('title')</title>
        <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" type="text/css" href="css/style.css">
   </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        @include('include.navbar')
    <section id="service" class="section-padding">
            <div class="container">
                 <!--   <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h5 class="text-center">
                            Loved by 83,000+ small groups to large companies worldwide
                        </h5>
                        </br> </br>
                        <div class="text-center">
                            <ul class="list-inline">
                                <li> <img src="{{asset('images/h-michigan-university-bw.png')}}" alt=""></li>
                                <li><img src="{{asset('images/h-netflix-logo-bw.png')}}" alt=""> </li>
                                <li><img src="{{asset('images/h-google-logo-bw.png')}}" alt=""> </li>
                                <li><img src="{{asset('images/h-walt-disney-bw.png')}}" alt=""> </li>
                                <li><img src="{{asset('images/h-nasa-bw.png')}}" alt=""> </li>
                                <li><img src="{{asset('images/h-nike-logo-bw.png')}}" alt=""> </li>
                                <li><img src="{{asset('images/h-pinterest-logo-bw.png')}}" alt=""> </li>
                                <li><img src="{{asset('images/h-tripadvisor-bw.png')}}" alt=""> </li>
                            </ul>
                        </div>
                    </div>
                </div>-->
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                   <!--   <iframe src="https://www.youtube.com/embed/U831UfrniLU?version=3&amp;modestbranding=1&amp;enablejsapi=1&amp;autoplay=0&amp;rel=0&amp;showinfo=0&amp;wmode=opaque&amp;vq=hd720&amp;theme=dark&amp;controls=1&amp;start=4&amp;cc_load_policy=1&amp;fs=0&amp;showinfo=0" id="proofhubVideo1" style="background-color:#fff;" allowfullscreen="" width="100%" height="563" frameborder="0">
                      </iframe>-->
					  <div class="col-md-6 text-center">
					  <h2 style="padding-top:25%;font-weight:600;">PPM<br><br>Hub demo<br><br>How it works?</h2>
					  
					  </div>
					  <div class="col-md-6">
					  <img src="images/girl.png" alt="image">
					  </div>
                    </div>
                </div>      
            </div>
        </section>

        <section id="cta-1" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="container">
                        <h3 class="text-center thin">All the elements of project management and collaboration</br>
                        come together with PPMHub.</h3>
                        <div class="row">
                            <div class="col-md-3 col-sm-12 highlight ">
                                <div class="nborder">
                                    <div class="count-circle">1</div>
                                    <div class="h-caption"><h4>Plan better</h4></div>
                                    <div class="h-body text-center">
                                        <p class="center">PPMHub provides your team the right tools to plan ahead. Define goals, share ideas and develop strategies to get the best out of your team.
                                        
                                        </p>
                                        <p><a href="#">Planning features </a> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 highlight">
                                <div class="nborder">
                                    <div class="count-circle">2</div>
                                    <div class="h-caption"><h4>Collaborate</h4></div>
                                    <div class="h-body text-center">
                                        <p>With PPMHub's collaboration tools your teams can share ideas, discuss matters, provide feedback, find answers and stay in sync.</p>
                                        <p><a href="#">Collaboration features</a> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 highlight">
                                <div class="count-circle">3</div>
                                <div class="nborder">
                                    <div class="h-caption"><h4>Stay organized</h4></div>
                                    <div class="h-body text-center">
                                        <p>PPMHub has the right tools to keep work organized. Keep all documents, designs and conversations in one central place. </p>
                                        <p><a href="#">Organizing features</a> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 highlight">
                                <div class="count-circle">4</div>
                                <div class="nborder">
                                    <div class="h-caption"><h4>Deliver on time</h4></div>
                                    <div class="h-body text-center">
                                        <p>Using PPMHub, keeping projects on track is easy. View project progress, see how resources are utilized and take required actions to stay on trac

                                        </p>
                                        <p><a href="#">Delivering features</a> </p>
                                    </div>
                                </div>
                                </br> </br>
                            </div>
                            <p class="text-center"><a href="https://www.proofhub.com/how-it-works/plan/" class="btn btn-default btn-lg how-proofhub-btn" role="button">See how PPMHub works</a></a></p>
                        </div>
                    </div>
                </div> 
            </div>
        </section>
        
        <section id="about" class="section-padding">
            <div class="container">
                <div class="row">
                    <h2 class="text-center top-space">Complete Portfolio and Project management software</h2></br></br>
                    <p class="text-center">PPMHub gives you all the powerful tools you need to make every project a big success. </p>
                    <br>

                    <div class="row bottmarg">
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/task-management-icon.svg')}}" alt="Time Tracking Icon" width="34" height="34">
                            <h3>Task and Resource management</h3>
                            <p>Create tasks and subtasks, assign them to multiple people and get things done quickly and efficiently.</p>
                        </div>
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/time-tarcking-icon.svg')}}" alt="Time Tracking Icon" width="34" height="34">
                            <h3>Time sheets</h3>
                            <p>Capacity planning at Portfolio level, project level. Actual time entry against projects and reporting at Portfolio level.</p>
                        </div>
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/gantt-charts-icon.svg')}}" alt="Time Tracking Icon" width="34" height="34">
                            <h3>Gantt charts</h3>
                            <p>Set dependencies between tasks to see how changes in one impact the other and track your project progress.</p>
                        </div>
                    </div> 
                    <div class="row bottmarg">
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/discussion-icon.svg')}}" alt="Time Tracking Icon" width="34px" height="34px">
                            <h3>Discussions</h3>
                            <p>Create discussion topics and invite your team, clients or anyone involved in the projects to collaborate seamlessly.</p>
                        </div>
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/report-icon.svg')}}" alt="Reports Icon" alt="Time Tracking Icon" width="34px" height="34px">
                            <h3>Reports</h3>
                            <p>Know the status of projects, see how resources are utilized and take required actions to stay on track.</p>
                        </div>
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/file-sharing-icon.svg')}}" alt="Time Tracking Icon" width="34px" height="34px">
                            <h3>File sharing</h3>
                            <p>Organize your important stuff neatly and securely in files and folders, and share them easily with others.</p>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/calender-icon.svg')}}" alt="Time Tracking Icon" width="34px" height="34px">
                            <h3>Calendar</h3>
                            <p>Keep track of all your tasks, meetings and appointments; and stay updated on all your deliverables.</p>
                        </div>
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/notes-icon.svg')}}" alt="Time Tracking Icon" width="34px" height="34px">
                            <h3>Notes</h3>
                            <p>Store all your articles, press releases, meeting notes etc. at one place and add collaborators to get their inputs towards these notes.</p>
                        </div>
                    
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/proofing-icon.svg')}}" alt="Time Tracking Icon" width="34px" height="34px">
                            <h3>Proofing</h3>
                            <p>Streamline the proofing and approval process and share your feedback on files and documents easily.</p>
                        </div>
                    </div>
                    <div class="row bottmarg">
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/interation-icon.svg')}}" alt="Time Tracking Icon" width="34px" height="34px">
                            <h3>Integrations</h3>
                            <p>Connect all your work scattered across different apps like Box, Dropbox, Freshbooks etc. to PPMHub.</p>
                        </div>
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/chat-icon.svg')}}" alt="Time Tracking Icon" width="34px" height="34px">
                            <h3>Chat</h3>
                            <p>Share ideas, discuss issues and find answers by maintaining a clear flow in communication between you and your team members.</p>
                        </div>
                        <div class="col-md-4 col-sm-4 text-center">
                            <img class="normal" src="{{asset('images/white-label-icon.svg')}}" alt="Time Tracking Icon" width="34px" height="34px">
                            <h3>White-labeling</h3>
                            <p>Personalize your account to give it a look and feel of your business by adding a logo, using a custom domain name, setting a theme, and lots more.</p>
                            <br> </br><br> </br>
                        </div>
                        <p class="text-center"><a class="btn explore-features-btn" role="button">Give PPMHub a try. It's Free!</a></p>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonial">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                        <div class="testimonials">
                            <div class="active item">
                              <blockquote>
                                  <p class="text-center"> <span class="left-arrow"></span> We are new to PPMHub and loving it. The team is always very helpful and gets back to us quickly whenever we have questions. Thanks for the great product and service! <span class="right-arrow"></span></p>
                                  <ul class="rating text-center">
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                  </ul>
                              </blockquote>
                              <div class="carousel-info text-center">
                                <img alt="" src="{{asset('images/naz-tadjbakhsh.png')}}">
                                <span class="testimonials-name">&mdash; Naz Tadjbakhsh, <b>Taco Bell</b></span>
                                <br> </br><br> </br>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('include.footer')
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
        <script src="{{asset('js/custom.js')}}"></script>
    </body>
</html>
