// Dashboard functionality
let isValueHidden = false

function toggleValue() {
  const valueElement = document.getElementById("totalValue")
  const iconElement = document.getElementById("eyeIcon")

  if (isValueHidden) {
    valueElement.style.filter = "none"
    iconElement.className = "fas fa-eye"
    isValueHidden = false
  } else {
    valueElement.style.filter = "blur(5px)"
    iconElement.className = "fas fa-eye-slash"
    isValueHidden = true
  }
}

// Goal Modal
function openGoalModal() {
  document.getElementById("goalModal").classList.add("active")
  document.getElementById("goalModal").style.display = "flex"
}

function closeGoalModal() {
  document.getElementById("goalModal").classList.remove("active")
  document.getElementById("goalModal").style.display = "none"
  document.getElementById("goalForm").reset()
}

// Goal Form Submit
document.getElementById("goalForm").addEventListener("submit", async (e) => {
  e.preventDefault()

  const target = document.getElementById("goalTarget").value

  try {
    const response = await fetch("api/goals.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ target: Number.parseFloat(target) }),
    })

    const result = await response.json()

    if (result.success) {
      showNotification("Meta definida com sucesso!", "success")
      closeGoalModal()
      setTimeout(() => location.reload(), 1000)
    } else {
      showNotification("Erro ao definir meta", "error")
    }
  } catch (error) {
    showNotification("Erro de conexão", "error")
  }
})

// Sidebar Toggle
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar")
  const overlay = document.getElementById("sidebarOverlay")

  sidebar.classList.toggle("active")
  overlay.classList.toggle("active")
}

// Notification System
function showNotification(message, type = "info") {
  const notification = document.createElement("div")
  notification.className = `notification notification-${type}`
  notification.innerHTML = `
        <i class="fas fa-${type === "success" ? "check-circle" : "exclamation-circle"}"></i>
        ${message}
    `

  document.body.appendChild(notification)

  setTimeout(() => {
    notification.classList.add("show")
  }, 100)

  setTimeout(() => {
    notification.classList.remove("show")
    setTimeout(() => {
      document.body.removeChild(notification)
    }, 300)
  }, 3000)
}

// Close modal when clicking outside
window.addEventListener("click", (e) => {
  const goalModal = document.getElementById("goalModal")
  if (e.target === goalModal) {
    closeGoalModal()
  }
})

// Initialize dashboard
document.addEventListener("DOMContentLoaded", () => {
  // Auto-refresh stats every 30 seconds
  setInterval(refreshStats, 30000)
})

async function refreshStats() {
  try {
    const response = await fetch("api/stats.php")
    const stats = await response.json()

    // Update stats without page reload
    document.querySelector(".stat-card:nth-child(1) .stat-value span").textContent =
      `R$ ${stats.totalToday.toFixed(2).replace(".", ",")}`
    document.querySelector(".stat-card:nth-child(2) .stat-value").textContent = stats.openOrders
    document.querySelector(".stat-card:nth-child(3) .stat-value").textContent = stats.closedOrders
  } catch (error) {
    console.error("Erro ao atualizar estatísticas:", error)
  }
}
