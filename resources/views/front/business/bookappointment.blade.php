<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Appointment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS (for modal) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <!-- Trigger Button -->
  <div class="container py-5 text-center">
    <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#bookingModal">
      📅 Book Appointment
    </button>
  </div>

  <!-- Booking Modal -->
  <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bookingModalLabel">Book Your Appointment!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="bookingForm">
          <div class="modal-body">
            <div class="row g-4">

              <!-- Left Column -->
              <div class="col-lg-6">
                <!-- Select Service -->
                <div class="card mb-3">
                  <div class="card-header">Select Service</div>
                  <div class="card-body">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="service" id="service1" value="Consultation" required>
                      <label class="form-check-label" for="service1">
                        Consultation - 30min - $50
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="service" id="service2" value="Therapy">
                      <label class="form-check-label" for="service2">
                        Therapy Session - 60min - $100
                      </label>
                    </div>
                  </div>
                </div>

                <!-- Select Date -->
                <div class="card mb-3">
                  <div class="card-header">Select Date</div>
                  <div class="card-body">
                    <input type="date" name="date" class="form-control" required>
                  </div>
                </div>

                <!-- Select Time -->
                <div class="card mb-3">
                  <div class="card-header">Select Time</div>
                  <div class="card-body">
                    <select name="time" class="form-select" required>
                      <option value="">-- Select Time --</option>
                      <option>9:00 AM</option>
                      <option>9:30 AM</option>
                      <option>10:00 AM</option>
                      <option>10:30 AM</option>
                      <option>11:00 AM</option>
                      <option>2:00 PM</option>
                      <option>2:30 PM</option>
                      <option>3:00 PM</option>
                      <option>4:00 PM</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Right Column -->
              <div class="col-lg-6">
                <!-- Personal Information -->
                <div class="card mb-3">
                  <div class="card-header">Your Information</div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
                      </div>
                      <div class="col-md-6">
                        <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="col-md-12">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                      </div>
                      <div class="col-md-12">
                        <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                      </div>
                      <div class="col-md-12">
                        <textarea name="notes" class="form-control" rows="3" placeholder="Additional notes (optional)"></textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Booking Summary -->
                <div class="card">
                  <div class="card-header">Booking Summary</div>
                  <div class="card-body" id="summary">
                    <p><strong>Service:</strong> <span id="summaryService">-</span></p>
                    <p><strong>Date:</strong> <span id="summaryDate">-</span></p>
                    <p><strong>Time:</strong> <span id="summaryTime">-</span></p>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Request Appointment</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Simple Script to Update Summary -->
  <script>
    const form = document.getElementById("bookingForm");
    const summaryService = document.getElementById("summaryService");
    const summaryDate = document.getElementById("summaryDate");
    const summaryTime = document.getElementById("summaryTime");

    form.addEventListener("input", () => {
      summaryService.textContent = form.service.value || "-";
      summaryDate.textContent = form.date.value || "-";
      summaryTime.textContent = form.time.value || "-";
    });

    form.addEventListener("submit", (e) => {
      e.preventDefault();
      alert("Appointment request submitted successfully!");
      form.reset();
      summaryService.textContent = summaryDate.textContent = summaryTime.textContent = "-";
      const modal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
      modal.hide();
    });
  </script>
</body>
</html>
