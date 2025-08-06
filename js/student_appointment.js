document.addEventListener("DOMContentLoaded", () => {
  const counselorSelect = document.getElementById("counselor");
  const timeSelect = document.getElementById("time");

  // Fetch and populate counselors
  fetch("get_counselors.php")
    .then(res => res.json())
    .then(data => {
      console.log("Counselors:", data); // 🧪 Debug
      data.forEach(counselor => {
        const option = document.createElement("option");
        option.value = counselor.id;
        option.textContent = counselor.name;
        counselorSelect.appendChild(option);
      });
    });

  // Fetch timeslots when counselor is selected
  counselorSelect.addEventListener("change", () => {
    const counselorId = counselorSelect.value;
    console.log("Selected Counselor ID:", counselorId);

    timeSelect.innerHTML = '<option value="">Select time</option>';

    if (counselorId) {
      fetch(`get_timeslots.php?counselor_id=${counselorId}`)
        .then(res => res.json())
        .then(data => {
          console.log("Time slots received:", data);
          data.forEach(slot => {
            const option = document.createElement("option");
            option.value = slot.time_slot;
            option.textContent = slot.time_slot;
            timeSelect.appendChild(option);
          });
        });
    }
  });
});
