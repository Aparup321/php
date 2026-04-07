document.addEventListener("DOMContentLoaded", () => {
  const timerEl = document.querySelector("[data-timer]");
  if (!timerEl) {
    return;
  }

  let remaining = parseInt(timerEl.getAttribute("data-timer"), 10);
  if (Number.isNaN(remaining)) {
    remaining = 0;
  }

  const updateDisplay = () => {
    const minutes = Math.floor(remaining / 60);
    const seconds = remaining % 60;
    timerEl.textContent = `${minutes.toString().padStart(2, "0")}:${seconds
      .toString()
      .padStart(2, "0")}`;
  };

  updateDisplay();

  const interval = setInterval(() => {
    remaining -= 1;
    updateDisplay();
    if (remaining <= 0) {
      clearInterval(interval);
      const form = document.querySelector("form[data-exam]");
      if (form) {
        form.submit();
      }
    }
  }, 1000);
});
