<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Medical Report</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .report-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      max-width: 700px;
      margin: 40px auto;
      background-color: #fff;
    }
    .section-title {
      border-left: 4px solid #198754; /* Bootstrap green */
      padding-left: 8px;
      margin-top: 1rem;
      font-weight: 600;
    }
    .plan-title {
      border-left: 4px solid #0d6efd; /* Bootstrap blue */
      padding-left: 8px;
      margin-top: 1rem;
      font-weight: 600;
    }
    .sub-section {
      background-color: #f8f9fa;
      padding: 10px;
      margin-bottom: 8px;
      border-radius: 4px;
    }
    .avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
    }

    .soap-section {
      border-radius: 8px;
      overflow: hidden;
      margin-bottom: 1rem;
      border: 1px solid #e0e0e0;
      background-color: #fff;
    }
    .soap-header {
      font-weight: 600;
      padding: 8px 15px;
    }
    .soap-body {
      padding: 15px;
    }
    .soap-subjective .soap-header {
      background-color: #eaf6ea; /* light green */
    }
    .soap-objective .soap-header {
      background-color: #eaf1fa; /* light blue */
    }
    .soap-assessment .soap-header {
      background-color: #f4ecfb; /* light purple */
    }
    .soap-plan .soap-header {
      background-color: #fff3e7; /* light orange */
    }
    .soap-body p {
      margin-bottom: 0.5rem;
    }
  </style>
</head>
<body class="bg-light">

  <div class="report-card shadow-sm">
    <h3 class="text-center fw-bold mb-3">Medical Report</h3>
    <div class="d-flex align-items-center mb-3">
      <img src="https://cdn-icons-png.flaticon.com/512/145/145867.png" class="avatar me-3" alt="Profile">
      <div>
        <p class="mb-1"><strong>Name:</strong> {{ $soap->patient->user->lname }}, {{ $soap->patient->user->fname }} {{ $soap->patient->user->mname }}</p>
        <p class="mb-1"><strong>Age:</strong> {{ $soap->patient->user->birthday->age }} &nbsp; <strong>Gender:</strong> {{ $soap->patient->user->gender }}</p>
        <p class="mb-1"><strong>Address:</strong> {{ $soap->patient->user->address }}</p>
        <p class="mb-1"><strong>Contact:</strong> {{ $soap->patient->user->contact }}</p>
        <p class="mb-0"><strong>Date:</strong> {{ $soap->created_at->format('F j, Y') }}</p>
      </div>
    </div>

        <div class="container" style="max-width: 800px;">
      
      <!-- Subjective -->
      <div class="soap-section soap-subjective">
        <div class="soap-header">Subjective</div>
        <div class="soap-body">
          <p><strong>Type of Visit:</strong> {{ $soap->s_type_of_visit }}</p>
          <p><strong>Chief Complaint:</strong> {{ $soap->chief_complaint }}</p>
        </div>
      </div>

      <!-- Objective -->
      <div class="soap-section soap-objective">
        <div class="soap-header">Objective</div>
        <div class="soap-body">
          <div class="row">
            <div class="col-md-6">
              <p><strong>Vitals:</strong> {{ $soap->o_systolic }}/{{ $soap->o_diastolic }}</p>
              <p><strong>Pulse:</strong> {{ $soap->o_pulse }} {{ $soap->o_pulse_type }}</p>
              <p><strong>Temperature:</strong> {{ $soap->o_temperature }} {{ $soap->o_temperature_unit }} ({{ $soap->o_temperature_location }})</p>
              <p><strong>Respiration:</strong> {{ $soap->o_respiration_rate }} {{ $soap->o_respiration_type }}</p>
            </div>
            <div class="col-md-6">
              <p><strong>O2 Sat:</strong> {{ $soap->o_o2_sat }}</p>
              <p><strong>Height:</strong> {{ $soap->o_height }} {{ $soap->o_height_unit }}</p>
              <p><strong>Weight:</strong> {{ $soap->o_weight }} {{ $soap->o_weight_unit }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Assessment -->
      <div class="soap-section soap-assessment">
        <div class="soap-header">Assessment</div>
        <div class="soap-body">
          <p><strong>Diagnosis:</strong> {{ $soap->a_diagnosis }}</p>
        </div>
      </div>

      <!-- Plan -->
      <div class="soap-section soap-plan">
        <div class="soap-header">Plan</div>
        <div class="soap-body">
          <p><strong>Diagnostic Care Plan:</strong> {{ $soap->p_diagnosis_care_plan }}</p>
          <p><strong>Therapeutic Care Plan:</strong> {{ $soap->p_therapeutic_care_plan }}</p>
          <p><strong>Doctor's Note:</strong> {{ $soap->p_doctors_note }}</p>
        </div>
      </div>

    </div>
  </div>

</body>
</html>
