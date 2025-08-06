<?php
require_once 'database/db_connect.php';

$student_name = 'Juan Dela Cruz';

$sql = "SELECT 
            a.preferred_date, 
            a.preferred_time, 
            a.counselor_name
        FROM tbl_appointment a
        WHERE a.student_name = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_name);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Appointment History - LumiCHAT</title>
  <link rel="stylesheet" href="css/student_appointment.css" />
  <style>
    /* === HEADER === */
    .header-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      background-color: #ffffff;
      border-bottom: 1px solid #e0e0e0;
    }

    .header-bar h3 {
      margin: 0;
      font-size: 18px;
      font-weight: bold;
    }

    .back-btn {
      background-color: #2563eb;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: background-color 0.3s;
    }

    .back-btn:hover {
      background-color: #1e40af;
    }

    /* === TABLE + WRAPPER === */
    .main-wrapper {
      padding: 40px;
      background-color: #f9f9f9;
      min-height: 100vh;
    }

    .appointment-box {
      background-color: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      max-width: 800px;
      margin: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ddd;
    }

    th {
      background-color: #1e3a8a;
      color: white;
    }

    .view-btn {
      background-color: #2563eb;
      color: white;
      border: none;
      padding: 6px 14px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 500;
    }

    .view-btn:hover {
      background-color: #1e40af;
    }

    /* === MODAL === */
    .modal {
      position: fixed;
      z-index: 999;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.4);
      display: none;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      width: 400px;
      position: relative;
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }

    .modal-content h3 {
      margin-bottom: 20px;
      font-size: 20px;
      font-weight: bold;
    }

    .modal-content p {
      margin: 10px 0;
      font-size: 16px;
    }

    .modal-content .close {
      position: absolute;
      top: 12px;
      right: 18px;
      font-size: 24px;
      font-weight: bold;
      color: #333;
      cursor: pointer;
    }

    .cancel-btn {
      background-color: #dc2626;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      margin-top: 20px;
    }

    .cancel-btn:hover {
      background-color: #b91c1c;
    }

.filter-container {
  display: flex;
  gap: 16px;
  align-items: center;
  margin-top: 30px;
  margin-bottom: 20px;
}

.filter-container select,
.filter-container input[type="date"],
.filter-container input[type="text"] {
  width: 180px; /* 👈 Make them equal */
  padding: 10px 14px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
}

.search-wrapper {
  display: flex;
  align-items: center;
}

.search-wrapper input[type="text"] {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

.search-btn {
  padding: 10px;
  background-color: #2563eb;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.search-icon {
  width: 20px;
  height: 20px;
  filter: brightness(0) invert(1); /* Makes icon white if it's dark */
}


.search-btn:hover {
  background-color: #1e40af;
}


  </style>
</head>
<body>

<!-- HEADER -->
<div class="header-bar">
  <h3>Appointment History</h3>
  <a href="student_appointment.html" class="back-btn">Back to Booking</a>
</div>

<!-- CONTENT -->
<div class="main-wrapper">
  <div class="appointment-box">
    <h2>Past and Upcoming Appointments</h2>

    <!-- Filter Options -->
    <div class="filter-container">
      <select id="statusFilter">
        <option value="all">All Appointments</option>
        <option value="pending">Pending</option>
        <option value="confirmed">Confirmed</option>
        <option value="completed">Completed</option>
      </select>

      <input type="date" id="dateFilter" />

      <div class="search-wrapper">
        <input type="text" placeholder="Search Counselor" />
        <button class="search-btn">
          <img src="icons/search.png" alt="Search" class="search-icon">
        </button>
      </div>
    </div>


    <table>
      <thead>
        <tr>
          <th>Counselor</th>
          <th>Date</th>
          <th>Time</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['counselor_name']) ?></td>
          <td><?= htmlspecialchars($row['preferred_date']) ?></td>
          <td><?= htmlspecialchars($row['preferred_time']) ?></td>
          <td><span style="color: orange; font-weight: bold;">Pending</span></td>
          <td>
            <button class="view-btn"
              data-student="Juan Dela Cruz"
              data-counselor="<?= htmlspecialchars($row['counselor_name']) ?>"
              data-status="Pending"
            >
              View
            </button>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL -->
<div id="appointmentModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Appointment Details</h3>
    <p><strong>Student Name:</strong> <span id="modal-student"></span></p>
    <p><strong>Counselor Name:</strong> <span id="modal-counselor"></span></p>
    <p><strong>Appointment Status:</strong> <span id="modal-status"></span></p>
    <button class="cancel-btn" onclick="closeModal()">Cancel</button>
  </div>
</div>

<!-- SCRIPT -->
<script>
  const modal = document.getElementById("appointmentModal");
  const closeModalBtn = document.querySelector(".close");

  document.querySelectorAll(".view-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      document.getElementById("modal-student").textContent = btn.dataset.student;
      document.getElementById("modal-counselor").textContent = btn.dataset.counselor;
      document.getElementById("modal-status").textContent = btn.dataset.status;
      modal.style.display = "flex";
    });
  });

  closeModalBtn.onclick = function() {
    modal.style.display = "none";
  }

  function closeModal() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  }
</script>

</body>
</html>
