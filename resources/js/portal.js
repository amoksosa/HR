document.getElementById("year").textContent = new Date().getFullYear();

    // password toggle
    const btn = document.getElementById("togglePassword");
    const input = document.getElementById("password");
    const eyeOpen = document.getElementById("eyeOpen");
    const eyeClosed = document.getElementById("eyeClosed");

    btn.addEventListener("click", () => {
      const isHidden = input.type === "password";
      input.type = isHidden ? "text" : "password";
      eyeOpen.classList.toggle("hidden", isHidden);
      eyeClosed.classList.toggle("hidden", !isHidden);
    });