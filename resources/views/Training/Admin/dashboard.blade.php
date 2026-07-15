@extends('layouts.Training.admin')

@section('title', 'Training Admin')

@section('heading', 'Training Admin Dashboard')

@section('content') <!-- Flash Message -->
    @if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
            <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
            {{ session('create-edit-delete-message') }}
        </div>
    @endif

    {{-- OJT OUtline --}}
    <h1>ON THE JOB TRAINING MANUAL SWORN STAFF SECURITY/HOUSING UNIT OPERATIONS</h1>

    <h3>Introductions</h3>
    <ol>
        <li>Orientation</li>
        <li>Definitions</li>
        <li>Goals and Objectives of the Field Training Program</li>
        <li>Responsibilities of the Field Training Officer (FTO)</li>
        <li>On-The-Job Training</li>
        <li>Evaluations</li>
        <li>Remedial Training</li>
        <li>Expectations of Training</li>
    </ol>

    <h3>FAMILIARIZATION</h3>
    <ol>
        <li>FIELD TRAINING PROGRAM WEEKLY EVALUATION FOR MEDICAL HOUSING</li>
        <li>FIELD TRAINING PROGRAM DAILY EVALUATION FOR BOOKING/PROPERTY</li>
        <li>FIELD TRAINING PROGRAM DAILY EVALUATION FOR PRE-RELEASE/HU-6 OPERATIONS</li>
        <li>FIELD TRAINING PROGRAM WEEKLY EVALUATION FOR KITCHEN/HOUSEKEEPING</li>
        <ul>
            <li>STRENGTHS:</li>
            <li>WEAKNESSES:</li>
            <li>AREA OF IMPROVEMENT:</li>
            <li>Trainee’s Signature/Date</li>
            <li>FTO Signature/Date</li>
            <li>Supervisor’s Signature/Date</li>
        </ul>
    </ol>

    <h3>PART ONE: TRAINING THE TRAINEE</h3>
    <ol>
        <li>Inmate Grievance</li>
        <li>Report Writing</li>
        <li>Use of Force</li>
        <li>Use of Restraints</li>
    </ol>

    <p>Trainess Initials/PID#</p>
    <p>FTO Initials/PID#</p>
    <p>Date</p>

    <h3>PART TWO HOUSING UNIT OPERATIONS</h3>

    <h4>HOUSING UNIT OPERATIONS</h4>
    <ol>
        <li>Security Inspections</li>
        <li>Inmate Supervision</li>
        <li>Inmate Movement</li>
        <li>Inmate Counts</li>
        <li>Documentation</li>
        <li>Meal Service</li>
        <li>Inmate Hygiene</li>
        <li>Safety and Sanitation</li>
        <li>Medical</li>
        <li>AED Machines</li>
        <li>Inmate Discipline</li>
        <li>Radio/Intercom Communications</li>
        <li>Inmate Mail</li>
        <li>Emergency Procedures</li>
        <li>Searches</li>
    </ol>
    <p>Trainess Initials/PID#</p>
    <p>FTO Initials/PID#</p>
    <p>Date</p>

    <h4>UNIT CONTROL</h4>
    <ol>
        <li>General</li>
        <li>Radio/Intercom Communications</li>
        <li>Control Centers</li>
        <li>The Trainee Will Perform Working Knowledge Of</li>
    </ol>
    <p>Trainess Initials/PID#</p>
    <p>FTO Initials/PID#</p>
    <p>Date</p>

    <h4>Scenario Worksheet</h4>
    <p>Questions 1 - 25</p>

    <h4>FIELD TRAINING PROGRAM DAILY EVALUATION FOR HOUSING UNIT OPERATIONS</h4>

    <ul>
        <li>STRENGTHS:</li>
        <li>WEAKNESSES:</li>
        <li>IMPROVEMENT ON PREVIOUS NOTED WEAKNESSES:</li>
        <li>Trainee’s Signature/Date</li>
        <li>FTO Signature/Date</li>
        <li>Supervisor’s Signature/Date</li>
    </ul>

    <h4>FIELD TRAINING PROGRAM FINAL RECOMMENDATION FOR HOUSING UNIT OPERATIONS</h4>

    <ul>
        <li>Final STRENGTHS:</li>
        <li>Final WEAKNESSES:</li>
        <li>Final IMPROVEMENT ON PREVIOUS NOTED WEAKNESSES:</li>
        <li>Signature</li>
        <li>PID</li>
        <li>Date</li>
    </ul>

    <p>I Officer______________________certify that I have received sufficient training necessary to perform the duties and
        responsibilities of a
        Pod Officer.</p>

    <ul>
        <li>Trainee’s Signature, Date</li>
        <li>FTO’s Signature, Date, Approve/Disaprove</li>
        <li>Supervisor’s Signature, Date, Approve/Disaprove</li>
        <li>Unit Manager’s Signature, Date, Approve/Disaprove</li>
        <li>Director of Operations’ Signature, Date, Approve/Disaprove</li>
    </ul>

    <h3>PART THREE DAILY FORMS</h3>

    <ol>
        <li>F.402</li>
        <li>F.270</li>
        <li>F.139 C</li>
        <li>F.499</li>
        <li>F.387</li>
        <li>F.214</li>
        <li>Expectation Speech</li>
    </ol>

    <h3>STANDARD OPERATING PROCEDURE ACCEPTANCE AND ACKNOWLEDGEMENT</h3>

    <p>I ___________________ received and read the below referenced Standard Operating Procedure(s) on the date indicated.
        Supervisor’s Signature:_______________ Date:_________________</p>
    <ul>
        <li>ADMINISTRATION/MANAGEMENT (SECTION 1.0)</li>
        <li>PERSONNEL (SECTION: 3.0)</li>
        <li>TRAINING/STAFF DEVELOPMENT (SECTION: 5.0)</li>
        <li>MANAGEMENT INFORMATION/RESEARCH (SECTION: 6.0)</li>
        <li>SAFETY/SANITATION/HYGIENE (SECTION: 9.0)</li>
        <li>SECURITY / CONTROL / INMATE DISCIPLINE (SECTION 10.0)</li>
        <li>SPECIAL MANAGEMENT INMATES (SECTION 11.0)</li>
        <li>INMATES RIGHTS (SECTION 16.0)</li>
        <li>EMERGENCY PLANS (SECTION 17.0)</li>
        <li>COMMUNICATION / MAIL / VISITATION (SECTION 18.0)</li>
        <li>ADMISSION/PROPERTY CONTROL/RELEASE (SECTION 19.0)</li>
        <li>CLASSIFICATION (SECTION 20.0)</li>
        <ol>
            <li>POLICY NO.</li>
            <li>TITLE</li>
            <li>NAME</li>
            <li>DATE COMPLETED</li>
        </ol>
    </ul>

    <h1>User Types</h1>
    <ol>
        <li>Admin</li>
        <li>Trainee</li>
        <li>FTO</li>
        <li>Sergeant</li>
        <li>Supervisor</li>
        <li>Unit Manager</li>
        <li>Director of Operations</li>
    </ol>

@endsection
