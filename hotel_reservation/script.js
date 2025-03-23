// Set minimum check-in date to today
document.addEventListener("DOMContentLoaded", () => {
  // Get today's date in YYYY-MM-DD format
  const today = new Date().toISOString().split("T")[0]

  // Set minimum date for check-in
  if (document.getElementById("checkIn")) {
    document.getElementById("checkIn").min = today

    // Add event listener to update check-out min date when check-in changes
    document.getElementById("checkIn").addEventListener("change", function () {
      document.getElementById("checkOut").min = this.value

      // If check-out date is before new check-in date, update it
      if (document.getElementById("checkOut").value < this.value) {
        document.getElementById("checkOut").value = this.value
      }
    })
  }

  // Pre-select room type if coming from rooms page
  const urlParams = new URLSearchParams(window.location.search)
  const roomParam = urlParams.get("room")

  if (roomParam && document.getElementById("roomType")) {
    const roomSelect = document.getElementById("roomType")
    for (let i = 0; i < roomSelect.options.length; i++) {
      if (roomSelect.options[i].value === roomParam) {
        roomSelect.selectedIndex = i
        break
      }
    }
  }
})

// Form validation
function validateForm() {
  let isValid = true
  const checkIn = document.getElementById("checkIn")
  const checkOut = document.getElementById("checkOut")
  const email = document.getElementById("email")
  const phone = document.getElementById("phone")

  // Remove any existing error messages
  const errorElements = document.querySelectorAll(".error")
  errorElements.forEach((element) => element.remove())

  // Check if check-out date is after check-in date
  if (checkIn && checkOut && checkIn.value >= checkOut.value) {
    isValid = false
    const error = document.createElement("div")
    error.className = "error"
    error.textContent = "Check-out date must be after check-in date"
    checkOut.parentNode.appendChild(error)
  }

  // Validate email format
  if (email && !/^\S+@\S+\.\S+$/.test(email.value)) {
    isValid = false
    const error = document.createElement("div")
    error.className = "error"
    error.textContent = "Please enter a valid email address"
    email.parentNode.appendChild(error)
  }

  // Validate phone number (simple validation)
  if (phone && !/^\d{10,15}$/.test(phone.value.replace(/[^0-9]/g, ""))) {
    isValid = false
    const error = document.createElement("div")
    error.className = "error"
    error.textContent = "Please enter a valid phone number"
    phone.parentNode.appendChild(error)
  }

  return isValid
}

