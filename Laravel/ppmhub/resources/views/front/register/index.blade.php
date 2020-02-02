@extends('new_layout.frontweb')
@section('title','Home Page')

@section('body')
<section class="top-bg">
    <div class="top">
        <div class="container-wide">
            <div class="top-content valign-wrapper">
                <h3>A portfolio and project management software to <b>plan</b>, <b>analyze</b>, <b>execute</b> and <b>deliver</b> projects of all sizes.
                <br />
                <br />
                <a href="#" class="btn-try waves-effect">Give PPMHUB a try. It's Free!</a> <a href="http://demo.ppmhub.com.au" class="btn-demo waves-effect">Demo</a></h3>
            </div>
        </div>
    </div>
</section>
<section class="how-it-works">
    <div class="container-wide">
        <div class="row" style="margin: 0;">
            <div class="col s12 m5 valign-wrapper demo-video-title">
                <h3 class="center-align">PPMHub Demo<br />How it Works?</h3>
            </div>
            <div class="col s12 m7">
                <div class="demo-video z-depth-4 center-align">
                    <iframe width="560" height="315" style="max-width: 100%;" src="http://www.youtube.com/embed/5lAoPQCevbQ?&rel=0&fs=0&showinfo=0&controls=0&hd=1&autohide=0" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="steps">
    <div class="container">
        <h3 class="center-align">All the elements of project management and collaboration come together with PPMHub.</h3>
        <ul>
            <li>
                <span class="number" style="background-color: #C8DB4D;">01</span>
                <div class="step-description">
                    <h5>Plan better</h5>
                    <p>PPMHub provides your team the right tools to plan ahead. Define goals, share ideas and develop strategies to get the best out of your team.</p>
                    <a href="#">Planning features</a>
                </div>
            </li>
            <li>
                <span class="number" style="background-color: #FC6042;">02</span>
                <div class="step-description">
                    <h5>Collaborate</h5>
                    <p>With PPMHub's collaboration tools your teams can share ideas, discuss matters, provide feedback, find answers and stay in sync.</p>
                    <a href="#">Collaboration features</a>
                </div>
            </li>
            <li>
                <span class="number" style="background-color: #FCB941;">03</span>
                <div class="step-description">
                    <h5>Stay organized</h5>
                    <p>PPMHub has the right tools to keep work organized. Keep all documents, designs and conversations in one central place.</p>
                    <a href="#">Organizing features</a>
                </div>
            </li>
            <li>
                <span class="number" style="background-color: #07BECC;">04</span>
                <div class="step-description">
                    <h5>Deliver on time</h5>
                    <p>Using PPMHub, keeping projects on track is easy. View project progress, see how resources are utilized and take required actions to stay on trac.</p>
                    <a href="#">Delivering features</a>
                </div>
            </li>
        </ul>
    </div>
</section>
<section class="features">
    <div class="container">
        <h3 class="center-align">Complete Portfolio and <br class="hide-on-med-and-down" />Project management software</h3>
        <p class="center-align">PPMHub gives you all the powerful tools you need to make every project a big success.</p>
        <div class="row">
            <div class="col s12 m6">
                <div class="feature">
                    <span class="feature-icon"><img src="{{asset('new_images/frontweb/task-management-icon.svg')}}" /></span>
                    <div class="feature-details">
                        <h6>Task and Resource management</h6>
                        <p>Create tasks and subtasks, assign them to multiple people and get things done quickly and efficiently.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="feature">
                    <span class="feature-icon"><img src="{{asset('new_images/frontweb/time-tarcking-icon.svg')}}" /></span>
                    <div class="feature-details">
                        <h6>Time sheets</h6>
                        <p>Capacity planning at Portfolio level, project level. Actual time entry against projects and reporting at Portfolio level.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="feature">
                    <span class="feature-icon"><img src="{{asset('new_images/frontweb/gantt-charts-icon.svg')}}" /></span>
                    <div class="feature-details">
                        <h6>Gantt charts</h6>
                        <p>Set dependencies between tasks to see how changes in one impact the other and track your project progress.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="feature">
                    <span class="feature-icon"><img src="{{asset('new_images/frontweb/discussion-icon.svg')}}" /></span>
                    <div class="feature-details">
                        <h6>Issue Management</h6>
                        <p>Create discussion topics and invite your team, clients or anyone involved in the projects to collaborate seamlessly.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="feature">
                    <span class="feature-icon"><img src="{{asset('new_images/frontweb/report-icon.svg')}}" /></span>
                    <div class="feature-details">
                        <h6>Reports</h6>
                        <p>Know the status of projects, see how resources are utilized and take required actions to stay on track.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="feature">
                    <span class="feature-icon"><img src="{{asset('new_images/frontweb/file-sharing-icon.svg')}}" /></span>
                    <div class="feature-details">
                        <h6>File sharing</h6>
                        <p>Organize your important stuff neatly and securely in files and folders, and share them easily with others.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="feature">
                    <span class="feature-icon"><img src="{{asset('new_images/frontweb/notes-icon.svg')}}" /></span>
                    <div class="feature-details">
                        <h6>Notes</h6>
                        <p>Store all your articles, press releases, meeting notes etc. at one place and add collaborators to get their inputs towards these notes.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="feature">
                    <span class="feature-icon"><img src="{{asset('new_images/frontweb/interation-icon.svg')}}" /></span>
                    <div class="feature-details">
                        <h6>Integrations</h6>
                        <p>Connect all your work scattered across different apps like Box, Dropbox, Freshbooks etc. to PPMHub.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="feature">
                    <span class="feature-icon"><img src="{{asset('new_images/frontweb/chat-icon.svg')}}" /></span>
                    <div class="feature-details">
                        <h6>Chatbot</h6>
                        <p>User can use chatbot to answer their doubts about the application functionality. The chatbot had been designed to answer your questions directly or direct you with appropriate document URL.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 center-align">
                <a href="#" class="btn-try waves-effect">Give PPMHUB a try. It's Free!</a>
            </div>
        </div>
    </div>
</section>
<section class="testimonials blue center-align">
    <div class="container">
        <div class="testimonial left-align">
            <img src="{{asset('new_images/frontweb/testimonial-icon.png')}}" class="testimonial-icon">
            <p>Another CRM provider left us with a totally unsatisfactory, unstable system which very few people in our business were actually using. PPMHub resolved all the legacy issues and provided us with a true business solution that our users quickly embraced.</p>
            <div>
                <img src="{{asset('new_images/frontweb/testimonial-face.jpg')}}" class="testimonial-client">
                <span class="testimonial-name">Dean Clarke</span>
                <span class="testimonial-desi"> - Senior Manager of XYZ Ltd.</span>
            </div>
        </div>
    </div>
</section>
@endsection
