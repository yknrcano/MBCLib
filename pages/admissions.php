<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <title>Marie-Bernarde College</title>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <div class="spinner"></div>
            <img src="assets/MBC-Logo.png" alt="Logo" class="spinner-logo">
        </div>
    </div>

    <nav class="navbar sticky-top navbar-expand-xl navbar-all">
        <div class="container-fluid navbar-inner">
            <img height="73" id="logo" src="assets/MBC-Logo.png" alt="Logo" class="d-inline-block align-text-center">
            <a class="navbar-brand text-white fs-3" href="home">
                Marie-Bernarde College
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navItems">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white active" aria-current="page" href="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="admissions">Admissions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="programs">Programs</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?url=aboutlist/history">History</a></li>
                            <li><a class="dropdown-item" href="?url=aboutlist/mission">Mission & Vision</a></li>
                            <li><a class="dropdown-item" href="?url=aboutlist/goals">Goals & Objectives</a></li>
                            <li><a class="dropdown-item" href="?url=aboutlist/values">Core Values</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class=" enroll-btn" href="">Enroll now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="admission-banner">
        <h1>Admissions</h1>
        <img src="assets/bg3-small.png" alt="background">
    </div>

    <div class="mini-nav">
        <i class="fa-solid fa-house"></i>
        <a href="home">Home</a> /
        <h3>Admission</h3>
    </div>

    <div class="admission-section">
        <h1>College Application Requirements</h1>
        
        <div class="admission-content-flex">
            <div class="admission-box">
                <p>Applicants are required to submit the following documents upon application for admission. Please ensure that all documents are complete to facilitate the processing of your application.</p>

                <div class="accordion">
                    <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Freshman
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                <li>Accomplished Student Application Form</li>
                                <li>PSA - issued Birth Certificate (Authenticated)</li>
                                <li>Grade 12 Senior High School Diploma (Photocopy)</li>
                                <li>Grade 12 Senior High School Report Card (Original Form - 138)</li>
                                <li>Original Form - 137</li>
                                <li>Certificate of Good Moral Character (Authenticated)</li>
                                <li>Four (4) pieces 2x2 colored picture with a white background</li>
                                <li>Two (2) pieces long folder</li>
                                <li>One (1) piece long brown envelope</li>
                                <li>One (1) piece long plastic envelope</li>
                            </ul>

                            <button type="button" class="btn btn-enrollment" data-bs-toggle="modal" data-bs-target="#EnrollmentModal">
                                Enrollment
                            </button>

                            <div class="modal" id="EnrollmentModal" tabindex="-1" aria-labelledby="EnrollmentLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="EnrollmentLabel">Enrollment Procedure</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                <span>Step 1: Admissions Office</span>
                                                <li>Fill out Admission Forms: Obtain the admission forms from the Admissions Office. Complete all required fields accurately and honestly.</li>
                                                <li>Submit the General Admission Requirements: Along with the filled-out forms, submit the general admission requirements.</li>
                                                <span>Step 2: Dean's Office</span>
                                                <li>Subject Enlistment: Once admitted, proceed to the Dean’s Office for subject enlistment.</li>
                                                <span>Step 3: Registrar's Office</span>
                                                <li>Claim the Assessment of Fees: After subject enlistment, go to the Registrar’s Office to claim the assessment of fees.</li>
                                                <span>Step 4: Finance Office</span>
                                                <li>Payment of Tuition Fee: Proceed to the Finance Office to settle the tuition fee and other fees indicated in the assessment.</li>
                                                <span>Step 5: Registrar's Office</span>
                                                <li>Claim the Printed Registration Form: Once the fees are settled, return to the Registrar’s Office to claim the printed registration form.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Transferee
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                <li>Accomplished Student Application Form</li>
                                <li>Certificate of Transfer (Honorable Dismissal)</li>
                                <li>PSA - issued Birth Certificate (Authenticated)</li>
                                <li>Official Transcript of Records (TOR)</li>
                                <li>Certificate of Good Moral Character (Authenticated)</li>
                                <li>Four (4) pieces 2x2 colored picture with a white background</li>
                                <li>Two (2) pieces long folder</li>
                                <li>One (1) piece long brown envelope</li>
                                <li>One (1) piece long plastic envelope</li>
                            </ul>
                        

                                <button type="button" class="btn btn-enrollment" data-bs-toggle="modal" data-bs-target="#EnrollmentTransferModal">
                                    Enrollment
                                </button>

                                <div class="modal" id="EnrollmentTransferModal" tabindex="-1" aria-labelledby="EnrollmentTransferLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="EnrollmentTransferLabel">Enrollment Procedure</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul>
                                                    <span>Step 1: Admissions Office</span>
                                                    <li>Fill out Admission Forms: Obtain the admission forms from the Admissions Office. Complete all required fields accurately and honestly.</li>
                                                    <li>Submit the General Admission Requirements: Along with the filled-out forms, submit the general admission requirements.</li>
                                                    <span>Step 2: Dean's Office</span>
                                                    <li>Subject Enlistment: Once admitted, proceed to the Dean’s Office for subject enlistment.</li>
                                                    <span>Step 3: Registrar's Office</span>
                                                    <li>Claim the Assessment of Fees: After subject enlistment, go to the Registrar’s Office to claim the assessment of fees.</li>
                                                    <span>Step 4: Finance Office</span>
                                                    <li>Payment of Tuition Fee: Proceed to the Finance Office to settle the tuition fee and other fees indicated in the assessment.</li>
                                                    <span>Step 5: Registrar's Office</span>
                                                    <li>Claim the Printed Registration Form: Once the fees are settled, return to the Registrar’s Office to claim the printed registration form.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Second Courser
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                <li>Accomplished Student Application Form</li>
                                <li>Certificate of Transfer (Honorable Dismissal)</li>
                                <li>PSA - issued Birth Certificate (Authenticated)</li>
                                <li>Official Transcript of Records (TOR)</li>
                                <li>Certificate of Good Moral Character (Authenticated)</li>
                                <li>Four (4) pieces 2x2 colored picture with a white background</li>
                                <li>Two (2) pieces long folder</li>
                                <li>One (1) piece long brown envelope</li>
                                <li>One (1) piece long plastic envelope</li>
                            </ul>

                            <button type="button" class="btn btn-enrollment" data-bs-toggle="modal" data-bs-target="#EnrollmentSecondModal">
                                Enrollment
                            </button>

                            <div class="modal" id="EnrollmentSecondModal" tabindex="-1" aria-labelledby="EnrollmentSecondLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="EnrollmentSecondLabel">Enrollment Procedure</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                <span>Step 1: Admissions Office</span>
                                                <li>Fill out Admission Forms: Obtain the admission forms from the Admissions Office. Complete all required fields accurately and honestly.</li>
                                                <li>Submit the General Admission Requirements: Along with the filled-out forms, submit the general admission requirements.</li>
                                                <li>Receive Curriculum: After successful completion of the above steps, a copy of the curriculum will be issued to the student.</li>
                                                <span>Step 2: Dean's Office</span>
                                                <li>Evaluation of Scholastic Record: The Dean’s Office will evaluate the official scholastic record of courses taken and grades obtained by the applicant.</li>
                                                <li>Interview with the Applicant: An interview with the applicant will be conducted to assess their academic goals and suitability for the program.</li>
                                                <li>Interview with the Parent/Guardian (Transferee): A separate interview with the parent/guardian will be conducted to discuss the student's educational background and support system.</li>
                                                <span>Step 3: Registrar's Office</span>
                                                <li> Crediting of Courses: The Registrar’s Office will credit the courses taken by the student based on the evaluated scholastic record.</li>
                                                <span>Step 4: Center For Career Counseling and Student Welfare</span>
                                                <li>Submit Certificate of Good Moral Character: Obtain and submit a Certificate of Good Moral Character.</li>
                                                <li>Attend Interviews: Applicants and their parents/guardians are required to attend interviews conducted by the Center for Career Counseling & Student Welfare.</li>
                                                <span>Step 5: Registrar's Office</span>
                                                <li>Discuss Marie Bernarde College's Policies: The Registrar’s Office will discuss Marie Bernarde College's policies and regulations with the student.</li>
                                                <li>Discuss Academic Policies: The Registrar’s Office will also discuss academic policies with the student.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="admission-btn">
                <h3>Procedures: </h3>
                <button type="button" class="btn btn-reservation" data-bs-toggle="modal" data-bs-target="#ReservationModal">
                    Reservation
                </button>

                <div class="modal" id="ReservationModal" tabindex="-1" aria-labelledby="ReservationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-4" id="ReservationModalLabel">Reservation Procedure</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul>
                                    <li>Payment of Fees: Applicants who pass the entrance examination are required to pay a non-refundable and non-transferable fee of ₱2,000.00. Payment is made over the counter at the Cashier’s Office.</li>
                                    <li>Reservation Fee: The ₱2,000.00 reservation fee will be deducted from the full tuition fee upon enrolment.</li>
                                    <li>Payment Deadline: Successful applicants must pay the reservation on specified dates. Failure to do so will result in forfeiture of their admission to the college, and the slot will be given to other applicants.</li>
                                    <li>Late Reservations: Reservations made beyond the specified schedule period will be subject to the availability of slots.</li>
                                    <li>Program Changes: Changing or shifting of degree/program will not be allowed after the payment of the reservation fee. Applicants should carefully consider their choices before making the payment.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-exam" data-bs-toggle="modal" data-bs-target="#examModal">
                    Entrance Exam
                </button>

                <div class="modal" id="examModal" tabindex="-1" aria-labelledby="examLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="examLabel">Entrance Exam Procedure</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul>
                                    <li>Submit Required Documents: Submit the required documents for the entrance examination. See General Admission Requirements.</li>
                                    <li>Pay Processing Fee: Pay the non-refundable and non-transferable processing fee of Php 500. This can be done in person at the Cashier's Office or through other designated channels.</li>
                                    <li>Secure Examination Permit: After payment, proceed to the Office of Admissions to secure your examination permit. You will need to present proof of payment to receive your permit.</li>
                                    <li>Take the Entrance Examination: On the scheduled date, arrive at the designated examination venue with your examination permit and valid ID. The entrance examination will assess your aptitude and readiness for the academic program.</li>
                                    <li>Await Results: After taking the examination, wait for the announcement of the results. This may take approximately 3 -5 working days.</li>
                                    <li>Receive Admission Decision: After passing the entrance examination, you will receive an offer of admission. Follow the instructions provided to complete your enrollment.</li>
                                    <li>Enroll: Once admitted, complete the enrollment process by submitting the required documents and paying any necessary fees.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        
    </div>
    
    
    
    





  





    <!-- Footer -->
    <div class="footer-top">
      <h2><img id="logo-footer" src="assets/MBC-Logo.png" alt="Logo" height="70">
        Marie-Bernarde College</h2>
    </div>
    <footer class="footer">
        <div class="footer-conts">
            <h4>Address</h4>
            <li><a href="https://www.google.com/maps/place/1116+Quirino+Hwy,+Novaliches,+Quezon+City,+Metro+Manila/@14.6984901,121.0334042,17z/data=!3m1!4b1!4m6!3m5!1s0x3397b12780c1bf9b:0x5c3f787264d9df67!8m2!3d14.6984901!4d121.0334042!16s%2Fg%2F11np7t3j8n?entry=ttu" target="_blank"><i class="fa-solid fa-location-dot"></i> 603 R&J Bldg, Quirino Highway, Novaliches, Quezon City, 1116.</a></li>
            <div class="footer-icons">
            <a href=""><i class="fa-brands fa-whatsapp"></i></a>
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-facebook-messenger"></i></a>
            </div>
        </div>

      <div class="footer-conts">
        <h4>Contacts</h4>
        <li><a href=""><i class="fa-solid fa-phone"></i> (02) 7216-4377</a></li>
        <li><a href=""><i class="fa-solid fa-phone"></i> (02) 8543-8751</a></li>
        <li><a href=""><i class="fa-solid fa-mobile-screen"></i> (+63) 917-124-8176</a></li>
      </div>

      <div class="footer-conts">
        <h4>Email</h4>
        <li><a href=""><i class="fa-regular fa-envelope"></i> registrar@mariebernardecollege.edu.ph</a></li>
        <li><a href=""><i class="fa-regular fa-envelope"></i> admin@mariebernardecollege.edu.ph</a></li>
      </div>
    </footer>
    <div class="copyright">
      <p>© 2021 All rights reserved marie - bernarde college inc.</p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/374eee3e25.js" crossorigin="anonymous"></script>
    <script src="js/navbar-scroll.js"></script>
</body>
</html>